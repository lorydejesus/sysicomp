<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Candidato */

$this->title = 'Formulário de Inscrição no Mestrado/Doutorado no PPGI/UFAM - Realizar Cadastro';
$this->params['breadcrumbs'][] = ['label' => 'Editais', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Realizar Cadastro";
?>

<div class="candidato-create">

    <?= $this->render('_form0', [
        'model' => $model,
        'edital'=> $edital,
    ]) ?>

</div>