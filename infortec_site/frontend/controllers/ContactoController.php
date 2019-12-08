<?php

namespace frontend\controllers;

use common\models\Contacto;
use common\models\Indicativo;
use common\models\User;
use common\models\Utilizador;
use Yii;
use frontend\models\ContactoForm;
use frontend\models\ContactoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactoController implements the CRUD actions for ContactoForm model.
 */
class ContactoController extends Controller
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
     * Lists all ContactoForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $contactos_indicativos['contacto'] = Contacto::find()->where(['utilizador_id' => Yii::$app->user->id])->all();

        if ($contactos_indicativos['contacto'] != null){
            foreach ($contactos_indicativos['contacto'] as $cont){
                $ind[] = Indicativo::find()->where(['idIndicativo' => $cont->indicativo_id])->one();
            }
            $contactos_indicativos['indicativo'] = $ind;
        }

        return $this->render('index', [
            'contactos' => $contactos_indicativos,
        ]);
    }

    /**
     * Displays a single ContactoForm model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $contacto = $this->findModel($id);
        $model['indicativo'] = Indicativo::find()->where(['idIndicativo' => $contacto->indicativo_id])->one();

        $model['contacto'] = $contacto;


        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new ContactoForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model['contacto'] = new ContactoForm();
        $model['indicativo'] = Indicativo::find()->all();
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();

        $model['contacto']->utilizador_id = $user->id;

        if ($model['contacto']->load(Yii::$app->request->post()) && $model['contacto']->create()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ContactoForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model['contacto'] = $this->findModel($id);
        $user = Utilizador::find()->where(['idUtilizador' => $model['contacto']->utilizador_id])->one();
        $model['indicativo'] = Indicativo::find()->all();

        if ($model['contacto']->load(Yii::$app->request->post()) && $model['contacto']->save()) {
            return $this->redirect(['view', 'id' => $model['contacto']->idContacto]);
        }
        $model['contacto']->utilizador_id = $user->nome;

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ContactoForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ContactoForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContactoForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contacto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
