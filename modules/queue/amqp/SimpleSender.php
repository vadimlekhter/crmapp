<?php


namespace app\modules\queue\amqp;


use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SimpleSender
{
    /**
     * Отправляет сообщение в очередь pizzaTime
     *
     * @param string $message
     */
    public function execute($message)
    {
        /**
         * Создаёт совединение с RabbitAMQP
         */
        $connection = new AMQPStreamConnection(
            'localhost',    #host - имя хоста, на котором запущен сервер RabbitMQ
            5672,        #port - номер порта сервиса, по умолчанию - 5672
            'guest',        #user - имя пользователя для соединения с сервером
            'guest'        #password
        );

        /** @var $channel AMQPChannel */
        $channel = $connection->channel();

        $channel->queue_declare(
            'pizzaTime',    #queue name - Имя очереди может содержать до 255 байт UTF-8 символов
            false,        #passive - может использоваться для проверки того, инициирован ли обмен, без того, чтобы изменять состояние сервера
            false,        #durable - убедимся, что RabbitMQ никогда не потеряет очередь при падении - очередь переживёт перезагрузку брокера
            false,        #exclusive - используется только одним соединением, и очередь будет удалена при закрытии соединения
            false        #autodelete - очередь удаляется, когда отписывается последний подписчик
        );

        $msg = new AMQPMessage($message);

        $channel->basic_publish(
            $msg,        #message
            '',            #exchange
            'pizzaTime'    #routing key
        );

        $channel->close();
        $connection->close();
    }

}