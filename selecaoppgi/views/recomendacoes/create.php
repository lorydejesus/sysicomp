<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Recomendacoes */

$this->title = 'Carta de Recomendação para de Inscrição no Mestrado/Doutorado no PPGI/UFAM';

?>
<div class="recomendacoes-create">

    <h2><?=$this->title?></h2>

    <hr style="width: 100%; height: 2px;">
	<ul>
	<li><b>Nome do Candidato:</b> <?php echo $model->candidato->nome;?></li>
	<li><b>Graduado em:</b> <?php echo $model->candidato->cursograd." - ".$model->candidato->instituicaograd;?></li>
	<li><b>Prazo para envio desta carta:</b> <?php echo date('d-M-Y', strtotime($model->prazo));?></li></ul>
	<hr style="width: 100%; height: 2px;">
	 <p align="justify">Desejamos ter sua opini&#227;o sobre o candidato que se inscrever&#225; no Programa de P&#243;s-Gradua&#231;&#227;o Stricto Sensu em Inform&#225;tica desta Universidade. Estas informa&#231;&#245;es, de car&#225;ter CONFIDENCIAL, s&#227;o necess&#225;rias para que possamos julgar a aceita&#231;&#227;o ou n&#227;o do candidato como aluno. <font color="#FF0000">(*) Campos obrigat&#243;rios.</font> </p>
	<hr style="width: 100%; height: 2px;">
	<fieldset>
	<p align="justify"><b>Dados da pessoa que fornecer&#225; as refer&#234;ncias sobre o candidato:</b></p>
	</fieldset>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
