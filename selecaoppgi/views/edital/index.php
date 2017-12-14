<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchEdital */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Edital Abertos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="edital-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]);

            //nao fui eu quem comentei essa linha cima!
     ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => '',
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'numero',
            'cartarecomendacao',
            'datainicio',
            'datafim',
            'documento',

            ['class' => 'yii\grid\ActionColumn','template'=>'{view}' ],
        ],
    ]); ?>
</div>
