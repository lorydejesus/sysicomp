<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Edital;

/* @var $this yii\web\View */
/* @var $model app\models\Candidato */
/* @var $form ActiveForm */
?>
<div class="candidato-index">

<div class="login-box" style="width:70%;">
    <div class="login-logo">
        <p align="center"><h3> Formulário de Inscrição no Processo Seletivo para Mestrado/Doutorado - PPGI/UFAM</h3></p>
    </div>
<div class="login-box-body">
        <div style="float:inline; border-bottom: 1px solid; text-align: justify; text-justify: inter-word;">
            <h3  style="text-align:left; margin-top: 0px"> <b>Instruções: </b> </h3>
            <ul>
            <li>Preencha os campos <b>e-mail, senha, repetir senha e escolha um edital</b> para cadastrar um novo candidato.</li>
            <li>O campo <b>Repetir Senha</b> deve ser preenchido com o mesmo valor preenchido no campo <b>Senha</b>.</li>
            <li>O e-mail de cadastro não pode ser repetido para um mesmo edital. Caso tenha iniciado sua inscrição em um edital, acesse a opção Continuar Inscrição, acessando o botão <b> Voltar</b>.</li>
            <li>Após confirmar o cadastro, você será direcionado ao formulário de inscrição.</li>
            </ul>

        </div>

    <div class ="row">
        <div class="col-md-5 col-xs-12">
            <?php 

                $tamanho_vetor = sizeof($edital);

                if($tamanho_vetor != 0){

                echo "<div style=\" color:red; text-align:center; font-size: 15px; padding: 20px;\"> <b> Editais Disponíveis </b> </div>
                <hr>";

                    echo "<div style='overflow-y: scroll; height: 400px;'>";

                    for($i=0; $i<$tamanho_vetor; $i++){

                        echo "<div style= \"padding-left:10px; padding-right:10px; border-bottom:solid 1px; padding-bottom:10px; margin-bottom: 10px\">";
                        echo "<div style=\"text-align:left\"> <b> Número do Edital: </b> ".$edital[$i]->numero."<br> </div>";
                        echo "<b> Período das Inscrições:</b> ";
                        echo "<ul style=\"margin-bottom:0px \"> <li> <b> Início: </b>".date("d/m/Y", strtotime($edital[$i]->datainicio))."</li>";
                        echo "<li> <b> Término: </b>".date("d/m/Y", strtotime($edital[$i]->datafim))."</li></ul>";

                        if($edital[$i]->curso == 1){
                            echo "<b> Vagas para Mestrado: </b><br>";
                            echo "<ul style=\" margin-bottom:0px \"> <li> <b> Vagas Regulares: </b>".$edital[$i]->vagas_mestrado."</li>";
                            echo "<li> <b> Vagas Suplementares: </b> </b>".$edital[$i]->cotas_mestrado."</li>";
                            echo "</ul>";
                        }
                        else if ($edital[$i]->curso == 2){
                            echo "<b> Vagas para Doutorado: </b><br>";
                            echo "<ul style=\" margin-bottom:0px \"> <li> <b> Vagas Regulares: </b>".$edital[$i]->vagas_doutorado."</li>";
                            echo "<li> <b> Vagas Suplementares: </b> </b>".$edital[$i]->cotas_doutorado."</li>";
                            echo "</ul>";
                        }
                        else{
                            echo "<b> Cursos: </b> Mestrado e Doutorado <br>";
                            echo "<b> Vagas para Mestrado: </b><br>";
                            echo "<ul style=\" margin-bottom:0px \"> <li> <b> Vagas Regulares: </b>".$edital[$i]->vagas_mestrado."</li>";
                            echo "<li> <b> Vagas Suplementares: </b> </b>".$edital[$i]->cotas_mestrado."</li>";
                            echo "</ul>";
                            echo "<b> Vagas para Doutorado: </b><br>";
                            echo "<ul style=\" margin-bottom:0px \"> <li> <b> Vagas Regulares: </b>".$edital[$i]->vagas_doutorado."</li>";
                            echo "<li> <b> Vagas Suplementares: </b> </b>".$edital[$i]->cotas_doutorado."</li>";
                            echo "</ul>";
                        }
                        
                        echo "<b> Baixar Edital: </b> <a href='".$edital[$i]->documento."' target= '_blank'> Clique aqui</a> <br>";
			echo "<b> Hora Atual: </b>" . date("Y-m-d H:i:s") . "<br>";
                        echo "</div>";
                    }
                }
                else{
                    echo "<font color='red'> <b> Não há editais disponíveis nesta presente data. </b> </font>";
                }
                echo "</div>";
            ?>
        </div>
        <div class="col-md-7 col-md-12">
            <?php if($tamanho_vetor != 0){ ?>

                <?php $form = ActiveForm::begin(['id' => 'forum_post', 'method' => 'post',]); ?>
                <input type="hidden" id = "form_hidden" value ="passo_form_0"/>

                <div style="color:red; text-align:center;font-size:15px; font-weight: bold; padding: 20px;"> Formulário de Inscrição</div>
                <hr>

                <?= $form->field($model, 'email')->label("<font color='#FF0000'>*</font> <b>E-mail:</b>") ?>

                <?= $form->field($model, 'senha')->passwordInput(['value' => ""])->label("<font color='#FF0000'>*</font> <b>Senha:</b>") ?>

                <?= $form->field($model, 'repetirSenha')->passwordInput(['value' => ""])->label("<font color='#FF0000'>*</font> <b>Repetir Senha:</b>") ?>

                <?= $form->field($model, 'idEdital')->dropDownList(ArrayHelper::map($edital,'numero','numero'),['prompt'=>'Selecione o Edital'])->label("<font color='#FF0000'>*</font> <b>Número do Edital:</b>") ; ?>
                <p>    
                    <div class="col-md-6" style="padding: 20px;">
                        <div>
                            <?= Html::submitButton('Salvar Candidato', ['class' => 'btn btn-success col-xs-12']) ?>
                        </div>
                    </div>
                </p>
                <p>
                    <div class="col-md-6" style="padding: 20px;">
                        <div>
                            <?= Html::a('Voltar',['index'], ['class' => 'btn btn-warning col-xs-12']) ?>
                        </div>
                    </div>
                </p>
                <?php ActiveForm::end(); ?>
        <?php }?>
        </div>
    </div>
</div>

</div><!-- candidato-index -->
</div>
