<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\StarRating;
use yii\web\JsExpression;

$titulacao = ['1' => 'Mestrado', '2' => 'Doutorado', '3' => 'Epecialização', '4' => 'Graduação', '5' => 'Ensino Médio'];
$atributos = ['1' => '1 - Fraco', '2' => '2 - Regular', '3' => '3 - Bom', '4' => '4 - Muito Bom', '5' => '5 - Excelente', '6' => 'X - Sem Condições de Informar'];
$funcoesCarta = ['1' => 'Orientador', '2' => 'Professor', '3' => 'Empregador', '4' => 'Coordenador',  '5' => 'Colega de Curso', '6' => 'Colega de Trabalho', '7' => 'Outros'];
$conheceLista = ['1' => 'Curso Graduação', '2' => 'Curso de Pós-Graduação', '3' => 'Empresa', '4' => 'Outros'];

echo 
"<style type='text/css'>
label{
    font-weight: inherit !important;
}
</style>";
?>

<div class="recomendacoes-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <?= $form->field($model, 'nome', ['options' =>['class' => 'col-md-8']])->textInput(['maxlength' => true])->label("<font color='#FF0000'>*</font> <b>Nome:</b>") ?>

        <?= $form->field($model, 'titulacao', ['options' =>['class' => 'col-md-4']])->dropDownList($titulacao, ['prompt' => 'Selecione uma Titulação'])->label("<font color='#FF0000'>*</font> <b>Titulação:</b>") ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'instituicaoTitulacao', ['options' =>['class' => 'col-md-8']])->textInput(['maxlength' => true])->label("<font color='#FF0000'>*</font> <b>Instituição onde obteve o título:</b>") ?>

        <?= $form->field($model, 'anoTitulacao', ['options' =>['class' => 'col-md-4']])->textInput(['type' => 'number'])->label("<font color='#FF0000'>*</font> <b>Ano de Titulação:</b>") ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'instituicaoAtual', ['options' =>['class' => 'col-md-8']])->textInput(['maxlength' => true])->label("<font color='#FF0000'>*</font> <b>Instituição Atual:</b>") ?>

        <?= $form->field($model, 'cargo', ['options' =>['class' => 'col-md-4']])->textInput(['maxlength' => true])->label("<font color='#FF0000'>*</font> <b>Cargo Atual:</b>") ?>
    </div>
    
    <div class="row">
        
        <?= $form->field($model, 'anoContato', ['options' =>['class' => 'col-md-2']])->textInput()->label("<font color='#FF0000'>*</font> <b>Conheço desde o ano:</b>") ?>

        <?= $form->field($model, 'conhece', ['options' =>['class' => 'col-md-6']])->checkboxList($conheceLista)->label("<font color='#FF0000'>*</font> <b>Por Meio de :</b>") ?>

        <?= $form->field($model, 'outrosLugares', ['options' =>['class' => 'col-md-3', 'style' => 'display: none', 'id' => 'outroslugarestexto']])->textInput()->label("<b>Especifique quais outros: </b>") ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'funcoesCartaArray', ['options' =>['class' => 'col-md-8']])->checkboxList($funcoesCarta)->label("<font color='#FF0000'>*</font> <b>Com relação ao candidato, fui seu:</b>") ?>


        <?= $form->field($model, 'outrasFuncoes', ['options' =>['class' => 'col-md-3', 'style' => 'display: none', 'id' => 'outrasfuncoestexto']])->textInput()->label('<b>Especifique quais outras:</b>') ?>
    </div>
    <div  class="row" class="col-md-12">
        <p align="justify"><b>Como classifica o candidato quanto aos atributos indicados no quadro abaixo:</b></p>

        <div class="col-md-8">
            <font color='#FF0000'>*</font> <b>Domínio em sua área de conhecimento cientifico</b>
        </div>
        <?= $form->field($model, 'dominio', ['options' =>['class' => 'col-md-4']])->dropDownList($atributos, ['prompt' => 'Selecione um Nível'])->label(false)  ?>

        <div class="col-md-8">
            <font color='#FF0000'>*</font> <b>Facilidade de aprendizado capacidade intelectual</b>
        </div>
        <?= $form->field($model, 'aprendizado', ['options' =>['class' => 'col-md-4']])->dropDownList($atributos, ['prompt' => 'Selecione um Nível'])->label(false) ?>

        <div class="col-md-8">
            <font color='#FF0000'>*</font> <b>Assiduidade, perseverança</b>
        </div>
        <?= $form->field($model, 'assiduidade', ['options' =>['class' => 'col-md-4']])->dropDownList($atributos, ['prompt' => 'Selecione um Nível'])->label(false) ?>

        <div class="col-md-8">
            <font color='#FF0000'>*</font> <b>Relacionamento com colegas e superiores</b>
        </div>
        <?= $form->field($model, 'relacionamento', ['options' =>['class' => 'col-md-4']])->dropDownList($atributos, ['prompt' => 'Selecione um Nível'])->label(false) ?>

        <div class="col-md-8">
            <font color='#FF0000'>*</font> <b>Iniciativa, desembaraço, originalidade e liderança</b>
        </div>
        <?= $form->field($model, 'iniciativa', ['options' =>['class' => 'col-md-4']])->dropDownList($atributos, ['prompt' => 'Selecione um Nível'])->label(false) ?>
        <div class="col-md-8">
            <font color='#FF0000'>*</font> <b>Capacidade de expressão escrita</b>
        </div>
        <?= $form->field($model, 'expressao', ['options' =>['class' => 'col-md-4']])->dropDownList($atributos, ['prompt' => 'Selecione um Nível'])->label(false) ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p align="justify"><font color="#FF0000">*</font> <b>Comparando este candidato com outros alunos ou profissionais, com similar n&#237;vel de educa&#231;&#227;o e experi&#234;ncia, que conheceu nos &#250;ltimos 2 anos, classifique a sua aptid&#227;o para realizar estudos avan&#231;ados e pesquisas. O candidato est&#225; entre (indique uma das alternativas):</b></p>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'classificacao')->radioList(['3.0' => 'os 5% mais aptos', '2.0' => 'os 10% mais aptos', '1.5' => 'os 30% mais aptos', '1.0' => 'os 50% mais aptos'])->label(false) ?>
        </div>
    </div>    

    <?= $form->field($model, 'informacoes')->textarea(['rows' => 6])->label("<font color='#FF0000'>*</font> <b>Informações:</b><br><br> <p align='justify'>Estamos particularmente interessados na avalia&#231;&#227;o do potencial do candidato para estudos, pesquisa e desenvolvimento na &#225;rea de Inform&#225;tica. Uma descri&#231;&#227;o detalhada dos pontos positivos e negativos do desempenho do candidato em atividades acad&#234;micas e/ou profissionais ser&#227;o mais &#250;teis do que coment&#225;rios gen&#233;ricos. Coment&#225;rios sobre car&#225;ter, integridade e motiva&#231;&#227;o ser&#227;o &#250;teis, se julgados pertinentes. A experi&#234;ncia na qual a opini&#227;o do avaliador se baseou tamb&#233;m deve ser descrita. Se poss&#237;vel, compare o candidato com outras pessoas que tenham o mesmo n&#237;vel de forma&#231;&#227;o/experi&#234;ncia. As informa&#231;&#245;es s&#227;o confidenciais.</p>") ?>


    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary', 'name' => 'salvar']) ?>
        <?= Html::submitButton('Enviar Carta', ['class' => 'btn btn-success', 'name' => 'enviar']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
