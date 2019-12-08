<?php

use frontend\controllers\ContactoController;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $contactos ContactoController; */

$this->title = 'Contactos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacto-form-index">

<h1><?= Html::encode($this->title) ?></h1>

<?php
if($contactos != null){

?>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Bandeira do pais</th>
            <th scope="col">Pais</th>
            <th scope="col">Indicativo</th>
            <th scope="col">Numero</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php

        for ($i=0; $i < count($contactos['contacto']); $i++){
            echo '<tr>';
            echo '<td scope="row">'.$i.'</td>';
            echo '<td style="width: 20%">'. Html::img('@web/Imagens/icons/'. $contactos['indicativo'][$i]->icon.'',  ['alt' => 'img', 'width' =>'30%' ]) .'</td>';
            echo '<td>'. $contactos['indicativo'][$i]->pais .'</td>';
            echo '<td>'. $contactos['indicativo'][$i]->indicativo .'</td>';
            echo '<td>'. $contactos['contacto'][$i]->numero .'</td>';
            echo '<td style="width: 10%" >' . Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['contacto/view', 'id' => $contactos['contacto'][$i]->idContacto]). ' ' .
                Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['contacto/update', 'id' => $contactos['contacto'][$i]->idContacto]). ' ' .
                Html::a('<span class="glyphicon glyphicon-trash"></span>', ['contacto/delete', 'id' => $contactos['contacto'][$i]->idContacto]). ' ' .
            '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
    </table>
<?php
} else{
    echo '<h2>Não tem contactos criados</h2>';
    echo "<p> Html::a('Criar Contacto', ['create'], ['class' => 'btn btn-success'])</p>";
}
?>
</div>
