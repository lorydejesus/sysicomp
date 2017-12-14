<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CandidatoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inscrição realizada com sucesso!!!';
$this->params['breadcrumbs'][] = ['label' => 'Candidatos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="candidato-index">


	<div class="checkout-wrap">
		  <ul class="checkout-bar">

		    <li class="visited first">
		      <a href="index.php?r=candidato%2Fpasso1">Dados <br> Pessoais</a>
		    </li>
		    
		    <li class="previous visited">
		      <a href="index.php?r=candidato%2Fpasso2">Histórico <br> Acadêmico/Profissional</a>
		      </li>
			    
			    <li class="previous visited">
			    <a href="index.php?r=candidato%2Fpasso3">Proposta de Trabalho <br> e Documentos</a>
		      </li>
			    
			    <li class="previous visited"> Tela de<br> Confirmação</li>
		       
		  </ul>
	  </div>
	  	<br><br><br><br><br><br><br>


	<div class="login-box" style="width:100%;">
	    <div class="login-logo">
	        <p><h3 style="text-align:center;"> Inscrição realizada com sucesso !</h3></p>
	    </div>
		<div style="width: 100%; border:solid 0px">

				   	<p><font size="2" style="text-align:left;"><br>Seus dados foram cadastrados com sucesso. Sua proposta será analisada e em breve teremos a divulgação dos aprovados no processo de seleção do PPGI.<br /> Clique no link "Imprimir Formulário de Inscrição" e imprima a página contendo os dados de sua incrição para seu controle. Quando solicitado, assine e entregue este formulário na secretaria do PPGI/UFAM que fica no Departamento de Ciência da Computação, localizado na Rua Gen. Rodrigo Octávio Jordão Ramos, 3000 SETOR NORTE do Campus Universitário Manaus - AM - CEP 69.077-000.</font></p>

				   	<br /><p align="right"><font size="2" style="line-height: 150%">Ass: Coordenação do PPGI/UFAM</font></p><br />
		</div>
	</div>
	
			<div style="text-align:center; font-weight: bold; margin-left: 0%;margin-bottom: 2%; margin-top: 2%"> Clique nos ícones abaixo para visualizar os respectivos documentos em formato pdf. </div>
	   		<div style="margin-left: 16%; margin-right:10%; text-align:center; width:80%;">
		   		<a target="resource window" href="index.php?r=candidato/comprovanteinscricao">
					<div class="iconimage" style="float: left; width: 150px; margin-top: 20px;"><img src="img/edit_f2.png" border="0" height="32" width="32"><br><b>Imprimir Formul&#225;rio de Inscri&#231;&#227;o</b></div></a>

				<a href="index.php?r=candidato/pdf&documento=Proposta.pdf">
					<div class="iconimage" style="float: left; width: 150px; margin-top: 20px;"><img src="img/trabalho.png" border="0" height="32" width="32"><br><b>Imprimir Proposta de Trabalho</b></div></a>
		        <div id="cpanel" width="25%"></div>
				
				<a href="index.php?r=candidato/pdf&documento=CartaOrientador.pdf">
						<div class="iconimage" style="float: left; width: 150px; margin-top: 20px;"><img src="img/historico.gif" border="0" height="32" width="32"><br><b>Carta Orientador</b></div></a>
				<a href="index.php?r=candidato/pdf&documento=Curriculum.pdf">
						<div class="iconimage" style="float: left; width: 150px; margin-top: 20px;"><img src="img/curriculum.gif" border="0" ><br><b>Imprimir Curriculum Lattes</b></div></a>
				<a href="index.php?r=candidato/pdf&documento=Comprovante.pdf">
						<div class="iconimage" style="float: left; width: 150px; margin-top: 20px;"><img src="img/pagamento.png" border="0" height="32" width="32"><br><b>Imprimir Comprovante de Pagamento</b></div></a>
			</div>
</div>
