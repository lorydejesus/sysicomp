<script type="text/javascript" >

function tirarRequired(){
    document.getElementById("ignorarRequired").value = 1;
    var x = document.getElementById("ignorarRequired").value;
}

function colocarRequired(){
    document.getElementById("ignorarRequired").value = 0;
    var x = document.getElementById("ignorarRequired").value;
}

</script>

<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\widgets\MaskedInput;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use yii\bootstrap\Collapse;
use yii\bootstrap\Modal;
use kartik\widgets\SwitchInput;

$uploadRealizados = 0;
$uploadXML = 0;

if(count($itensPeriodicos) + count($itensConferencias) > 0){
    $uploadXML = 1;
    $hidePublicacoes = 'block';
    $hideInputPublicacoes = 'none';
}else{
    $hidePublicacoes = 'none';
    $hideInputPublicacoes = 'block';
}

if(isset($model->curriculum))
    $uploadRealizados = 2;

if($model->instituicaoacademica2 == ""){
    $hideInstituicao2 = 'none';
}else{
    $hideInstituicao2 = 'block';
}

if($model->instituicaoacademica3 == ""){
    $hideInstituicao3 = 'none';
}else{
    $hideInstituicao3 = 'block';
}

?>
<div class="candidato-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

        <input type="hidden" id = "form_hidden" value ="passo_form_2"/>
        <input type="hidden" id = "form_upload" value = '<?=$uploadRealizados?>' />
        <input type="hidden" id = "form_uploadxml" value = '<?= $uploadXML ?>' />
        

    <div style="clear: both;"><legend>Curso de Graduação</legend></div>

    <div class="row">
        <?= $form->field($model, 'cursograd', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true])->label("<font color='#FF0000'>*</font> <b>Curso:</b>") ?>

        <?= $form->field($model, 'instituicaograd', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true])->label("<font color='#FF0000'>*</font> <b>Instituição:</b>") ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'egressograd', ['options' => ['class' => 'col-md-3']])->widget(MaskedInput::className(), [
    'mask' => '9999'])->label("<font color='#FF0000'>*</font> <b>Ano de Egresso:</b>") ?>
    </div>
    
    <div style="clear: both;"><legend>Curso de Pós-Graduação Stricto-Senso</legend></div>

    <div class="row">
        <?= $form->field($model, 'cursopos', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true])?>

        <?= $form->field($model, 'tipopos', ['options' => ['class' => 'col-md-6 col-xs-12']])->radioList(['0' => 'Mestrado Acadêmico', '1' => 'Mestrado Profissional', '2' => 'Doutorado']) ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'instituicaopos', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true])?>

        <?= $form->field($model, 'egressopos',['options' => ['class' => 'col-md-2']] )->widget(MaskedInput::className(), [
        'mask' => '9999']) ?>
    </div>
    

    <div class="row">
        <?php 
        if(isset($model->curriculum)){
            echo "<div style= padding: 3px 3px 3px 3px' class='col-md-8'><b><b>Curriculum Vittae PDF (no formato Lattes - http://lattes.cnpq.br):</b><br>Você já fez o upload do seu curriculum, <a href=index.php?r=candidato/pdf&documento=".$model->curriculum.">clique aqui </a>para visualizá-lo.</b><br></div>";
            
            echo $form->field($model, 'curriculumUpload', ['options' => ['class' => 'col-md-5']])->widget(SwitchInput::classname(), [
            'pluginOptions' => [
                'onText' => 'Sim',
                'offText' => 'Não',
                ]])->label("<font color='#FF0000'>*</font> <b>Deseja mudar o arquivo?</b>");
        }else{
            echo $form->field($model, 'curriculumFile')->FileInput(['accept' => '.pdf'])->label("<font color='#FF0000'>*</font> <b>Curriculum Vittae PDF (no formato Lattes - http://lattes.cnpq.br):</b>");
        }
        ?>
    </div>
    <div class="row">
        <?php if(isset($model->curriculum)){ ?>
            <div id="divCurriculumFile" style="display: none; clear: both;">
                <?= $form->field($model, 'curriculumFile')->FileInput(['accept' => '.pdf'])->label(false);?>
                <div style='border-bottom:solid 1px'></div>
            </div>
        <?php } ?>

    </div>

    <div style="clear: both;"><legend>Publicações</legend></div>

    <div class="row">
        <?= $form->field($model, 'publicacoesFile', ['options' => ['class' => 'col-md-6']])->FileInput(['accept' => '.xml'])->label("<div><b>Curriculum Vittae XML no formato Lattes - http://lattes.cnpq.br</b> (Não incluir significa não ter publicações a serem contadas na seleção) :</div>") ?>

        <?= Html::submitButton('Enviar', ['onclick' =>  'tirarRequired()' , 'class' => 'btn btn-primary col-md-2', 'name' => 'enviar']) ?>

    </div>

    <div id="divPublicacoes" style="display: <?= $hidePublicacoes ?>;">
        <p>Foram encontradas total de <?= count($itensPeriodicos) + count($itensConferencias) ?> Publicações</p>

        <p><?= Html::button('Periódicos <span class=\'label label-primary\'>'.count($itensPeriodicos).'</span>', ['id' => 'btnPeriodicos', 'class' => 'btn btn-success'])?></p>

        <div id="divPeriodicos" style="display: none;">
            <?php if($hidePublicacoes != 'none')
                    echo  Collapse::widget(['items' => $itensPeriodicos,]);
                else
                    echo "<div>Nenhuma Publicação</div>";
            ?>
        </div>

        <p><?= Html::button('Conferências <span class=\'label label-primary\'>'.count($itensConferencias).'</span>', ['id' => 'btnConferencias', 'class' => 'btn btn-success']); ?></p>
        <div id="divConferencias" style="display: none;">
            <?php
                if($hidePublicacoes != 'none')
                    echo Collapse::widget(['items' => $itensConferencias,]);
                else
                    echo "<div>Nenhuma Publicação</div>";
            ?> 
        </div>
    </div>
    
    <div style="clear: both;"><legend>Experiência Acadêmica</b> (Monitoria, PIBIC, PET, Instutor, Professor)</legend></div>

    <div id="divInstituicoes">
        <div class="row">
            <?= $form->field($model, 'instituicaoacademica1', ['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'atividade1', ['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'periodoacademico1', ['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>

        </div>
        
        
        <div class="row" id="divInstituicao2" style="display: <?=$hideInstituicao2?>;">
            <?= $form->field($model, 'instituicaoacademica2', ['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'atividade2', ['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'periodoacademico2', ['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>

            <?= Html::button("<span class='glyphicon glyphicon-remove'></span>", ['id' => 'removerInstituicao2', 'class' => 'btn btn-danger col-md-1 col-xs-12', 'style' => 'margin-top: 25px;']); ?>
        </div>
        
       
       <div class="row" id="divInstituicao3" style="display: <?=$hideInstituicao3?>;">
            <?= $form->field($model, 'instituicaoacademica3', ['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'atividade3', ['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'periodoacademico3', ['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>

            <?= Html::button("<span class='glyphicon glyphicon-remove'></span>", ['id' => 'removerInstituicao3', 'class' => 'btn btn-danger col-md-1 col-xs-12', 'style' => 'margin-top: 25px;']); ?>
        </div>
    </div>
    <p>
        <?= Html::button("<span class='glyphicon glyphicon-plus'></span> Adicionar Experiência Acadêmica", ['id' => 'maisInstituicoes', 'class' => 'btn btn-default btn-md btn-success']); ?>
    </p>
    
    <div class="form-group">
        <?= Html::a('<img src="img/back.gif" border="0" height="32" width="32"><br><b> Passo Anterior</b>', ['candidato/passo1'], ['class' => 'btn btn-default col-md-6 col-xs-12']) ?>
        <?= Html::submitButton('<img src="img/forward.gif" border="0" height="32" width="32"><br><b>Salvar e Continuar</b>', 
        ['onclick' => 'colocarRequired()' ,'class' => 'btn btn-default col-md-6 col-xs-12', 'name' => 'prosseguir']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>