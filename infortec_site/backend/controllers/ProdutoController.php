<?php

namespace backend\controllers;

use app\models\ProdutoForm;
use common\models\Iva;
use common\models\Subcategoria;
use common\models\User;
use Yii;
use common\models\Produto;
use backend\models\ProdutoSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProdutoController implements the CRUD actions for Produto model.
 */
class ProdutoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['view', 'update', 'create', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Produto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProdutoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Produto model.
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
     * Creates a new Produto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProdutoForm();
        $iva = Iva::find()->all();
        $subcategoria = Subcategoria::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            $model->uploadImage();
            $produto = new Produto();
            $produto->nome = $model->nome;
            $produto->fotoProduto = $model->fotoProduto;
            $produto->preco = $model->preco;
            $produto->quantStock = $model->quantStock;
            $produto->descricao = $model->descricao;
            $produto->descricaoGeral = $model->descricaoGeral;
            $produto->valorDesconto = $model->valorDesconto;
            $produto->pontos = $model->pontos;
            $produto->iva_id = $model->iva_id;
            $produto->subCategoria_id = $model->subCategoria_id;
            $produto->save();

            return $this->redirect(['view', 'id' => $produto->idProduto]);
        }

        return $this->render('create', [
            'model' => $model, 'iva' => $iva, 'subcategoria' => $subcategoria
        ]);
    }

    /**
     * Updates an existing Produto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $produto = $this->findModel($id);
        $model = new ProdutoForm();
        $iva = Iva::find()->all();
        $subcategoria = Subcategoria::find()->all();

        $model->idProduto = $produto->idProduto;
        $model->nome = $produto->nome;
        $model->fotoProduto = $produto->fotoProduto;
        $model->preco = $produto->preco;
        $model->quantStock = $produto->quantStock;
        $model->descricao = $produto->descricao;
        $model->descricaoGeral = $produto->descricaoGeral;
        $model->valorDesconto = $produto->valorDesconto;
        $model->pontos = $produto->pontos;
        $model->iva_id = $produto->iva_id;
        $model->subCategoria_id = $produto->subCategoria_id;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->fotoProduto != null) {
                $model->changeImage();
                $produto->fotoProduto = $model->fotoProduto;
            }

            $produto->nome = $model->nome;
            $produto->preco = $model->preco;
            $produto->quantStock = $model->quantStock;
            $produto->descricao = $model->descricao;
            $produto->descricaoGeral = $model->descricaoGeral;
            $produto->valorDesconto = $model->valorDesconto;
            $produto->pontos = $model->pontos;
            $produto->iva_id = $model->iva_id;
            $produto->subCategoria_id = $model->subCategoria_id;

            $produto->save();

            return $this->redirect(['view', 'id' =>  $produto->idProduto]);
        }

        return $this->render('update', [
            'model' => $model, 'iva' => $iva, 'subcategoria' => $subcategoria
        ]);
    }

    /**
     * Deletes an existing Produto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $produto = $this->findModel($id);

        if ($produto->fotoProduto != null) {
            $model = new ProdutoForm();
            $model->fotoProduto = $produto->fotoProduto;
            $model->deleteImage();
        }

        $produto->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Produto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Produto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
