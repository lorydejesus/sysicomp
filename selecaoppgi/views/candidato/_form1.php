<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\widgets\MaskedInput;
use kartik\widgets\SwitchInput;

if($model->cotas == 1)
    $hideCotas = "block";
else
    $hideCotas = "none";

if($model->deficiencia == 1)
    $hideDeficiencia = "block";
else
    $hideDeficiencia = "none";


$ufs = ["AC" => "AC", "AL" => "AL", "AM" => "AM", "AP" => "AP", "BA" => "BA", "CE" => "CE", "DF" => "DF",
"ES" => "ES", "GO" => "GO", "MA" => "MA", "MG" => "MG", "MS" => "MS", "MT" => "MT", "PA" => "PA",
"PB" => "PB", "PE" => "PE", "PI" => "PI", "PR" => "PR", "RJ" => "RJ", "RN" => "RN", "RO" => "RO",
"RR" => "RR", "RS" => "RS", "SC" => "SC", "SE" => "SE", "SP" => "SP", "TO" => "TO"];

$deficiencias = ['1' => 'Deficiência Auditiva', '2' => 'Deficiência Motora', '3' => 'Deficiência Visual'];

$cotas = ['Indio' => 'Índio', 'Negro' => 'Negro', 'Pardo' => 'Pardo'];

?>
<div class="candidato-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <input type="hidden" id = "form_hidden" value ="passo_form_1"/>

<!-- Inicio da Identificação do Candidato -->
    
    <div style="clear: both;"><legend>Identificação do Candidato</legend></div>
    <div class ="row">
        <?= $form->field($model, 'nome', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true])->label("<font color='#FF0000'>*</font> <b>Nome:</b>") ?>
        
        <?= $form->field($model, 'datanascimento', ['options' => ['class' => 'col-md-3']])->widget(MaskedInput::className(), [
          'clientOptions' => ['alias' =>  'date']])->label("<font color='#FF0000'>*</font> <b>Data de Nascimento:</b>")
        ?>
        
        <?= $form->field($model, 'sexo', ['options' => ['class' => 'col-md-3']])->radioList(['M' => 'Masculino', 'F' => 'Feminino'])->label("<font color='#FF0000'>*</font> <b>Sexo:</b>") ?>
    </div>
    <div class ="row">
        <?= $form->field($model, 'nomesocial', ['options' => ['class' => 'col-md-6']])->textInput() ?>

        <?= $form->field($model, 'cep', ['options' => ['class' => 'col-md-4']])->widget(MaskedInput::className(), [
    'mask' => '99999-999'])->label("<font color='#FF0000'>*</font> <b>CEP:</b>") ?>

        <?= $form->field($model, 'uf', ['options' => ['class' => 'col-md-2']])->dropDownList($ufs, ['prompt' => 'Selecione UF:'])->label("<font color='#FF0000'>*</font> <b>Estado:</b>") ?>
    </div>
    <div class ="row">

        <?= $form->field($model, 'cidade', ['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true])->label("<font color='#FF0000'>*</font> <b>Cidade:</b>") ?>

        <?= $form->field($model, 'endereco', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true])->label("<font color='#FF0000'>*</font> <b>Endereço:</b>") ?>

        <?= $form->field($model, 'bairro', ['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true])->label("<font color='#FF0000'>*</font> <b>Bairro:</b>") ?>
    </div>
    <div class ="row">
        <?= $form->field($model, 'nacionalidade', ['options' => ['class' => 'col-md-12']])->radioList(['1' => 'Brasileira', '2' => 'Estrangeira'])->label("<font color='#FF0000'>*</font> <b>Nacionalidade:</b>") ?>

        <div id="divEstrangeiro" style='display: none;'>
            <p align="justify" class="col-md-12"><b>Estes campos são obrigatórios para candidatos com nacionalidade Estrangeira</b></p>
            
            <?= $form->field($model, 'pais', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true])->label("<font color='#FF0000'>*</font> <b>País:</b>") ?>

            <?= $form->field($model, 'passaporte', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true])->label("<font color='#FF0000'>*</font> <b>Passaporte:</b>") ?>
        </div>
        <div id="divBrasileiro" style="display: none;">
            <p align="justify" class="col-md-12"><b>Estes campos são obrigatórios para candidatos com nacionalidade Brasileira</b></p>
            <?= $form->field($model, 'cpf', ['options' => ['class' => 'col-md-3']])->widget(MaskedInput::className(), [
        'mask' => '999.999.999-99'])->label("<font color='#FF0000'>*</font> <div style='display:inline;' id = 'corCPF'><b>CPF:</b> </div>") ?>   
            <div id = "errocpf" style="color:#a94442; display:none;"> CPF é campo obrigatório para brasileiros </div>
        </div>
    </div>
<!-- Fim da Identificação do Candidato -->
    <div style="clear: both;"><legend>Telefones para Contato</legend></div>
    <div class = "row">
    <?= $form->field($model, 'telresidencial', ['options' => ['class' => 'col-md-3']])->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '(99) 99999-9999'])->label("<font color='#FF0000'>*</font> <b>Telefone Principal:</b>") ?>

    <?= $form->field($model, 'telcelular', ['options' => ['class' => 'col-md-3']])->widget(MaskedInput::className(), [
    'mask' => '(99) 99999-9999'])->label("Telefone Alternativo:") ?>
    </div>

    <div style="clear: both;"><legend>Dados do PosComp</legend></div>
    <div class = "row">
        <?= $form->field($model, 'inscricaoposcomp', ['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true])->label("Nº de Inscrição:") ?>

        <?= $form->field($model, 'anoposcomp', ['options' => ['class' => 'col-md-4']])->textInput()->label("Ano:") ?>

        <?= $form->field($model, 'notaposcomp', ['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true])->label("Nota:") ?>
    </div>

    <div style="clear: both;"><legend>Dados da Inscrição</legend></div>
    
    <div class = "row">
        <?php if($editalCurso == 3){ ?>
            <?= $form->field($model, 'cursodesejado', ['options' => ['class' => 'col-md-5']])->radioList(['1' => 'Mestrado', '2' => 'Doutorado'])->label("<font color='#FF0000'>*</font> <b>Curso Desejado:</b>") ?>
        <?php } ?>

        <?= $form->field($model, 'regime', ['options' => ['class' => 'col-md-5']])->radioList(['1' => 'Integral', '2' => 'Parcial'])->label("<font color='#FF0000'>*</font> <b>Regime de Dedicação:</b>") ?>
    </div>

    <div class = "row">
        <?= $form->field($model, 'cotas', ['options' => ['class' => 'col-md-5']])->widget(SwitchInput::classname(), [
            'pluginOptions' => [
                'onText' => 'Sim',
                'offText' => 'Não',
        ]])->label("<font color='#FF0000'>*</font> <b>Cotista?</b>") ?>

        <div id="divCotas" style="display: <?= $hideCotas ?>">
            <?= $form->field($model, 'cotaTipo', ['options' => ['class' => 'col-md-5']])->dropDownList($cotas, ['prompt' => 'Selecione uma Opção..'])->label("<font color='#FF0000'>*</font> <b>Tipo de Cota:</b>") ?>
        </div>    
    </div>
    <div class = "row">
        <?= $form->field($model, 'deficiencia', ['options' => ['class' => 'col-md-5']])->widget(SwitchInput::classname(), [
            'pluginOptions' => [
                'onText' => 'Sim',
                'offText' => 'Não',
        ]])->label("<font color='#FF0000'>*</font> <b>Possui algum tipo de deficiência?</b>") ?>

        <div id="divDeficiencia" style="display: <?= $hideDeficiencia ?>">
            <?= $form->field($model, 'deficienciaTipo', ['options' => ['class' => 'col-md-5']])->textInput(['maxlength' => true])->label("<b>Qual?</b>")
			
			//$form->field($model, 'deficienciaTipo', ['options' => ['class' => 'col-md-5']])->dropDownList($deficiencias, ['prompt' => 'Selecione uma deficiência'])->label("<font color='#FF0000'>*</font> <b>Qual?</b>") ?>
        </div>
    </div>

    <div class = "row">
        <?= $form->field($model, 'solicitabolsa', ['options' => ['class' => 'col-md-5']])->widget(SwitchInput::classname(), [
            'pluginOptions' => [
                'onText' => 'Sim',
                'offText' => 'Não',
        ]])->label("<font color='#FF0000'>*</font> <b>Solicita Bolsa de Estudo?</b>") ?>
    </div>

</div>

    <div class="form-group" style="margin-top:10px">
        <?= Html::submitButton('<img src="img/forward.gif" border="0" height="32" width="32"><br><b>Salvar e Continuar</b>' , ['class' => 'btn btn-default col-md-12']) ?>
    </div>

    <?php ActiveForm::end(); ?>


