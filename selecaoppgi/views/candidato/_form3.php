<?php
use xj\bootbox\BootboxAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use app\models\LinhaPesquisa;
use yii\helpers\ArrayHelper;
use kartik\widgets\SwitchInput;

BootboxAsset::register($this);
BootboxAsset::registerWithOverride($this);

$this->title = "Proposta de Trabalho e Documentos";

$uploadRealizados = 0;

if(isset($model->proposta))
    $uploadRealizados = 1;

if(isset($model->comprovantepagamento))
    $uploadRealizados += 2;

if(isset($model->cartaorientador))
    $uploadRealizados += 4;

if(!isset($model->cartaNome[0]) || $model->cartaNome[0] == ""){
    $hideCartaRecomendacao0 = 'none';
}else{
    $hideCartaRecomendacao0 = 'block';
}

if(!isset($model->cartaNome[1]) || $model->cartaNome[1] == ""){
    $hideCartaRecomendacao1 = 'none';
}else{
    $hideCartaRecomendacao1 = 'block';
}

if(!isset($model->cartaNome[2]) || $model->cartaNome[2] == ""){
    $hideCartaRecomendacao2 = 'none';
}else{
    $hideCartaRecomendacao2 = 'block';
}

?>

<div class="candidato-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

        <input type='hidden' id = 'form_hidden' value ='passo_form_3'/>
        <input type='hidden' id = 'form_carta' value ='<?= $model->edital->cartarecomendacao ?>'/>
        <input type='hidden' id = 'form_upload' value ='<?= $uploadRealizados ?>'/>

    <div style="clear: both;"><legend>Proposta do Candidato</legend></div>

   <div class="row">
        <?= $form->field($model, 'idLinhaPesquisa', ['options' => ['class' => 'col-md-5']])->dropDownlist($linhasPesquisas, ['prompt' => 'Selecione uma Linha de Pesquisa'])->label("<font color='#FF0000'>*</font> <b>Linha de Pesquisa:</b>") ?>

        <?= $form->field($model, 'tituloproposta', ['options' => ['class' => 'col-md-7']])->textInput(['maxlength' => true])->label("<font color='#FF0000'>*</font> <b>Titulo da Proposta:</b>") ?>
    </div>

    <?php if($model->edital->cartarecomendacao == 1){ ?>
        <div style="clear: both;"><legend>Carta de Recomendação</legend></div>
        <div class="row">
            <p align="justify" style="padding-left: 10px;">Você precisa apenas preencher corretamente o nome e email das pessoas que devem fornecer as cartas de recomendação. Feito isso, assim que você finalizar e submeter sua inscrição os indicados receberão um email com as instruções de como preencher de forma online sua carta de recomendação. Ao menos 2 nomes são obrigatórios.</p>
        </div>
            
        <div class="row">
            <?= $form->field($model, 'cartaNomeReq1', ['options' => ['class' => 'col-md-5']])->textInput()->label("<font color='#FF0000'>*</font> <b>Nome:</b>") ?>
            
            <?= $form->field($model, 'cartaEmailReq1', ['options' => ['class' => 'col-md-5']])->textInput()->label("<font color='#FF0000'>*</font> <b>Email:</b>") ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'cartaNomeReq2', ['options' => ['class' => 'col-md-5']])->textInput()->label("<font color='#FF0000'>*</font> <b>Nome:</b>") ?>

            <?= $form->field($model, 'cartaEmailReq2', ['options' => ['class' => 'col-md-5']])->textInput()->label("<font color='#FF0000'>*</font> <b>Email:</b>") ?>
        </div>
        <div class="row" id="divCartaRecomendacao0" style="display: <?= $hideCartaRecomendacao0?>">
            <?= $form->field($model, 'cartaNome[0]', ['options' => ['class' => 'col-md-5']])->textInput()->label("<b>Nome:</b>") ?>

            <?= $form->field($model, 'cartaEmail[0]', ['options' => ['class' => 'col-md-5']])->textInput()->label("<b>Email:</b>") ?>
    
            <?= Html::button("<span class='glyphicon glyphicon-remove'></span>", ['id' => 'removerCartaRecomendacao0', 'class' => 'btn btn-danger col-md-1 col-xs-12', 'style' => 'margin-top: 25px;']); ?>
        </div>
        <div class="row" id="divCartaRecomendacao1" style="display: <?= $hideCartaRecomendacao1?>">
            <?= $form->field($model, 'cartaNome[1]', ['options' => ['class' => 'col-md-5']])->textInput()->label("<b>Nome:</b>") ?>

            <?= $form->field($model, 'cartaEmail[1]', ['options' => ['class' => 'col-md-5']])->textInput()->label("<b>Email:</b>") ?>

            <?= Html::button("<span class='glyphicon glyphicon-remove'></span>", ['id' => 'removerCartaRecomendacao1', 'class' => 'btn btn-danger col-md-1 col-xs-12', 'style' => 'margin-top: 25px;']); ?>
        </div>
        <div class="row" id="divCartaRecomendacao2" style="display: <?= $hideCartaRecomendacao2 ?>">
            <?= $form->field($model, 'cartaNome[2]', ['options' => ['class' => 'col-md-5']])->textInput()->label("<b>Nome:</b>") ?>    
            
            <?= $form->field($model, 'cartaEmail[2]', ['options' => ['class' => 'col-md-5']])->textInput()->label("<b>Email:</b>") ?>

            <?= Html::button("<span class='glyphicon glyphicon-remove'></span>", ['id' => 'removerCartaRecomendacao2', 'class' => 'btn btn-danger col-md-1 col-xs-12', 'style' => 'margin-top: 25px;']); ?>
        </div>
        <p>
            <?= Html::button("<span class='glyphicon glyphicon-plus'></span>", ['id' => 'maisCartasRecomendacoes', 'class' => 'btn btn-default btn-lg btn-success']); ?>
        </p>
    <?php } ?>

    <div class="row">

        <?= $form->field($model, 'motivos')->textarea(['maxlength' => true, 'id' => 'txtMotivos', 'rows' => 6])->label("<font color='#FF0000'>*</font> <b> Descreva os motivos que o levaram a se candidatar ao curso (<span class='caracteres'>1000</span> Caracteres Restantes): </b>") ?>
    </div>

    <div class="row" style="padding: 3px 3px 3px 3px">
        <?php 

        if($model->cartaOrientador($model->idEdital) ){
			
			if($model->cursodesejado == 2 )
				echo "<input type='hidden' id = 'form_ignorarRequiredCartaOrientador' value ='0'/>";
			else
				echo "<input type='hidden' id = 'form_ignorarRequiredCartaOrientador' value ='1'/>";

			if(isset($model->cartaorientador)){
                echo "<div style= padding: 3px 3px 3px 3px' class='col-md-8'> <b>Carta de Aceite do Orientador:<br> 
                    Você já fez o upload da Carta do Orientador, <a href=index.php?r=candidato/pdf&documento=".$model->cartaorientador.">clique aqui </a>para visualizá-la.</b><br></div>";
                
                echo $form->field($model, 'cartaOrientadorUpload', ['options' => ['class' => 'col-md-5']])->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    ]])->label("<font color='#FF0000'>*</font> <b>Deseja mudar o arquivo?</b>");

            }
            else{

                echo $form->field($model, 'cartaOrientadorFile')->FileInput(['accept' => '.pdf'])->label("<b>Carta de Aceite do Orientador (obrigatório para doutorado):</b>");
		echo "Download do modelo de carta de orientador: <a target='_blank' href='documentos/carta_aceite_orientador.docx'><img src='img/doc-icon.gif' border='0' height='16' width='16'></a>";
            }
        }
        else{

            echo "<input type='hidden' id = 'form_ignorarRequiredCartaOrientador' value = '1' />";

        }

        ?>
    </div>
    <div class="row">
        <?php if(isset($model->cartaOrientador)){ ?>
            <div id="divHistoricoFile" style="display: none; clear: both;">
                <?= $form->field($model, 'cartaOrientadorFile')->FileInput(['accept' => '.pdf'])->label(false); ?>
                <div style='border-bottom:solid 1px'> </div>
            </div>
        <?php } ?>
    </div>

    <div class="row">
        <?php 
            if(isset($model->proposta)){
                  echo "<div style= padding: 3px 3px 3px 3px' class='col-md-8'><b><b>Proposta de Trabalho:</b><br>Você já fez o upload da sua proposta, <a href=index.php?r=candidato/pdf&documento=".$model->proposta.">clique aqui </a>para visualizá-la.</b><br></div>";
                echo $form->field($model, 'propostaUpload', ['options' => ['class' => 'col-md-5']])->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    ]])->label("<font color='#FF0000'>*</font> Deseja mudar o arquivo?");
            }else{
                echo $form->field($model, 'propostaFile')->FileInput(['accept' => '.pdf'])->label("<font color='#FF0000'>*</font> Proposta de Trabalho:");
		echo "Download do modelo de proposta de projeto: <a target='_blank' href='documentos/ppgi_form_proposta.docx'><img src='img/doc-icon.gif' border='0' height='16' width='16'></a>";
            }
        ?>
    </div>
    <?php if(isset($model->proposta)){ ?>
        <div class="row" id="divPropostaFile" style="display: none; margin-bottom: 5px;">
            <?= $form->field($model, 'propostaFile')->FileInput(['accept' => '.pdf'])->label(false);?>
            <div style='border-bottom:solid 1px'></div>
        </div>
    <?php } ?>

    <div class="row">
        <?php 
        if(isset($model->comprovantepagamento)){
             echo "<div style= padding: 3px 3px 3px 3px' class='col-md-8'><b><b>Comprovante de Pagamento da taxa de inscrição (Comprovante emitido por bancos e lotéricas):</b><br>Você já fez o upload do seu comprovante de pagamento, <a href=index.php?r=candidato/pdf&documento=".$model->comprovantepagamento.">clique aqui </a>para visualizá-lo.</b><br></div>";
            
            echo $form->field($model, 'comprovanteUpload', ['options' => ['class' => 'col-md-5']])->widget(SwitchInput::classname(), [
            'pluginOptions' => [
                'onText' => 'Sim',
                'offText' => 'Não',
                ]])->label("<font color='#FF0000'>*</font> Deseja mudar o arquivo?");
        }else{
            echo $form->field($model, 'comprovanteFile')->FileInput(['accept' => '.pdf'])->label("<font color='#FF0000'>*</font> <b>Comprovante de Pagamento: </b>");
        }
        ?>
    </div>
    <?php if(isset($model->comprovantepagamento)){ ?>
        <div id="divComprovanteFile" style="display: none; margin-bottom: 5px;">
            <?= $form->field($model, 'comprovanteFile')->FileInput(['accept' => '.pdf'])->label(false);?>
            <div style='border-bottom:solid 1px;'></div>
        </div>
    <?php } ?>

    <div class="form-group">
        <?= Html::a('<img src="img/back.gif" border="0" height="32" width="32"><br><b> Passo Anterior</b>', ['candidato/passo2'], ['class' => 'btn btn-default col-md-4 col-xs-12']) ?>
        <?= Html::submitButton('<img src="img/save.png" border="0" height="32" width="32"><br><b>Salvar</b>', ['class' => 'btn btn-default col-md-4 col-xs-12', 'name' => 'salvar']) ?>

        <?= Html::submitButton('<img src="img/forward.gif" border="0" height="32" width="32"><br><b>Salvar e Finalizar</b>', ['name' => 'finalizar', 'class' => 'btn btn-default col-md-4 col-xs-12',
            'data' => [
                'confirm' => 'Finalizar a sua inscrição? Após esse passo seus dados serão submetidos para avaliação e não poderão ser alterados.',
            ]]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
