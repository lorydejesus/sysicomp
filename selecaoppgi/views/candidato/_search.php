<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CandidatoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="candidato-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'senha') ?>

    <?= $form->field($model, 'inicio') ?>

    <?= $form->field($model, 'fim') ?>

    <?= $form->field($model, 'passoatual') ?>

    <?php // echo $form->field($model, 'nome') ?>

    <?php // echo $form->field($model, 'endereco') ?>

    <?php // echo $form->field($model, 'bairro') ?>

    <?php // echo $form->field($model, 'cidade') ?>

    <?php // echo $form->field($model, 'uf') ?>

    <?php // echo $form->field($model, 'cep') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'datanascimento') ?>

    <?php // echo $form->field($model, 'nacionalidade') ?>

    <?php // echo $form->field($model, 'pais') ?>

    <?php // echo $form->field($model, 'estadocivil') ?>

    <?php // echo $form->field($model, 'rg') ?>

    <?php // echo $form->field($model, 'orgaoexpedidor') ?>

    <?php // echo $form->field($model, 'dataexpedicao') ?>

    <?php // echo $form->field($model, 'passaporte') ?>

    <?php // echo $form->field($model, 'cpf') ?>

    <?php // echo $form->field($model, 'sexo') ?>

    <?php // echo $form->field($model, 'telresidencial') ?>

    <?php // echo $form->field($model, 'telcomercial') ?>

    <?php // echo $form->field($model, 'telcelular') ?>

    <?php // echo $form->field($model, 'nomepai') ?>

    <?php // echo $form->field($model, 'nomemae') ?>

    <?php // echo $form->field($model, 'cursodesejado') ?>

    <?php // echo $form->field($model, 'regime') ?>

    <?php // echo $form->field($model, 'inscricaoposcomp') ?>

    <?php // echo $form->field($model, 'anoposcomp') ?>

    <?php // echo $form->field($model, 'notaposcomp') ?>

    <?php // echo $form->field($model, 'solicitabolsa') ?>

    <?php // echo $form->field($model, 'vinculoemprego') ?>

    <?php // echo $form->field($model, 'empregador') ?>

    <?php // echo $form->field($model, 'cargo') ?>

    <?php // echo $form->field($model, 'vinculoconvenio') ?>

    <?php // echo $form->field($model, 'convenio') ?>

    <?php // echo $form->field($model, 'linhapesquisa') ?>

    <?php // echo $form->field($model, 'tituloproposta') ?>

    <?php // echo $form->field($model, 'diploma') ?>

    <?php // echo $form->field($model, 'historico') ?>

    <?php // echo $form->field($model, 'motivos') ?>

    <?php // echo $form->field($model, 'proposta') ?>

    <?php // echo $form->field($model, 'curriculum') ?>

    <?php // echo $form->field($model, 'cartaempregador') ?>

    <?php // echo $form->field($model, 'comprovantepagamento') ?>

    <?php // echo $form->field($model, 'cursograd') ?>

    <?php // echo $form->field($model, 'instituicaograd') ?>

    <?php // echo $form->field($model, 'crgrad') ?>

    <?php // echo $form->field($model, 'egressograd') ?>

    <?php // echo $form->field($model, 'dataformaturagrad') ?>

    <?php // echo $form->field($model, 'cursoesp') ?>

    <?php // echo $form->field($model, 'instituicaoesp') ?>

    <?php // echo $form->field($model, 'egressoesp') ?>

    <?php // echo $form->field($model, 'dataformaturaesp') ?>

    <?php // echo $form->field($model, 'cursopos') ?>

    <?php // echo $form->field($model, 'instituicaopos') ?>

    <?php // echo $form->field($model, 'tipopos') ?>

    <?php // echo $form->field($model, 'mediapos') ?>

    <?php // echo $form->field($model, 'egressopos') ?>

    <?php // echo $form->field($model, 'dataformaturapos') ?>

    <?php // echo $form->field($model, 'periodicosinternacionais') ?>

    <?php // echo $form->field($model, 'periodicosnacionais') ?>

    <?php // echo $form->field($model, 'conferenciasinternacionais') ?>

    <?php // echo $form->field($model, 'conferenciasnacionais') ?>

    <?php // echo $form->field($model, 'instituicaoingles') ?>

    <?php // echo $form->field($model, 'duracaoingles') ?>

    <?php // echo $form->field($model, 'nomeexame') ?>

    <?php // echo $form->field($model, 'dataexame') ?>

    <?php // echo $form->field($model, 'notaexame') ?>

    <?php // echo $form->field($model, 'empresa1') ?>

    <?php // echo $form->field($model, 'empresa2') ?>

    <?php // echo $form->field($model, 'empresa3') ?>

    <?php // echo $form->field($model, 'cargo1') ?>

    <?php // echo $form->field($model, 'cargo2') ?>

    <?php // echo $form->field($model, 'cargo3') ?>

    <?php // echo $form->field($model, 'periodoprofissional1') ?>

    <?php // echo $form->field($model, 'periodoprofissional2') ?>

    <?php // echo $form->field($model, 'periodoprofissional3') ?>

    <?php // echo $form->field($model, 'instituicaoacademica1') ?>

    <?php // echo $form->field($model, 'instituicaoacademica2') ?>

    <?php // echo $form->field($model, 'instituicaoacademica3') ?>

    <?php // echo $form->field($model, 'atividade1') ?>

    <?php // echo $form->field($model, 'atividade2') ?>

    <?php // echo $form->field($model, 'atividade3') ?>

    <?php // echo $form->field($model, 'periodoacademico1') ?>

    <?php // echo $form->field($model, 'periodoacademico2') ?>

    <?php // echo $form->field($model, 'periodoacademico3') ?>

    <?php // echo $form->field($model, 'resultado') ?>

    <?php // echo $form->field($model, 'periodo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
