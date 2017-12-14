<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Recomendacoes */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Recomendacoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recomendacoes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'idCandidato',
            'dataEnvio',
            'prazo',
            'nome',
            'email:email',
            'token',
            'titulacao',
            'cargo',
            'instituicaoTitulacao',
            'anoTitulacao',
            'instituicaoAtual',
            'dominio',
            'aprendizado',
            'assiduidade',
            'relacionamento',
            'iniciativa',
            'expressao',
            'ingles',
            'classificacao',
            'informacoes:ntext',
            'anoContato',
            'conheceGraduacao',
            'conhecePos',
            'conheceEmpresa',
            'conheceOutros',
            'outrosLugares',
            'orientador',
            'professor',
            'empregador',
            'coordenador',
            'colegaCurso',
            'colegaTrabalho',
            'outrosContatos',
            'outrasFuncoes',
        ],
    ]) ?>

</div>
