<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RecomendacoesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recomendacoes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recomendacoes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Recomendacoes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idCandidato',
            'dataEnvio',
            'prazo',
            'nome',
            // 'email:email',
            // 'token',
            // 'titulacao',
            // 'cargo',
            // 'instituicaoTitulacao',
            // 'anoTitulacao',
            // 'instituicaoAtual',
            // 'dominio',
            // 'aprendizado',
            // 'assiduidade',
            // 'relacionamento',
            // 'iniciativa',
            // 'expressao',
            // 'ingles',
            // 'classificacao',
            // 'informacoes:ntext',
            // 'anoContato',
            // 'conheceGraduacao',
            // 'conhecePos',
            // 'conheceEmpresa',
            // 'conheceOutros',
            // 'outrosLugares',
            // 'orientador',
            // 'professor',
            // 'empregador',
            // 'coordenador',
            // 'colegaCurso',
            // 'colegaTrabalho',
            // 'outrosContatos',
            // 'outrasFuncoes',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
