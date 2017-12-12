<?php

use yii\helpers\Html;

$this->title = "Histórico Acadêmico/Profissional";
?>
<div class="candidato-create">

<div class="checkout-wrap">
  <ul class="checkout-bar">

    <li class="visited first">
      <a href="index.php?r=candidato%2Fpasso1">Dados <br> Pessoais</a>
    </li>
    
    <li class="active">
        Histórico<br>Acadêmico/Profissional
    </li>
    
    <li class="next">Proposta de Trabalho <br> e Documentos</li>
    
    <li class="next"> Tela de<br> Confirmação</li>
       
  </ul>
  <br><br><br><br><br>
  <div style="border: 1px solid; margin-top: 20px;margin-bottom: 10px;">
    <h5>Número de Inscricao: <?= $model->numeroinscricao ?></h5>
    <h5>Tempo de Sessão: <span id="curTime">1440</span></h5>
  </div>

</div>

    <?= $this->render('_form2', [
        'model' => $model,
        'itensPeriodicos' => $itensPeriodicos,
        'itensConferencias' => $itensConferencias,
    ]) ?>

</div>
