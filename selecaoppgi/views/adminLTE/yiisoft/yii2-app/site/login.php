<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Edital;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Formulário de Inscrição no Mestrado/Doutorado - PPGI/UFAM';

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

<div class="login-box">
    <div class="login-logo">
        <!-- <div align="center"><h3>Efetuar Login</h3></div> -->
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="login-box-msg" style="font-weight: bold; font-size:20px"> Efetuar Login </div>
        <div style="text-align:center; margin-bottom:20px; font-weight: normal"> Todos os campos são obrigatórios </div>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form
            ->field($model, 'email', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('senha')]) ?>
        

            <?= $form->field($model, 'idEdital', ['options' => ['style' => 'text-align: center; margin-bottom:10px', 'class' => 'col-md-12']])->dropDownList(ArrayHelper::map($edital,'numero','numero'),['prompt'=>'Selecione um Edital'])->label(false) ; ?>

        <div class="row">
            <!-- /.col -->
            <div class="col-xs-12" style=" display: inline-block">

                <?= Html::submitButton('Continuar Inscrição', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) 
                ?>
                <br>

                <div align= "center"> <?= Html::a('Voltar', ['site/index'],['class' => 'btn btn-default btn-block btn-flat']) ?> </div>

            </div>
            <!-- /.col -->
        </div>
        <?php ActiveForm::end(); ?>
        <br>
        <?= Html::a('Eu Esqueci Minha Senha', ['site/request-password-reset']) ?>
         <br>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
