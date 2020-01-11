<?php
namespace frontend\models;

use common\models\Utilizador;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $nome;
    public $username;
    public $email;
    public $nif;
    public $morada;
    public $password;
    public $otherpassword;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['otherpassword', 'required'],
            ['otherpassword', 'compare', 'compareAttribute' => 'password', 'message' => 'A palavras passe não coincidem'],
            ['otherpassword', 'string', 'min' => 6],


            ['nome', 'trim'],
            ['nome', 'required'],
            ['nome', 'string', 'max' => 255],
            ['nome', 'string', 'length' => [1, 24]],

            ['morada', 'trim'],
            ['morada', 'string', 'max' => 255],
            ['morada', 'string', 'length' => [4, 255]],

            ['nif', 'trim'],
            ['nif', 'integer'],
            ['nif', 'unique', 'targetClass' => '\common\models\Utilizador'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $utilizador = new Utilizador();

        $utilizador->nome = $this->nome;
        $user->username = $this->username;
        $user->email = $this->email;
        $utilizador->morada = $this->morada;
        $utilizador->nif = $this->nif;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $utilizador->numPontos = 0;
        $user->save();

        $utilizador->user_id = $user->id;
        $utilizador->save();

        return $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' bot'])
            ->setTo($this->email)
            ->setSubject('Ativação da conta ' . Yii::$app->name)
            ->send();
    }
}
