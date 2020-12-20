<?php


namespace app\modules\queue\amqp;

use app\services\QueueService;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


class SimpleReceiver
{

    /**
     * Слушатели входящих сообщений
     */
    public function listen()
    {
        $connection = new AMQPStreamConnection(
            'localhost',    #host
            5672,        #port
            'guest',        #user
            'guest'        #password
        );

        $channel = $connection->channel();

        $channel->queue_declare(
            'pizzaTime',    #имя очереди, такое же, как и у отправителя
            false,        #пассивный
            false,        #надёжный
            false,        #эксклюзивный
            false        #автоудаление
        );

        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

        $callback = function ($msg) {
            $message = $msg->body;
            echo " [x] Received ", $message, "\n";
            $queueService = new QueueService();
            $queueService->emailQueueMessage($message);
        };

        $channel->basic_consume(
            'pizzaTime',                    #очередь
            '',                            #тег получателя - Идентификатор получателя, валидный в пределах текущего канала. Просто строка
            false,                        #не локальный - TRUE: сервер не будет отправлять сообщения соединениям, которые сам опубликовал
            true,                        #без подтверждения - отправлять соответствующее подтверждение обработчику, как только задача будет выполнена
            false,                        #эксклюзивная - к очереди можно получить доступ только в рамках текущего соединения
            false,                        #не ждать - TRUE: сервер не будет отвечать методу. Клиент не должен ждать ответа
//            array($this, 'callback')    #функция обратного вызова - метод, который будет принимать сообщение
            $callback,    #функция обратного вызова - метод, который будет принимать сообщение
//            function () {
//                $queueService = new QueueService();
//                $queueService->emailQueueMessage($msg);
//            }  #функция обратного вызова - метод, который будет принимать сообщение
        );

        while (count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}
