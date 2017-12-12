<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\SwitchInput;
use yii\widgets\MaskedInput;
use dbfernandes\icomp\ICompToggleWidget;

$uploadEdital = 0;

if(isset($model->documento))
	$uploadEdital = 1;

?>

<div class="edital-form">
	<div class="grid">
	    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    	<input type='hidden' id = 'form_mestrado' value =<?= $model->mestrado ?> />
    	<input type='hidden' id = 'form_doutorado' value =<?= $model->doutorado?> />
    	<input type="hidden" id = "form_upload" value = '<?=$uploadEdital?>' />
	    <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><b>Dados do Edital</b></h3>
            </div>
            <div class="panel-body">
				<div class="row">
				<?= $form->field($model, 'numero', ['options' => ['class' => 'col-md-5']])->widget(MaskedInput::className(), [
				'mask' => '999-9999'])->hint('Ex.: 001-'.date("Y").', sendo o <b>\'001\'</b> o número do edital e <b>\''.date("Y").'\'</b> o ano')->textInput(['readonly' => $read ])->label("<font color='#FF0000'>*</font> <b>Número do edital:</b>") ?>
				<?= $form->field($model, 'documento', ['options' => ['class' => 'col-md-5']])->hint('Ex.: http://www.propesp.ufam.edu.br')->label("<font color='#FF0000'>*</font> <b>URL do  edital:</b>") ?>
				</div>
				<div class="row">
				<?= $form->field($model, 'datainicio', ['options' => ['class' => 'col-md-5']])->widget(DatePicker::classname(), [
	                'language' => Yii::$app->language,
	                'options' => ['placeholder' => 'Selecione a Data de Início ...',],
				    'pluginOptions' => [
				        'format' => 'dd/mm/yyyy',
				        'todayHighlight' => true
				    ]
		        ])->label("<font color='#FF0000'>*</font> <b>Data de Início das Inscrições:</b>")
				?>
				<?= $form->field($model, 'datafim', ['options' => ['class' => 'col-md-5']])->widget(DatePicker::classname(), [
	                'language' => Yii::$app->language,
	                'options' => ['placeholder' => 'Selecione a Data de Término ...',],
				    'pluginOptions' => [
				        'format' => 'dd/mm/yyyy',
				        'todayHighlight' => true
				    ]
				])->label("<font color='#FF0000'>*</font> <b>Data de Término das Inscrições:</b>")
				?>
				</div>
			</div>
        </div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><b>Configuração da Inscrição e Vagas</b></h3>
			</div>
			<div class="panel-body">
			    <div class="row">

					<?= $form->field($model, 'cartarecomendacao', ['options' => ['class' => 'col-md-1']])->widget(ICompToggleWidget::className(), [
						'labelEnabled' => 'Sim',
						'labelDisabled' => 'Não',
					])->label("<font color='#FF0000'>*</font> <b>Carta de Recomendação?</b>") ?> 					

					<?= $form->field($model, 'cartaorientador', ['options' => ['class' => 'col-md-1']])->widget(ICompToggleWidget::className(), [
						'labelEnabled' => 'Sim',
						'labelDisabled' => 'Não',
					])->label("<font color='#FF0000'>*</font> <b>Carta Orientador?</b>") ?>

				</div>
			    <div class="row">

					<?= $form->field($model, 'mestrado', ['options' => ['class' => 'col-md-1']])->widget(ICompToggleWidget::className(), [
						'labelEnabled' => 'Sim',
						'labelDisabled' => 'Não',
					])->label("<font color='#FF0000'>*</font> <b>Mestrado?</b>") ?>

					<div id="divVagasMestrado" style="display:none">
						<?= $form->field($model, 'vagas_mestrado', ['options' => ['class' => 'col-md-3']])->textInput(['type' => 'number', 'maxlength' => true])->label("<font 	color='#FF0000'>*</font> <b>Vagas Regulares para Mestrado:</b>") ?>

						<?= $form->field($model, 'cotas_mestrado', ['options' => ['class' => 'col-md-3']])->textInput(['type' => 'number'])->label("<font color='#FF0000'>*</font> <b>Vagas Suplementares para Mestrado:</b>") ?>
					</div>

				</div>
				<div class="row">

					<?= $form->field($model, 'doutorado', ['options' => ['class' => 'col-md-1']])->widget(ICompToggleWidget::className(), [
						'labelEnabled' => 'Sim',
						'labelDisabled' => 'Não',
					])->label("<font color='#FF0000'>*</font> <b>Doutorado?</b>") ?>	

					<div id="divVagasDoutorado" style="display:none">
						<?= $form->field($model, 'vagas_doutorado', ['options' => ['class' => 'col-md-3']])->textInput(['type' => 'number', 'maxlength' => true])->label("<font color='#FF0000'>*</font> <b>Vagas Regulares para Doutorado:</b>") ?>

						<?= $form->field($model, 'cotas_doutorado', ['options' => ['class' => 'col-md-3']])->textInput(['type' => 'number'])->label("<font color='#FF0000'>*</font> <b>Vagas Suplementares para Doutorado:</b>") ?>
					</div>
				</div>
		    </div>
        </div>

	    <div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-ok-sign"></span> Criar Edital' : '<span class="glyphicon glyphicon-ok-sign"></span> Alterar Edital', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>


</div>
