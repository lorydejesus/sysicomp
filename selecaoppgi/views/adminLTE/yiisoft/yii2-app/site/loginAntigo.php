<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

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
        <p align="center"><h3>Formulário de Inscrição no Mestrado/Doutorado - PPGI/UFAM</h3></p>
    </div>
    <hr style="width: 100%; height: 2px;">
    <div style="margin-bottom: 10px;">    
        <font size="2" style="line-height: 150%">
        <p align="justify"><ul>
           <li>Para iniciar uma nova inscri&#231;&#227;o, clique no bot&#227;o <b>Nova Inscri&#231;&#227;o</b>.</li>
           <li>Para alterar os dados de sua inscri&#231;&#227;o (antes de ter submetido-a ao PPGI), informe seu <b>e-mail</b> e <b>senha</b> e em seguida clique no bot&#227;o <b>Atualizar Inscri&#231;&#227;o</b>.</li>
           <li>Fa&#231;a sua inscri&#231;&#227;o at&#233; chegar ao <b>passo 4</b> e salve o comprovante gerado para que voc&#234; tenha o controle de sua inscri&#231;&#227;o.</li>
           <!--<li>As <b>cartas de recomenda&#231;&#227;o</b> necess&#225;rias no processo de inscri&#231;&#227;o dever&#227;o ser preenchidas de forma online pelos indicados. Assim que voc&#234; finalizar e submeter sua inscri&#231;&#227;o, os indicados receber&#227;o um email com as instru&#231;&#245;es de como preencher sua carta de recomenda&#231;&#227;o.</li>-->
        </ul></p>
        </font>
    </div>
    <hr style="width: 100%; height: 2px;">

    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"> Entre com seu Login e Senha</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form
            ->field($model, 'email', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('senha')]) ?>

        <div class="row">
            <div class="col-xs-6">
                <?= Html::a('Nova Inscrição', ['site/cadastroppgi'], ['class' => 'btn btn-primary btn-block btn-flat']) ?><br>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <?= Html::submitButton('Continuar Inscrição', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>
        <?php ActiveForm::end(); ?>
        <?= Html::a('Eu Esqueci Minha Senha', ['site/request-password-reset']) ?><br>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
