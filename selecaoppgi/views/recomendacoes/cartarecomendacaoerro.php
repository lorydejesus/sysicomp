<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Recomendacoes */

$this->title ='Erro ao abrir Página';
?>
<div class="recomendacoes-create">

	<hr align='tr'>
    <div class="alert alert-warning" role="alert">
	  <span class="sr-only">Error:</span>
	<h4><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> <?= $erro['titulo'] ?></h4>	
    </div>

    <?= $erro['menssagem'] ?>
    
    <hr align='tr'>

</div>
