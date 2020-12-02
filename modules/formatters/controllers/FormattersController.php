<?php


namespace app\modules\formatters\controllers;


use app\models\service\ServiceRecord;
use app\utilities\YamlResponseFormatter;
use yii\web\Controller;
use yii\web\Response;

class FormattersController extends Controller
{
    public function actionJson()
    {
        $data = $this->getData();
        $response = $this->getResponse();
        $response->format = Response::FORMAT_JSON;
        $response->data = $data;
    }

    public function actionYaml()
    {
        $data = $this->getData();
        $response = $this->getResponse();
        $response->format = YamlResponseFormatter::FORMAT;
        $response->data = $data;
    }

    private function getData()
    {
        $records = ServiceRecord::find()->all();
        $data = array_map(function ($record) {
            return $record->attributes;
        }, $records);
        return $data;
    }

    private function getResponse()
    {
        return \Yii::$app->response;
    }

    public function actionDocs()
    {
        return $this->render('docs.md');
    }
}