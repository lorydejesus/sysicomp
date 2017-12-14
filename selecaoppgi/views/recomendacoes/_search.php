<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RecomendacoesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recomendacoes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idCandidato') ?>

    <?= $form->field($model, 'dataEnvio') ?>

    <?= $form->field($model, 'prazo') ?>

    <?= $form->field($model, 'nome') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'token') ?>

    <?php // echo $form->field($model, 'titulacao') ?>

    <?php // echo $form->field($model, 'cargo') ?>

    <?php // echo $form->field($model, 'instituicaoTitulacao') ?>

    <?php // echo $form->field($model, 'anoTitulacao') ?>

    <?php // echo $form->field($model, 'instituicaoAtual') ?>

    <?php // echo $form->field($model, 'dominio') ?>

    <?php // echo $form->field($model, 'aprendizado') ?>

    <?php // echo $form->field($model, 'assiduidade') ?>

    <?php // echo $form->field($model, 'relacionamento') ?>

    <?php // echo $form->field($model, 'iniciativa') ?>

    <?php // echo $form->field($model, 'expressao') ?>

    <?php // echo $form->field($model, 'ingles') ?>

    <?php // echo $form->field($model, 'classificacao') ?>

    <?php // echo $form->field($model, 'informacoes') ?>

    <?php // echo $form->field($model, 'anoContato') ?>

    <?php // echo $form->field($model, 'conheceGraduacao') ?>

    <?php // echo $form->field($model, 'conhecePos') ?>

    <?php // echo $form->field($model, 'conheceEmpresa') ?>

    <?php // echo $form->field($model, 'conheceOutros') ?>

    <?php // echo $form->field($model, 'outrosLugares') ?>

    <?php // echo $form->field($model, 'orientador') ?>

    <?php // echo $form->field($model, 'professor') ?>

    <?php // echo $form->field($model, 'empregador') ?>

    <?php // echo $form->field($model, 'coordenador') ?>

    <?php // echo $form->field($model, 'colegaCurso') ?>

    <?php // echo $form->field($model, 'colegaTrabalho') ?>

    <?php // echo $form->field($model, 'outrosContatos') ?>

    <?php // echo $form->field($model, 'outrasFuncoes') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
