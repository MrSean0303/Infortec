<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Olá <?= $user->username ?>,

Clica no link abaixo para verificares o teu Email:

<?= $resetLink ?>
