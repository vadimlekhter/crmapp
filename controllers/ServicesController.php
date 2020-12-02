<?php

namespace app\controllers;

use app\services\ServiceService;
use app\utilities\YamlResponseFormatter;
use Yii;
use app\models\service\ServiceRecord;
use app\models\service\ServiceSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiceController implements the CRUD actions for ServiceRecord model.
 */
class ServicesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ServiceRecord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single ServiceRecord model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the ServiceRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServiceRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServiceRecord::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new ServiceRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServiceRecord();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $serviceService = new ServiceService();
            $serviceService->emailAddService($model);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ServiceRecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ServiceRecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $deleting_record = $this->findModel($id);
        $deleting_record_name = $deleting_record->name;
        $deleting_record->delete();

        $serviceService = new ServiceService();
        $serviceService->emailDeleteService($deleting_record_name);

        return $this->redirect(['index']);
    }

    public function actionJson()
    {
        $models = ServiceRecord::find()->all();

        $data = array_map(function ($model) {
            return $model->attributes;
        }, $models);

        $responce = Yii::$app->response;
        $responce->format = \yii\web\Response::FORMAT_JSON;
        $responce->data = $data;

        return $responce;
    }

    public function actionYaml () {
        $models = ServiceRecord::find()->all();

        $data = array_map(function ($model) {
            return $model->attributes;
        }, $models);

        $response = Yii::$app->response;
        $response->format = YamlResponseFormatter::FORMAT;
        $response->data = $data;

        return $data;
    }
}
