<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\SideNav;
use kartik\widgets\AlertBlock;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Inscrição PPGI';

?>

<div class="evento-index">
	
	<div id="page-wrapper">
        <h1>INSCRIÇÕES PPGI</h1>





<head>
    <script type="text/javascript">
var siteurl='/icomp/';
var tmplurl='/icomp/templates/ja_university/';
var isRTL = false;
</script>

  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="joomla, Joomla" />
  <meta name="description" content="Joomla! - O sistema dinâmico de portais e gerenciador de conteúdo" />
  <meta name="generator" content="Joomla! - Open Source Content Management" />
  <title>IComp - Instituto de Computação</title>
  <link rel="stylesheet" href="/icomp/templates/system/css/system.css" type="text/css" />
  <link rel="stylesheet" href="/icomp/templates/system/css/general.css" type="text/css" />
  <link rel="stylesheet" href="/icomp/plugins/system/jat3/jat3/base-themes/default/css/addons.css" type="text/css" />
  <link rel="stylesheet" href="/icomp/plugins/system/jat3/jat3/base-themes/default/css/template.css" type="text/css" />
  <link rel="stylesheet" href="/icomp/plugins/system/jat3/jat3/base-themes/default/css/layout.css" type="text/css" />
  <link rel="stylesheet" href="/icomp/plugins/system/jat3/jat3/base-themes/default/css/usertools.css" type="text/css" />
  <link rel="stylesheet" href="/icomp/plugins/system/jat3/jat3/base-themes/default/css/css3.css" type="text/css" />
  <link rel="stylesheet" href="/icomp/plugins/system/jat3/jat3/base-themes/default/css/menu/mega.css" type="text/css" />
  <link rel="stylesheet" href="/icomp/templates/ja_university/css/typo.css" type="text/css" />
  <link rel="stylesheet" href="/icomp/templates/ja_university/css/template.css" type="text/css" />
  <link rel="stylesheet" href="/icomp/templates/ja_university/css/layout-mobile.css" type="text/css" media="only screen and (max-width:719px)"  />
  <link rel="stylesheet" href="/icomp/templates/ja_university/css/layout-mobile-port.css" type="text/css" media="only screen and (max-width:479px)"  />
  <link rel="stylesheet" href="/icomp/templates/ja_university/css/layout-tablet.css" type="text/css" media="only screen and (min-width:720px) and (max-width: 985px)"  />
  <link rel="stylesheet" href="/icomp/templates/ja_university/css/layout.css" type="text/css" />
  <link rel="stylesheet" href="/icomp/templates/ja_university/css/menu/mega.css" type="text/css" />
  <link rel="stylesheet" href="/icomp/templates/ja_university/themes/teal/css/template.css" type="text/css" />
  <link rel="stylesheet" href="/icomp/templates/ja_university/themes/teal/css/menu/mega.css" type="text/css" />
  <script src="/icomp/index.php?lang=pt-br&jat3action=gzip&amp;jat3type=js&amp;jat3file=t3-assets%2Fjs_a1228.js" type="text/javascript"></script>

<!--[if ie]><link href="/icomp/plugins/system/jat3/jat3/base-themes/default/css/template-ie.css" type="text/css" rel="stylesheet" /><![endif]--> 
<!--[if ie]><link href="/icomp/templates/ja_university/css/template-ie.css" type="text/css" rel="stylesheet" /><![endif]--> 
<!--[if ie 7]><link href="/icomp/plugins/system/jat3/jat3/base-themes/default/css/template-ie7.css" type="text/css" rel="stylesheet" /><![endif]--> 
<!--[if ie 7]><link href="/icomp/templates/ja_university/css/template-ie7.css" type="text/css" rel="stylesheet" /><![endif]--> 


<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
<meta name="HandheldFriendly" content="true" />



<link href="/icomp/plugins/system/jat3/jat3/base-themes/default/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    
    <style type="text/css">
/*dynamic css*/

    body.bd .main {width: 980px;}
    body.bd #ja-wrapper {min-width: 980px;}
</style></head>

<body id="bd" class="bd fs4 com_inscricaoppgi">
<a name="Top" id="Top"></a>
<div id="ja-wrapper">


                <div id="ja-header"
                class="wrap ">
                   <div class="main">
                           <div class="main-inner1 clearfix">
                <h1 class="logo">
    <a href="" title="IComp - Instituto de Computação"><span>IComp - Instituto de Computação</span></a>
</h1>                </div>
                            </div>
                        </div>
            <div id="ja-mainnav"
                class="wrap ">
                   <div class="main">
                           <div class="main-inner1 clearfix">
                
<div class="ja-megamenu clearfix" id="ja-megamenu">
<ul class="megamenu level0"><li  class="mega first active"><a href="http://sistemas.icomp.ufam.edu.br/icomp/"  class="mega first active" id="menu21" title="Home"><span class="menu-title">Home</span></a></li></ul>
</div>            <script type="text/javascript">
                var megamenu = new jaMegaMenuMoo ('ja-megamenu', {
                    'bgopacity': 0,
                    'delayHide': 300,
                    'slide'    : 0,
                    'fading'   : 1,
                    'direction': 'down',
                    'action'   : 'mouseover',
                    'tips'     : false,
                    'duration' : 300,
                    'hidestyle': 'fastwhenshow'
                });
            </script>
            <!-- jdoc:include type="menu" level="0" / -->

                </div>
                            </div>
                        </div>
            



<ul class="no-display">
    <li><a href="#ja-content" title="Skip to content">Skip to content</a></li>
</ul>
    <!-- MAIN CONTAINER -->
    <div id="ja-container" class="wrap ja-mf">
               <div class="main clearfix">
                   <div id="ja-mainbody" style="width:100%">
            <!-- CONTENT -->
            <div id="ja-main" style="width:100%">
            <div class="inner clearfix">

                
<div id="system-message-container">
<dl id="system-message">
<dt class="message">Mensagem</dt>
<dd class="message message">
    <ul>
        <li>Salve seus dados antes da sess&#227;o expirar. Tempo para expirar a sess&#227;o: <span id="spanRelogio"></span></li>
    </ul>
</dd>
</dl>
</div>
                
                <div id="ja-contentwrap" class="clearfix ">
                    <div id="ja-content" class="column" style="width:100%">
                        <div id="ja-current-content" class="column" style="width:100%">
                            
                                                        <div id="ja-content-main" class="ja-content-main clearfix">
                                
    <head>
    <script language="javaScript">
        function relogio(i){
            if(i > 0){  
                i = i - 1;
                document.getElementById('spanRelogio').innerHTML = i + ' segundo(s).';
                setTimeout('relogio('+i+')', 1000);
            }
            else{
                document.getElementById('spanRelogio').innerHTML = "SUA SESS\xC3O EXPIROU!";
            }
        }
    </script>

<!--    <script language="JavaScript" src="components/com_portalsecretaria/jquery/javascripts/jquery.js" type="text/javascript"></script>
    <script language="JavaScript" src="components/com_portalsecretaria/jquery/javascripts/jquery.metadata.js" type="text/javascript"></script>
    <script language="JavaScript" src="components/com_portalsecretaria/jquery/javascripts/jquery.validate.js" type="text/javascript"></script>
-->
    <script language="JavaScript">
    <!--

        function IsEmpty(aTextField) {
            if ((aTextField.value.length==0) || (aTextField.value==null)) {     return true;    }
            else { return false; }
        }

        function isValidEmail(str) {
            return (str.indexOf(".") > 2) && (str.indexOf("@") > 0);
        }

        function radio_button_checker(elem)
        {
            // set var radio_choice to false
            var radio_choice = false;

            // Loop from zero to the one minus the number of radio button selections
            for (counter = 0; counter < elem.length; counter++)
            {
                // If a radio button has been selected it will return true
                // (If not it will return false)
                if (elem[counter].checked)
                    radio_choice = true;
                }   

                return (radio_choice);
            }

        function isPdf(file){
            extArray = new Array(".pdf");
            allowSubmit = false;

            if (!file) return;
            while (file.indexOf("\\") != -1)
                file = file.slice(file.indexOf("\\") + 1);
            ext = file.slice(file.indexOf(".")).toLowerCase();

            for (var i = 0; i < extArray.length; i++) {
                if (extArray[i] == ext) { allowSubmit = true; break; }
            }

            return(allowSubmit);
        }

        function IsNumeric(sText)
        {
            var ValidChars = "0123456789.";
            var IsNumber=true;
            var Char;

            if (sText.length <= 0){
                IsNumber = false;
            }

            for (i = 0; i < sText.length && IsNumber == true; i++)
            {
                Char = sText.charAt(i);
                if (ValidChars.indexOf(Char) == -1)
                {
                    IsNumber = false;
                }
            }
            return IsNumber;
        }

        function vercpf (cpf){
            if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
                return false;
            add = 0;

            for (i=0; i < 9; i ++)
                add += parseInt(cpf.charAt(i)) * (10 - i);

            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;

            if (rev != parseInt(cpf.charAt(9)))
                return false;

            add = 0;
            for (i = 0; i < 10; i ++)
                add += parseInt(cpf.charAt(i)) * (11 - i);

            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;

            if (rev != parseInt(cpf.charAt(10)))
                return false;

            return true;
        }

        function VerificaData(digData)
        {
            var bissexto = 0;
            var data = digData;
            var tam = data.length;
            if (tam == 10)
            {
                var dia = data.substr(0,2)
                var mes = data.substr(3,2)
                var ano = data.substr(6,4)
                if ((ano > 1900)||(ano < 2100))
                {
                    switch (mes)
                    {
                        case '01':
                        case '03':
                        case '05':
                        case '07':
                        case '08':
                        case '10':
                        case '12':
                            if  (dia <= 31)
                            {
                                return true;
                            }
                            break

                        case '04':
                        case '06':
                        case '09':
                        case '11':
                            if  (dia <= 30)
                            {
                                return true;
                            }
                            break
                        case '02':
                            /* Validando ano Bissexto / fevereiro / dia */
                            if ((ano % 4 == 0) || (ano % 100 == 0) || (ano % 400 == 0))
                            {
                                bissexto = 1;
                            }
                            if ((bissexto == 1) && (dia <= 29))
                            {
                                return true;
                            }
                            if ((bissexto != 1) && (dia <= 28))
                            {
                                return true;
                            }
                            break
                    }
                }
            }
            return false;
        }

        function ValidatePasso1(passo1)
        {
            if(IsEmpty(passo1.nome))
            {
                alert(unescape('O campo Nome deve ser preenchido.'))
                passo1.nome.focus();
                return false;
            }
   
            if (!radio_button_checker(passo1.sexo))
            {
                // If there were no selections made display an alert box
                alert('O campo Sexo deve ser preenchido.')
                passo1.sexo[0].focus();
                return (false);
            }

            if(IsEmpty(passo1.endereco))
            {
                alert('O campo Endereco deve ser preenchido.')
                passo1.endereco.focus();
                return false;
            }

            if(IsEmpty(passo1.bairro))
            {
                alert('O campo Bairro deve ser preenchido.')
                passo1.bairro.focus();
                return false;
            }

            if(IsEmpty(passo1.cidade))
            {
                alert('O campo Cidade deve ser preenchido.')
                passo1.cidade.focus();
                return false;
            }

            if(IsEmpty(passo1.uf))
            {
                alert('O campo UF deve ser preenchido.')
                passo1.uf.focus();
                return false;
            }

            if(IsEmpty(passo1.cep))
            {
                alert('O campo CEP deve ser preenchido.')
                passo1.cep.focus();
                return false;
            }

            if(!VerificaData(passo1.datanascimento.value))
            {
                alert('Campo Data de Nascimento invalido.')
                passo1.datanascimento.focus();
                return false;
            }

            if (!radio_button_checker(passo1.nacionalidade))
            {
                // If there were no selections made display an alert box
                alert('O campo Nacionalidade deve ser preenchido.')
                passo1.nacionalidade[0].focus();
                return (false);
            }

            if(passo1.nacionalidade[1].checked && IsEmpty(passo1.pais))
            {
                alert('Quando o candidato possuir a nacionalidade Estrangeira, deve ser informado o seu pais de origem.')
                passo1.pais.focus();
                return false;
            }
   
            if(passo1.nacionalidade[1].checked && IsEmpty(passo1.passaporte))
            {
                alert('Quando o candidato possuir a nacionalidade Estrangeira, deve ser informado o seu passaporte.')
                passo1.passaporte.focus();
                return false;
            }

            if(IsEmpty(passo1.estadocivil))
            {
                alert('O campo Estado Civil deve ser preenchido.')
                passo1.estadocivil.focus();
                return false;
            }

            if(passo1.nacionalidade[0].checked && !vercpf(passo1.cpf.value))
            {
                alert('Campo CPF invalido.')
                passo1.cpf.focus();
                return false;
            }

            if(passo1.nacionalidade[0].checked && IsEmpty(passo1.rg))
            {
                alert('O campo RG deve ser preenchido.')
                passo1.rg.focus();
                return false;
            }

            if(passo1.nacionalidade[0].checked && IsEmpty(passo1.orgaoexpedidor))
            {
                alert('O campo Orgao Expedidor deve ser preenchido.')
                passo1.orgaoexpedidor.focus();
                return false;
            }

            if(passo1.nacionalidade[0].checked && !VerificaData(passo1.dataexpedicao.value))
            {
                alert('Campo Data de Expedicao do RG invalido.')
                passo1.dataexpedicao.focus();
                return false;
            }

            if(IsEmpty(passo1.telresidencial))
            {
                alert('O campo Telefone de Contato deve ser preenchido.')
                passo1.telresidencial.focus();
                return false;
            }

            if (!radio_button_checker(passo1.cursodesejado))
            {
                alert('O campo Curso deve ser preenchido.')
                passo1.cursodesejado[0].focus();
                return (false);
            }

            if (!radio_button_checker(passo1.regime))
            {
                alert('O campo Regime de Dedicacao deve ser preenchido.')
                passo1.regime[0].focus();
                return (false);
            }

            if (!radio_button_checker(passo1.vinculoconvenio))
            {
                alert('O campo Vinculo a algum Convenio deve ser preenchido.')
                passo1.vinculoconvenio[0].focus();
                return (false);
            }

            if (!radio_button_checker(passo1.solicitabolsa))
            {
                alert('O campo Bolsa deve ser preenchido.')
                passo1.solicitabolsa[0].focus();
                return (false);
            }

            if (!radio_button_checker(passo1.vinculoemprego))
            {
                alert('O campo Vinculo Empregaticio deve ser preenchido.')
                passo1.vinculoemprego[0].focus();
                return (false);
            }

            if(!IsEmpty(passo1.cartaempregador) && !isPdf(passo1.cartaempregador.value))
            {
                alert('Apenas arquivos com extensao PDF podem ser carregados.')
                return false;
            }

            return true;

        }
    //-->
    </script>
    <script language="Javascript">
        function showDivNacionalidade(div)
        {
            if(div == 1){
                document.getElementById("divBrasileiro").className = "visivel";
                document.getElementById("divEstrangeiro").className = "invisivel";
            }
            else{
                document.getElementById("divBrasileiro").className = "invisivel";
                document.getElementById("divEstrangeiro").className = "visivel";
            }

        }

        function showDivVinculo(div)
        {
            if(div == "SIM"){
                document.getElementById("divVinculo").className = "visivel";
            }
            else{
                document.getElementById("divVinculo").className = "invisivel";
            }
        }
    </script>
    <style>
        .invisivel { display: none; }
        .visivel { visibility: visible; }
    </style>

    </head>
















<body onload="relogio(900);showDivNacionalidade();showDivVinculo('');">

        <p align="center"><h3>Formulário de Inscrição no Mestrado/Doutorado no Processo Seletivo para Mestrado/Doutorado no PPGI/UFAM</h3></p>
        
        <hr style="width: 100%; height: 2px;">
        <font size="2" style="line-height: 150%">
            <table border="0" cellpadding="0" cellspacing="2">
            <tbody>
            <tr>
                <td style="width: 4%;"><img src="../web/img/step1_on.gif" border="0" height="36" width="36"></td>
                <td style="width: 18%;"><font size="2"><b> Dados Pessoais</b></font></td>
                <td style="width: 2%;"><img src="../web/img/next.gif" border="0" height="21" width="14"></td>
                <td style="width: 4%;"><img src="../web/img/step2_off.gif" border="0" height="36" width="36"></td>
                <td style="width: 21%;"><font size="2" color="#7f7f7f"><b> Hist&#243;rico Acad&#234;mico/Profissional</b></font></td>
                <td style="width: 2%;"><img src="../web/img/next.gif" border="0" height="21" width="14"></td>
                <td style="width: 4%;"><img src="../web/img/step3_off.gif" border="0" height="36" width="36"></td>
                <td style="width: 21%;"><font size="2" color="#7f7f7f"><b> Proposta de Trabalho e Documentos</b></font></td>
                <td style="width: 2%;"><img src="../web/img/next.gif" border="0" height="21" width="14"></td>
                <td style="width: 4%;"><img src="../web/img/step4_off.gif" border="0" height="36" width="36"></td>
                <td style="width: 18%;"><font size="2" color="#7f7f7f"><b> Tela de Confirma&#231;&#227;o</b></font></td>
            </tr>
            </tbody>
            </table>
        </font>
        <hr style="width: 100%; height: 2px;">
        <b>Como proceder: </b>
        <ul>
            <li>Preencha todos os campos com seus dados pessoais <font color="#FF0000">(* Campos Obrigat&#243rios)</font>.</li>
            <li>Ao clicar abaixo no bot&#227;o "Pr&#243;ximo Passo", seus dados ser&#227;o salvo e voc&#234; ser&#225; encaminhado ao passo 2 da inscri&#231;&#227;o.</li>
        </ul>
        <hr style="width: 100%; height: 2px;">
        <form method="post" name="passo1" enctype="multipart/form-data" action="index.php?option=com_inscricaoppgi&Itemid=0" method="post"  onsubmit="javascript:return ValidatePasso1(this)">
        <fieldset>
            <p align="justify"><b>Identifica&#231;&#227;o do Candidato</b></p>
            <table border="0" cellpadding="1" cellspacing="2" width="100%">
            <tbody>
            <tr style="background-color: #D0D0D0;">
                <td style="width: 20%;"><font color="#FF0000">*</font> <b>Nome:</b></td>
                <td style="width: 35%;"><input maxlength="100" size="50" name="nome" class="inputbox" value=""></td>
                <td style="width: 20%;"><font color="#FF0000">*</font> <b>Sexo:</b></td>
                <td style="width: 25%;"><input name="sexo" value="M" type="radio" ><font size="2">Masculino</font><input name="sexo" value="F" type="radio" ><font size="2">Feminino</font></td>
            </tr>
            <tr>
                <td><font color="#FF0000">*</font> <b>Endere&#231;o:</b></td>
                <td><input maxlength="100" size="50" name="endereco" class="inputbox" value=""></td>
                <td><font color="#FF0000">*</font> <b>Bairro:</b></td>
                <td><input maxlength="40" size="20" name="bairro" class="inputbox" value=""></td>
            </tr>
            <tr  style="background-color: #D0D0D0;">
                <td><font size="2"><font color="#FF0000">*</font> <b>Cidade:</b></font></td>
                <td><input maxlength="30" size="20" name="cidade" class="inputbox" value=""></td>
                <td><font size="2"><font color="#FF0000">*</font> <b>Estado:</b></font></td>
                <td><select name="uf" class="inputbox">
                    <option value="" SELECTED></option>
                    <option value="Outro" >Outro</option>
                    <option value="AC" >AC</option>
                    <option value="AL" >AL</option>
                    <option value="AM" >AM</option>
                    <option value="AP" >AP</option>
                    <option value="BA" >BA</option>
                    <option value="CE" >CE</option>
                    <option value="DF" >DF</option>
                    <option value="ES" >ES</option>
                    <option value="GO" >GO</option>
                    <option value="MA" >MA</option>
                    <option value="MG" >MG</option>
                    <option value="MS" >MS</option>
                    <option value="MT" >MT</option>
                    <option value="PA" >PA</option>
                    <option value="PB" >PB</option>
                    <option value="PE" >PE</option>
                    <option value="PI" >PI</option>
                    <option value="PR" >PR</option>
                    <option value="RJ" >RJ</option>
                    <option value="RN" >RN</option>
                    <option value="RO" >RO</option>
                    <option value="RR" >RR</option>
                    <option value="RS" >RS</option>
                    <option value="SC" >SC</option>
                    <option value="SE" >SE</option>
                    <option value="SP" >SP</option>
                    <option value="TO" >TO</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><font color="#FF0000">*</font> <b>CEP:</b></td>
                <td><input maxlength="10" size="10" name="cep" class="inputbox" value=""></td>
                <td><font color="#FF0000">*</font> <b>Data de Nascimento:</b></td>
                <td><input maxlength="10" size="10" name="datanascimento" class="inputbox" value=""></td>
            </tr>
            <tr style="background-color: #D0D0D0;">
                <td><font color="#FF0000">*</font> <b>Nacionalidade:</b></td>
                <td><input name="nacionalidade" onchange="showDivNacionalidade(this.value);" value="1" type="radio" ><font size="2">Brasileira</font><input name="nacionalidade" onchange="showDivNacionalidade(this.value);" value="2" type="radio" ><font size="2">Estrangeira</font></td>
                <td><font color="#FF0000">*</font> <b>Estado Civil:</b></td>
                <td><input maxlength="12" size="10" name="estadocivil" class="inputbox" value=""></td>
            </tr>
        </tbody>
        </table>
        </fieldset>
        <div id="divBrasileiro">
            <hr style="width: 100%; height: 2px;">
            <fieldset>
                <p align="justify"><b>Estes campos s&#227;o obrigat&#243;rios para candidatos com nacionalidade Brasileira</b></p>
                <table border="0" cellpadding="1" cellspacing="2" width="100%">
                <tbody>
                <tr style="background-color: #D0D0D0;">
                    <td style="width: 20%;"><font color="#FF0000">*</font> <b>CPF:</b></td>
                    <td style="width: 35%;"><input maxlength="14" size="14" name="cpf" class="inputbox" value=""></td>
                    <td style="width: 20%;"><font color="#FF0000">*</font> <b>RG:</b></td>
                    <td style="width: 25%;"><input maxlength="10" size="15" name="rg" class="inputbox" value=""></td>
                </tr>
                <tr>
                    <td><font color="#FF0000">*</font> <b>&#211;rg&#227;o Expedidor:</b></font></td>
                    <td><input maxlength="10" size="10" name="orgaoexpedidor" class="inputbox" value=""></td>
                    <td><font color="#FF0000">*</font> <b>Data de Expedi&#231;&#227;o:</b></td>
                    <td><input maxlength="10" size="10" name="dataexpedicao" class="inputbox" value=""></td>
                </tr>
                </tbody>
                </table>
            </fieldset>
        </div>
        <div id="divEstrangeiro">
            <hr style="width: 100%; height: 2px;">
            <fieldset>
                <p align="justify"><b>Estes campos s&#227;o obrigat&#243;rios para candidatos com nacionalidade Estrangeira</b></p>
                <table border="0" cellpadding="1" cellspacing="2" width="100%">
                <tbody>
                <tr style="background-color: #D0D0D0;">
                    <td style="width: 20%;"><font color="#FF0000">*</font> <b>Pa&#237;s:</b></td>
                    <td style="width: 35%;"><input maxlength="20" size="20" name="pais" class="inputbox" value=""></td>
                    <td style="width: 20%;"><font color="#FF0000">*</font> <b>Passaporte:</b></td>
                    <td style="width: 25%;"><input maxlength="15" size="15" name="passaporte" class="inputbox" value=""></td>
                </tr>
                </tbody>
                </table>
            </fieldset>
        </div>
        <hr style="width: 100%; height: 2px;">
        <fieldset>
            <p align="justify"><b>Telefones de Contato</b></p>
            <table border="0" cellpadding="1" cellspacing="2" width="100%">
            <tbody>
                <tr style="background-color: #D0D0D0;">
                    <td style="width: 20%;"><font color="#FF0000">*</font> <b>Tel. de Contato:</b></td>
                    <td style="width: 10%;"><input maxlength="18" size="18" name="telresidencial" class="inputbox" value=""></td>
                    <td style="width: 20%;"><b>Tel. Alternativo 1:</b></td>
                    <td style="width: 10%;"><input maxlength="18" size="18" name="telcomercial" class="inputbox" value=""></td>
                    <td style="width: 20%;"><b>Tel Alternativo 2:</b></td>
                    <td style="width: 10%;"><input maxlength="18" size="18" name="telcelular" class="inputbox" value=""></td>
                </tr>
            </tbody>
            </table>
        </fieldset>
        <hr style="width: 100%; height: 2px;">
        <fieldset>
            <p align="justify"><b>Filia&#231;&#227;o</b></p>
            <table border="0" cellpadding="1" cellspacing="2" width="100%">
            <tbody>
                <tr style="background-color: #D0D0D0;">
                    <td style="width: 15%;"><font color="#FF0000">*</font> <b>Nome do Pai:</b></td>
                    <td style="width: 35%;"><input maxlength="60" size="40" name="nomepai" class="inputbox" value=""></td>
                    <td style="width: 15%;"><font color="#FF0000">*</font> <b>Nome da M&#227;e:</b></td>
                    <td style="width: 35%;"><input maxlength="60" size="40" name="nomemae" class="inputbox" value=""></td>
                </tr>
            </tbody>
            </table>
        </fieldset>
        <hr style="width: 100%; height: 2px;">
        <fieldset>
            <p align="justify"><b>Dados do PosComp</b></p>
            <table border="0" cellpadding="1" cellspacing="2" width="100%">
            <tbody>
                <tr style="background-color: #D0D0D0;">
                    <td style="width: 15%;"><b>N&#186; de Inscri&#231;&#227;o:</b></td>
                    <td style="width: 25%;"><input maxlength="10" size="15" name="inscricaoposcomp" class="inputbox" value=""></td>
                    <td style="width: 5%;"><b>Ano:</b></td>
                    <td style="width: 25%;"><input maxlength="10" size="10" name="anoposcomp" class="inputbox" value=""></td>
                    <td style="width: 5%;"><b>Nota:</b></td>
                    <td style="width: 25%;"><input maxlength="10" size="10" name="notaposcomp" class="inputbox" value=""></td>
                </tr>
            </tbody>
            </table>
        </fieldset>
        <hr style="width: 100%; height: 2px;">
        <fieldset>
            <p align="justify"><b>Dados da Inscri&#231;&#227;o</b></p>
            <table border="0" cellpadding="1" cellspacing="2" width="100%">
            <tbody>
                <tr style="background-color: #D0D0D0;">
                    <td style="width: 27%;"><font color="#FF0000">*</font> <b>Curso Desejado:</b></td>
                    <td style="width: 23%;">
                        <input name="cursodesejado" value="1" type="radio" ><font size="2">Mestrado</font>
                        <input name="cursodesejado" value="2" type="radio" ><font size="2">Doutorado</font>
                    </td>
                    <td style="width: 30%;"><font color="#FF0000">*</font> <b>Regime de Dedica&#231;&#227;o:</b></td>
                    <td style="width: 20%;"><input name="regime" value="1" type="radio" ><font size="2">Integral</font><input name="regime" value="2" type="radio" ><font size="2">Parcial</font></td>
                </tr>
                <tr>
                    <td><font color="#FF0000">*</font> <b>Vinculado a algum conv&#234;nio?</b></font></td>
                    <td><input name="vinculoconvenio" value="SIM" type="radio" ><font size="2">Sim</font><input name="vinculoconvenio" value="NAO" type="radio" ><font size="2">N&#227;o</font></td>
                    <td><b>Quais (ex: PICTD)?</b></td>
                    <td><input maxlength="50" size="20" name="convenio" class="inputbox"  value=""></td>
                </tr>
                <tr style="background-color: #D0D0D0;">
                    <td><font color="#FF0000">*</font> <b>Solicita Bolsa de Estudo?</b></font></td>
                    <td><input name="solicitabolsa" value="SIM" type="radio" ><font size="2">Sim</font><input name="solicitabolsa" value="NAO" type="radio" ><font size="2">N&#227;o</font></td>
                    <td><font color="#FF0000">*</font> <b>Manter&#225; V&#237;nculo Empregat&#237;cio:</b></td>
                    <td><input name="vinculoemprego" onchange="showDivVinculo(this.value);" value="SIM" type="radio" ><font size="2">Sim</font><input name="vinculoemprego" onchange="showDivVinculo(this.value);" value="NAO" type="radio" ><font size="2">N&#227;o</font></td>
                </tr>
            </tbody>
            </table>
        </fieldset>
        <div id="divVinculo">
            <hr style="width: 100%; height: 2px;">
            <fieldset>
                <p align="justify"><b>Estes campos n&#227;o s&#227;o obrigat&#243;rios </b> (Se desejado, anexe o arquivo contendo a carta do empregador comprometendo-se a limitar a carga de trabalho do candidato a 24 horas semanais, ou meio expediente de trabalho)</p>
                <table border="0" cellpadding="1" cellspacing="2" width="100%">
                <tbody>
                    <tr>
                        <td style="width: 20%;"><b>Empregador:</b></td>
                        <td style="width: 35%;"><input maxlength="50" size="40" name="empregador" class="inputbox" value=""></td>
                        <td style="width: 20%;"><b>Cargo/Fun&#231;&#227;o:</b></td>
                        <td style="width: 25%;"><input maxlength="50" size="40" name="cargo" class="inputbox" value=""></td>
                    </tr>
                    <tr style="background-color: #D0D0D0;">
                        <td rowspan="2"><b>Carta do Empregador:</b> </font></td>
                        <td colspan="3">Atual Arquivo com a Carta do Empregador: Nenhum arquivo de carta do empregador carregado.</td>
                    </tr>
                    <tr style="background-color: #D0D0D0;">
                        <td colspan="3">Adicionar Nova Carta (apenas arquivos PDF):<input type="file" name="cartaempregador" size="60"></td>
                    </tr>
                </tbody>
                </table>
            </fieldset>
        </div>
        <link rel="stylesheet" type="text/css" href="components/com_inscricaoppgi/css/template_css.css">
        <table border="0" cellpadding="0" cellspacing="2" width="100%" class="adminform">
        <tbody>
            <tr style="text-align: center;">
                <th id="cpanel" width="100%">
                    <div class="icon"><a href="javascript: if(ValidatePasso1(document.passo1)) document.passo1.submit()">
                    <div class="iconimage"><img src="../web/img/forward.gif" border="0" height="32" width="32"><br><b>Salvar e Continuar</b>
                    </div></a></div>
                </th>
            </tr>
        </tbody>
        </table>

        <input name='task' type='hidden' value='passo2'>
        <input name='idCandidato' type='hidden' value='1912'>
        <input name='cartaCadastrada' type='hidden' value=''>
    </form>

    </body>

                                </div>
                            
                                                    </div>

                                            </div>

                    
                </div>

                            </div>
            </div>
            <!-- //CONTENT -->
            
        </div>
                        </div>
                </div>
        <!-- //MAIN CONTAINER -->

                <div id="ja-navhelper"
                class="wrap ">
                   <div class="main clearfix">
           <div class="ja-breadcrums">
    <span class="breadcrumbs pathway">
<strong>Você está aqui: </strong>Home</span>

</div>            </div>
                        </div>
                        <div id="ja-footer"
                class="wrap ">
                   <div class="main clearfix">
           <div class="ja-copyright">
    
</div>            </div>
                        </div>
            
</div>



















	</div>
</div>