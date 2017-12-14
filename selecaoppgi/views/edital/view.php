<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Edital */

$this->title = "Edital de número: ".$model->numero;
$this->params['breadcrumbs'][] = ['label' => 'Editais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="edital-view">


<br>
    <?= Html::a('Inscrever-se', ['site/cadastroppgi', 'id' => $model->numero], ['class' => 'btn btn-primary']) ?>

<br>
<br>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'numero',
            'cartarecomendacao',
            'datainicio',
            'datafim',
            'documento',
        ],
    ]) ?>

</div>

        
