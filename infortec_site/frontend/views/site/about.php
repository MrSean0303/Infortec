<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Infortec é uma empresa de venda de produtos informáticos principalmente de forma Online, através de encomendas. </p>
    <p>Pertencemos ao Concelho de Alcobaça, o qual pertence ao Distrito de Leiria.</p>
    <p>No momento somos apenas dois sócios, mas estamos à procura de pessoal para emprego sazonal. Qualquer aplicação pode ser enviada para o email da loja.</p>
    <p>Apesar das instalações serem temporárias estamos situados em Turquel de momento.</p>
    <hr>
    <h4>Email da loja: </h4> <p style="font-weight: bold">infortec.ipl@gmail.com</p>

    <h3 style="padding-top: 15px">Localização</h3>
    <!--The div element for the map -->
    <div id="map"></div>
    <script>
        function initMap() {
            // The location of Turquel
            var turquel = {lat: 39.465227, lng: -8.978091};
            // The map, centered at Turquel
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 4, center: turquel});
            // The marker, positioned at Turquel
            var marker = new google.maps.Marker({position: turquel, map: map});
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAw84rkS4J4IFNfPOXJsAbFfm95NyzJsck&callback=initMap">
    </script>

</div>
