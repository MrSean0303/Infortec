<?php

/* @var $model frontend\models\UserForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

    $this->title = "Alterar palavra-passe do utilizador";
    $this->params['breadcrumbs'][] = ['label' => 'Dados de utilizador', 'url' => ['user/index']];
    $this->params['breadcrumbs'][] = $this->title;
?>


<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'oldpassword')->passwordInput()->label("Palavra passe anterior")  ?>
    <?='<h3> Introduza a nova palavra passe </h3>'?>
    <?= $form->field($model, 'password')->passwordInput()->label("Nova palavra passe")?>
    <?= $form->field($model, 'otherpassword')->passwordInput()->label("Confirmar nova password")?>

    <div class="form-group">
        <?= Html::submitButton('Alterar', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>