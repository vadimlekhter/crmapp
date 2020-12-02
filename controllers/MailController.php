<?php


namespace app\controllers;


use app\models\mail\MailForm;
use yii\web\Controller;

class MailController extends Controller
{
    public function actionIndex()
    {
        $model = new MailForm();
        if ($args = $this->load($model)) {
            extract($args);

            $views = ['html' => 'message-html', 'text' => 'message-text'];
            $data = ['message' => $message];

            if (\Yii::$app->emailService->send($to, $subject, $data, $views)) {
                \Yii::$app->session->setFlash('success', 'Mail sended!');
                return $this->refresh();
            }
        }


        return $this->render('index', compact('model'));
    }

    private function load($model)
    {
        if ($model->load(\Yii::$app->request->post())) {
            $to = \Yii::$app->request->post('MailForm')['to'];
            $subject = \Yii::$app->request->post('MailForm')['subject'];
            $message = \Yii::$app->request->post('MailForm')['message'];
            return ['to' => $to, 'subject' => $subject, 'message' => $message];
        }
    }
}