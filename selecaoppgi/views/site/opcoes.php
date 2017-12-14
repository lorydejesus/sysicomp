<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Edital;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Formulário de Inscrição no Processo Seletivo para Mestrado/Doutorado - PPGI/UFAM';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

?>
<?= Yii::$app->view->renderFile('@app/views/layouts/mensagemFlash.php') ?>
        
<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <!--
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Selecionar um Edital</h4>
      </div>
      <div class="modal-body">
                <?php //echo $form->field($model, 'idEdital', ['options' => ['class' => 'col-md-10']])->dropDownList(ArrayHelper::map(Edital::find()->all(),'numero','numero'),['prompt'=>'Selecione o Edital'])->label("<font color='#FF0000'>*</font> <b>Selecione um Edital:</b>") ; ?>
                <?= $form->field($model, 'idEdital', ['options' => ['class' => 'col-md-10']])->dropDownList(ArrayHelper::map(Edital::find()->all(),'numero','numero'))->label("<font color='#FF0000'>*</font> <b>Selecione um Edital:</b>") ; ?>
      </div>
      <br><br><br>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Continuar</button>
      </div>
      -->

    </div>
  </div>
</div>

<div class="login-box">
    <div class="login-logo">
        <p align="center"><h3>Formulário de Inscrição no Processo Seletivo para Mestrado/Doutorado - PPGI/UFAM</h3></p>
    </div>
    <div style="margin-bottom: 10px;">    
        <font size="2" style="line-height: 150%">
        <p align="justify"><ul>

        </ul></p>
        </font>
    </div>
    <hr style="width: 100%; height: 2px;">

    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg" style= "text-align:left">
        <div style="margin-left:0px; margin-bottom:8px"> Candidato, clique em: </div>
         <li> 
            <b>Nova Inscrição</b>: caso você ainda não tenha iniciado a inscrição. Lembrando que para cada edital do PPGI deve ser realizada uma inscrição independente.
         </li>
         <li> 
            <b>Continuar Inscrição</b>: caso você já tenha iniciado a inscrição, porém ainda não a finalizou.
         </li>
         </p>
         <br>



        <div class="row">

            <div class=" col-sm-6 col-xs-12">
                <?= Html::a('Nova Inscrição', ['site/cadastroppgi'], ['class' => 'btn btn-primary btn-block btn-flat']) ?><br>
            </div>
            <!-- /.col -->
            <div class=" col-sm-6 col-xs-12">
                <?= Html::a('Continuar Inscrição', ['site/login'], ['data-target'=>'#myModal','data-toggle'=> 'modal' ,'class' => 'btn btn-success btn-block btn-flat']) ?><br>
            </div>
            <!-- /.col -->
        </div>
        <?php ActiveForm::end(); ?>

    </div>

    <!-- /.login-box-body -->
</div><!-- /.login-box -->


