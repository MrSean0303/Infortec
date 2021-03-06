<?php
namespace frontend\controllers;

use common\models\Utilizador;
use frontend\models\CarrinhoForm;
use frontend\models\LinhavendaForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VendaForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Produto;
use common\models\Categoria;
use common\models\Subcategoria;
use common\models\User;
use DateTime;
use DateTimeZone;
use yii\db\Query;
use yii\data\ActiveDataProvider;


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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $produtos = Produto::find()->indexBy('idProduto')->all();

        return $this->render('index', ['prod' => $produtos]);
    }

    public function actionPromocoes()
    {
        $produtos = Produto::find()->where(['>','valorDesconto', 0])->indexBy('idProduto')->all();

        return $this->render('indexPromocoes', ['prod' => $produtos]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = User::find()->where(['id' => Yii::$app->user->id])->one();
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionCategorias($nome, $subcate){

            $id = Categoria::find()->where(['nome' => $nome])->one()->idCategoria;
            $products = Categoria::findOne($id)->produtos;

        return $this->render('categorias', ['prod' => $products, 'subcate' => $subcate]);

    }

    /*public function actionSubcategoria($subcat)
    {
        $id = Subcategoria::find()->where(['nome' => $subcat])->one()->idsubCategoria;
        $products = Subcategoria::findOne($id)->produtos;

        return $this->render('subcategorias', ['prod' => $products]);
    }*/

    public function actionSearchproducts(){

        $searchInput = Yii::$app->request->get('pesquisa');
        $products = Produto::find()->where(['like', 'nome', $searchInput])->all();
        return $this->render('search_products', array('prod' => $products));
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Obrigado pelo registo. Por favor verifique a sua caixa de correio do seu email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Verifique o seu email para mais instruções.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Desculpe, não conseguimos redefinir a sua palava-passe para o email fornecido.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Palava passe salva');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Verifique o seu email para mais instruções');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Desculpe nao conseguimos verificar o token fornecido.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Desculpe, não conseguimos redefinir a sua palava-passe para o email fornecido.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function actionAddcarrinho($id){
        $carrinho = new CarrinhoForm();

        $storedCookie = $carrinho->addToCart($id);

        return $this->redirect(['carrinho']);

    }

    public function actionCarrinho(){
        $cookies = Yii::$app->request->cookies;
        $cartCookie = $cookies->getValue('carrinho');

        $cart = null;
        $valorTotal = 0;
        if ($cartCookie != null){
            $carrinho = new CarrinhoForm();
            $cart = $carrinho->getCart($cartCookie);

            foreach ($cart as $produtos){

                $valorTotal += $produtos->precofinal;
            }
        }

        return $this->render('carrinho', ['compras' => $cart, 'total' => $valorTotal]);
    }

    public function actionDeletecarrinho($id){
        $carrinho = new CarrinhoForm();

        $carrinho->deleteFromCart($id);

        return $this->redirect(['carrinho']);
    }

    public function actionVender($total){

        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $cookies = Yii::$app->request->cookies;
        $cartCookie = $cookies->getValue('carrinho');

        $carrinho = new CarrinhoForm();
        $cart = $carrinho->getCart($cartCookie);

        $newcookies = Yii::$app->response->cookies;
        $newcookies->remove('carrinho');

        $venda = new VendaForm();
        $venda->totalVenda = $total;

        $venda->data = Date( 'Y-m-d h:i:s ');

        $utilizador = Utilizador::find()->where(['user_id' => Yii::$app->user->id])->one();

        $venda->utilizador_id = $utilizador->user_id;
        $venda->save();

        foreach ($cart as $produto){
            $linha = new LinhavendaForm();

            $prod = Produto::find()->where(['idProduto' => $produto->idProduto])->one();
            $linha->produto_id = $prod->idProduto;
            $linha->quantidade = $produto->quantidade;


            if ($produto->valorDesconto != null){
                $produto->preco = $produto->preco - $produto->valorDesconto;
            }

            $linha->preco = $produto->preco;
            $linha->venda_id = $venda->idVenda;
            $linha->save();
        }


        Yii::$app->session->setFlash('success', 'Compra feita com sucesso');
        return $this->goHome();
    }

}
