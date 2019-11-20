<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
Olá <?= $user->username ?>,

Clica no link abaixo para verificares o teu Email:

<?= $verifyLink ?>
