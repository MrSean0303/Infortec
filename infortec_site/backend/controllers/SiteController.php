<?php
namespace backend\controllers;

use backend\models\GerirVendaForm;
use common\models\Linhavenda;
use common\models\Produto;
use common\models\Venda;
use phpDocumentor\Reflection\Types\Null_;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
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
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $vendas = Venda::find()->indexBy('idVenda')->orderBy(['data'=> SORT_DESC ])->all();
        $vendasMes['data'] = Yii::$app->formatter->asDate('now', 'dd-MM-yyyy');
        $vendasMes['vendas'] = 0;
        $produtosVendidos = 0;

        if (!empty($vendas)){
            foreach ($vendas as $venda){
                if(Yii::$app->formatter->asDate($venda->data, 'MM') == Yii::$app->formatter->asDate('now', 'MM')){
                    $vendasMes['vendas'] += $venda->totalVenda;
                    $linhavenda = Linhavenda::find()->where(['venda_id' => $venda->idVenda])->all();
                    foreach ($linhavenda as $linha){
                        $produtosVendidos += $linha->quantidade;
                    }
                }
            }
        }

        return $this->render('index', ['vendas' => $vendasMes, 'produtos' => $produtosVendidos]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


}
