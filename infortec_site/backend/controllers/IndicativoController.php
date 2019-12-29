<?php

namespace backend\controllers;

use backend\models\IndicativoForm;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Yii;
use common\models\Indicativo;
use backend\models\IndicativoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IndicativoController implements the CRUD actions for Indicativo model.
 */
class IndicativoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Indicativo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IndicativoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Indicativo model.
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
     * Creates a new Indicativo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IndicativoForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->uploadImage();

            $indicativo = new Indicativo();
            $indicativo->icon = $model->icon;
            $indicativo->indicativo = $model->indicativo;
            $indicativo->pais = $model->pais;
            $indicativo->save();

            return $this->redirect(['view', 'id' => $indicativo->idIndicativo]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Indicativo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $indicativo = $this->findModel($id);

        $model = new IndicativoForm();
        $model->idIndicativo = $indicativo->idIndicativo;
        $model->indicativo = $indicativo->indicativo;
        $model->icon = $indicativo->icon;
        $model->pais = $indicativo->pais;

        if ($model->load(Yii::$app->request->post())) {
            $model->changeImage();

            $indicativo->idIndicativo = $model->idIndicativo;
            $indicativo->indicativo = $model->indicativo;
            $indicativo->icon = $model->icon;
            $indicativo->pais = $model->pais;
            $indicativo->save();


            return $this->redirect(['view', 'id' => $indicativo->idIndicativo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Indicativo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $indicativo = $this->findModel($id);

        if ($indicativo->icon != null) {
            $model = new ProdutoForm();
            $model->icon = $indicativo->icon;
            $model->deleteImage();
        }

        $indicativo->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Indicativo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Indicativo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Indicativo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
