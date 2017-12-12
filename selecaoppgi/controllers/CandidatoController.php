<?php

namespace selecaoppgi\controllers;

use Yii;
use app\models\Candidato;
use app\models\LinhaPesquisa;
use app\models\CandidatoPublicacoes;
use app\models\Edital;
use app\models\ExperienciaAcademica;
use app\models\Recomendacoes;
use app\models\CandidatoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Exception;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use mPDF;
use kartik\mpdf\Pdf;
use yii\base\ErrorException;


/**
 * CandidatoController implements the CRUD actions for Candidato model.
 */
class CandidatoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        //'roles' => ['?'],
                        'matchCallback' => function ($rule, $action) {
                            $session = Yii::$app->session;
                            return $session->get('candidato');
                        }
                    ],
                ],
            ], 
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Exibe Formulário no passo 1
     */
    public function actionPasso1(){

        $this->layout = '@app/views/layouts/main2.php';

        //obtendo o id do candidato por sessão.
        $model = new Candidato();
        $session = Yii::$app->session;
        $id = $session->get('candidato');
        //fim do recebimento do id por sessão

        $model = $this->findModel($id);

        /*Atribuindo o curso do Edital selecionado para o candidato*/
        $editalCurso = $this->getCursoDesejado($model);
        
        if ($model->load(Yii::$app->request->post())) {
            if($model->passoatual == 0){
                $model->passoatual = 1;
            }

            $model->telresidencial = str_replace("_", "", $model->telresidencial);
            $model->telcelular = str_replace("_", "", $model->telcelular);
            if($model->nacionalidade == 1)
                $model->pais = "Brasil";
        
            if($model->save(false)){
                $this->mensagens('success', 'Informações Salvas com Sucesso', 'Suas informações referente aos dados pessoais foram salvas');
                return $this->redirect(['passo2']);
            }

            return $this->render('create1', [
                'model' => $model,
                'editalCurso' => $editalCurso,
            ]);
        }else {
            return $this->render('create1', [
                'model' => $model,
                'editalCurso' => $editalCurso,
            ]);
        }
    }

    /**
     * Exibe Formulário no passo 2
     */
    public function actionPasso2()
    {
        $btnEnviar = isset($_POST['enviar']);

        $this->layout = '@app/views/layouts/main2.php';

        $itensPeriodicos = array();
        $itensConferencias = array();

        $session = Yii::$app->session;
        $id = $session->get('candidato');
        $model = $this->findModel($id);       

        if ($model->load(Yii::$app->request->post())){

            if($model->passoatual == 1){
                $model->passoatual = 2;
            }
            
            if($model->uploadXml(UploadedFile::getInstance($model, 'publicacoesFile'))) {
                if($model->uploadPasso2(UploadedFile::getInstance($model, 'curriculumFile'), $btnEnviar)){
                    if($model->save(false) && $model->salvaExperienciaAcademica()){
                        $this->mensagens('success', 'Alterações Salvas com Sucesso', 'Suas informações Histórico Acadêmico/Profissional foram salvas');
                        if(isset($_POST['prosseguir'])){
                            return $this->redirect(['passo3']);
                        }
                    }else{
                        $this->mensagens('danger', 'Erro ao salvar informações', 'Ocorreu um erro ao salvar as informações. Contate o adminstrador do sistema.');
                    }
                }else{
                    $this->mensagens('danger', 'Erro ao Enviar arquivos', 'Ocorreu um Erro ao enviar os arquivos submetidos'); 

                }
            }else{
                $this->mensagens('danger', 'Erro ao Salvar as Publicações', 'Ocorreu ao Extrair as informações do arquivo XML.');
            }
        }
        else if( $model->passoatual == 0){
                return $this->redirect(['passo1']);
        }

        $publicacoes = CandidatoPublicacoes::find()->where(['idCandidato' => $model->id])->orderBy(['ano' => SORT_DESC])->all();
        for ($i=0; $i < count($publicacoes); $i++) {
            if($publicacoes[$i]->tipo == 2)
                $itensPeriodicos[$i] = ['label' => $publicacoes[$i]->ano.': '.$publicacoes[$i]->titulo, 
                    'content' => $publicacoes[$i]->autores.". ".$publicacoes[$i]->titulo.". ".$publicacoes[$i]->local.". ".$publicacoes[$i]->ano."."];
            else
                $itensConferencias[$i] = ['label' => $publicacoes[$i]->ano.': '.$publicacoes[$i]->titulo, 
					'content' => $publicacoes[$i]->autores.". ".$publicacoes[$i]->titulo.". ".$publicacoes[$i]->local.". ".$publicacoes[$i]->ano."."];
        }

        return $this->render('create2', [
                'model' => $model,
                'itensPeriodicos' => $itensPeriodicos,
                'itensConferencias' => $itensConferencias,
            ]);
    }

    /**
     * Exibe Formulário no passo 3
     */
    public function actionPasso3()
    {

        $this->layout = '@app/views/layouts/main2.php';

        $session = Yii::$app->session;
        $id = $session->get('candidato');
        $model = $this->findModel($id);

        $linhasPesquisas = ArrayHelper::map(LinhaPesquisa::find()->orderBy('nome')->all(), 'id', 'nome');

        if ($model->load(Yii::$app->request->post())) {

            if($model->passoatual == 2) 
                $model->passoatual = 3;
            try{
                if($model->uploadPasso3(UploadedFile::getInstance($model, 'cartaOrientadorFile'), UploadedFile::getInstance($model, 'propostaFile'), UploadedFile::getInstance($model, 'comprovanteFile'),$model->idEdital)){
                    if($model->save(false) && $model->salvaCartaRecomendacao()){
                        if(isset($_POST['finalizar'])){
                            //ENVIAR EMAILS CADASTRADOS*
                            
							// HABILITAR ISSO APÓS ENVIAR EMAIL
							$this->notificarCartasRecomendacao($model);
                            return $this->redirect(['passo4']);
                        }
                    }else{
                        $this->mensagens('danger', 'Erro ao Salvar Alterações', 'Ocorreu um Erro ao salvar os dados.');
                    }
                
                }else{
                    $this->mensagens('danger', 'Erro ao Enviar arquivos', 'Ocorreu um Erro ao enviar os arquivos submetidos');
                }
            }catch(ErrorException $e){
                $this->mensagens('danger', 'Erro Temporário', $e->getCode());
            }
            
            return $this->render('create3', [
                'model' => $model,
                'linhasPesquisas' => $linhasPesquisas,
            ]);
        } 
        else if( $model->passoatual <= 1){
            return $this->redirect(['passo1']);
        }
        else {
            return $this->render('create3', [
                'model' => $model,
                'linhasPesquisas' => $linhasPesquisas,
            ]);
        }
    }

    /**
     * Exibe Formulário no passo 4
     */
    public function actionPasso4()
    {

        $this->layout = '@app/views/layouts/main2.php';

        $session = Yii::$app->session;
        $id = $session->get('candidato');
        $model = $this->findModel($id);


        $model->passoatual = 4;
        $model->fim = date("Y-m-d H:i:s");
        $model->save(false);

        $diretorio = $model->getDiretorio();


        if( $model->passoatual <= 2){
            return $this->redirect(['passo1']);
        }

        return $this->render('passo4', [
            'model' => $model,
            'diretorio' => $diretorio,
        ]);
        
    }

    /*Obriga o php a baixar o arquivos pdf Solicitado da pasta do candidato*/
    public function actionPdf($documento){

        $session = Yii::$app->session;
        $id = $session->get('candidato');
        $model = $this->findModel($id);

        $localArquivo = $model->getDiretorio().$documento;

        if(!file_exists($localArquivo))
            throw new NotFoundHttpException('A Página solicitada não existe.');

        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename="'.$documento.'"');
        header('Content-Type: application/pdf');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($model->getDiretorio().$documento));
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Expires: 0');

        readfile($localArquivo);
    }



    /**
     * Finds the Candidato model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Candidato the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Candidato::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('A Página solicitada não existe.');
        }
    }

function actionComprovanteinscricao() {

        $session = Yii::$app->session;
        $id = $session->get('candidato');
        $candidato = $this->findModel($id);

        $recomendacoesArray = Recomendacoes::findAll(['idCandidato' => $id]);
        $experienciaArray = ExperienciaAcademica::findAll(['idCandidato' => $id]);


        $publicacoes1 = CandidatoPublicacoes::find()->where(['idCandidato' => $id , 'tipo' => '2'])->all();

        $publicacoes2 = CandidatoPublicacoes::find()->where(['idCandidato' => $id , 'tipo' => '1'])->all();

        $instituicao = array(0 => null, 1 => null, 2=> null);
        $atividade = array(0 => null, 1 => null, 2=> null);
        $periodo  = array(0 => null, 1 => null, 2=> null);

        for ($i=0; $i<sizeof($experienciaArray); $i++){
            $instituicao[$i] = $experienciaArray[$i]->instituicao;
            $atividade[$i] = $experienciaArray[$i]->atividade;
            $periodo[$i] = $experienciaArray[$i]->periodo;
        }

        //gerando html das cartas de recomendações
                $cartasRecomendacoes = "";
                for ($i=0; $i < sizeof($recomendacoesArray); $i++){
                    $cartasRecomendacoes = $cartasRecomendacoes.'
                            <tr>
                                <td style="width:50%">
                                    <b> Nome:  </b>'.$recomendacoesArray[$i]->nome.'
                                </td>
                                <td style="width:50%">
                                   <b> Email:  </b>'.$recomendacoesArray[$i]->email.'
                                </td>

                            </tr>';
                }
        // fim da geração de html das cartas de gerações

        //gerando html das tabela de experiências acadêmicas

            if(sizeof($experienciaArray) > 0){

                $experienciasAcademicas = "
                    <tr>
                        <th align='left'>
                            Instituição
                        </th>
                        <th align='left'>
                            Cargo/Função
                        </th>
                        <th align='left'>
                            Período
                        </th>
                    </tr>";

                for ($i=0; $i<sizeof($experienciaArray); $i++){

                    $experienciasAcademicas = $experienciasAcademicas.
                    '<tr>
                        <td width = "35%" height="22">
                                '.$experienciaArray[$i]->instituicao.'
                        </td>
                        <td width = "35%">
                                '.$experienciaArray[$i]->atividade.'
                        </td>
                        <td>
                                '.$experienciaArray[$i]->periodo.'
                        </td>
                    </tr>';
                }
            }
            else{
                $experienciasAcademicas = 
                "
                <tr>
                    <td align='left'>
                             Não consta Informações.
                    </td>
                </tr>
                ";
            }
        // fim da geração html das tabela de experiências acadêmicas

            $pdf = new mPDF('utf-8','A4','','','15','15','42','30');

    
    $sexo = array ('M' => "Masculino",'F' => "Feminimo");
    $cursoDesejado = array (1 => "Mestrado",2 => "Doutorado");
    $tipoCursoPos = array (0 => "Mestrado Acadêmico", 1 => "Mestrado Profissional", 2 => "Doutorado");
    $tipoDeficiencia = array (0 => "Visual", 1 => "Auditiva", 2 => "Motora");
    $regimeDedicacao = array (1 => "Integral",2 => "Parcial");
    $nacionalidade = array (1 => "Brasileira",2 => "Estrangeira");
    $simOuNao = array (0 => "Não", 1 => "Sim");

    if ($candidato->cotas == 1){
        $cota = '<b>Regime de Cotas? </b>Sim, <br> Tipo de cota: '.$candidato->cotaTipo;
    }
    else{
        $cota = '<b>Regime de Cotas? </b>Não.';
    }

    if ($candidato->deficiencia == 1){
        $deficiencia = '<b>Possui algum tipo de deficiência? </b>Sim <br> Tipo de deficiência: '.$tipoDeficiencia[$candidato->deficienciaTipo];
    }
    else{
        $deficiencia = '<b>Possui algum tipo de deficiência? </b>Não.';
    }

    if ($candidato->nacionalidade == 1){
        $campoCPFouPassaporte = "CPF: ".$candidato->cpf;
    }   
    else{
        $campoCPFouPassaporte = "Passaporte: ".$candidato->passaporte;
    }

    //$comprovantePDF = "/formulario".$candidato->id.".pdf";

    //$arqPDF = fopen($comprovantePDF, 'w') or die('CREATE ERROR');


    //$pdf->selectFont('pdf-php/fonts/Helvetica.afm');
    //$optionsText = array(justification=>'center', spacing=>1.3);
    $dados = array(justification=>'justify', spacing=>1.0);
    $optionsTable = array(fontSize=>10, titleFontSize=>12, xPos=>'center', width=>500, cols=>array('Código'=>array('width'=>60, 'justification'=>'center'),'Período'=>array('width'=>50, 'justification'=>'center'),'Disciplina'=>array('width'=>285), 'Conceito'=>array('width'=>50, 'justification'=>'center'), 'FR%'=>array('width'=>45, 'justification'=>'center'), 'CR'=>array('width'=>30, 'justification'=>'center'), 'CH'=>array('width'=>30, 'justification'=>'center')));

            $pdf->SetHTMLHeader('
                <table style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
                    <tr>
                        <td width="20%" align="center" style="font-family: Helvetica;font-weight: bold; font-size: 175%;"> <img src = "../web/img/logo-brasil.jpg" height="90px" width="90px"> </td>
                        <td width="60%" align="center" style="font-family: Helvetica;font-weight: bold; font-size: 135%;">  PODER EXECUTIVO <br> UNIVERSIDADE FEDERAL DO AMAZONAS <br> INSTITUTO DE COMPUTAÇÃO <br> PROGRAMA DE PÓS-GRADUAÇÃO EM INFORMÁTICA </td>
                        <td width="20%" align="center" style="font-family: Helvetica;font-weight: bold; font-size: 175%;"> <img src = "../web/img/ufam.jpg" height="90px" width="70px"> </td>
                    </tr>
                </table>
                <hr>
            ');

            $pdf->SetHTMLFooter('

                <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
                    <tr>
                        <td  colspan = "3" align="center" ><span style="font-weight: bold"> Av. Rodrigo Otávio, 6.200 - Campus Universitário Senador Arthur Virgílio Filho - CEP 69077-000 - Manaus, AM, Brasil </span></td>
                    </tr>
                    <tr>
                        <td width="33%" align="center" style="font-weight: bold; font-style: italic;">  Tel. (092) 3305-1193/2808/2809</td>
                        <td width="33%" align="center" style="font-weight: bold; font-style: italic;">  E-mail: secretaria@icomp.ufam.edu.br</td>

                        <td width="33%" align="center" style="font-weight: bold; font-style: italic;">  http://www.icomp.ufam.edu.br </td>
                    </tr>
                </table>
            ');


                $pdf->WriteHTML(' <br>
                    <table style= "margin-top:0px;" width="100%;"> 
                    <tr>
                        <td style="text-align:right;">
                            <b> COMPROVANTE DE INSCRIÇÃO </b>
                        </td>   
                        <td align="right" width="35%">
                            <b>Hora: '.date("H:i").'</b> <br> <b> Data: '.date("d/m/Y").'</b>
                        </td>                        
                    </tr>
                    </table>
                    <table width="100%" style="border-top: solid 1px; ">
                    <tr>
                        <td colspan="2" style= "height:35px;">
                            <b> Dados Pessoais </b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="width:100%">
                            Número da inscrição: '.$candidato->numeroinscricao.'
                        </td>   
s                    </tr>
                    <tr>
                        <td style="width:50%">
                            Nome: '.$candidato->nome.'
                        </td> 
                        <td style="width:50%">
                            Nome Social: '.$candidato->nomesocial.'
                        </td>   
                    </tr>
                    <tr>
                        <td colspan="2">
                            Endereço: '.$candidato->endereco.'
                        </td>
                    </tr>
                    <tr>
                        <td>
                            CEP: '.$candidato->cep.'
                        </td>

                        <td>
                            Bairro: '.$candidato->bairro.'
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Cidade: '.$candidato->cidade.'
                        </td>
                        <td>
                            País: '.$candidato->pais.'
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Data de Nascimento: '.$candidato->datanascimento.'
                        </td>
                        <td>
                            Sexo: '.$sexo[$candidato->sexo].'
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nacionalidade: '.$nacionalidade[$candidato->nacionalidade].'
                        </td>
                        <td>
                            '.$campoCPFouPassaporte.'
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Telefone Principal: '.$candidato->telresidencial.'
                        </td>
                        <td>
                            Telefone Alternativo: '.$candidato->telcelular.'
                        </td>
                    </tr>
                    <tr>
                        <td style= "height:35px">
                            <b> Dados do PosComp </b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Número da Inscrição: '.$candidato->inscricaoposcomp.'
                        </td>
                        <td>
                            Ano: '.$candidato->anoposcomp.'   Nota: '.$candidato->notaposcomp.'
                        </td>                        
                    </tr>
                    </table>');

  
    $pdf->WriteHTML('

        <table width="100%" border = "0"> 

                    <tr>
                        <td colspan="2" style= "height:55px; text-align:center; border-bottom: 1px solid #000;border-top: 1px solid #000">
                            <b> FORMAÇÃO ACADÊMICA </b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style= "height:35px;">
                            <b> Curso de Graduação</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Curso: '.$candidato->cursograd.'
                        </td>
                    </tr>
                    <tr>
                        <td style="width:50%">
                            Instituição: '.$candidato->instituicaograd.'
                        </td>
                        <td style="width:50%">
                            Ano Egresso: '.$candidato->egressograd.'
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style= "height:35px">
                            <b> Curso de Pos-Graduação Stricto-Senso </b>
                        </td>
                    </tr>                    
                    <tr>
                        <td colspan="2">
                            Curso: '.$candidato->cursopos.'
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Instituição: '.$candidato->instituicaopos.'
                        </td>
                        <td>
                                Tipo: '.$tipoCursoPos[$candidato->tipopos].'
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style= "height:55px" border = "0">
                            <b> Publicações </b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Em Periódicos: '.count($publicacoes1).'
                        </td>
                        <td>
                                Em Conferências: '.count($publicacoes2).'
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" style= "height:55px" border = "0">
                            <b> Experiência Acadêmica </b>
                        </td>
                    </tr>
                </table>
                <table width="100%" border = "0">
                    '.$experienciasAcademicas.'
        </table>
    ');
                
    $pdf->addPage();

    $pdf->WriteHTML('
        <table style= "margin-top:0px" width="100%" border = "0"> 

                    <tr>
                        <td colspan="2" style= "height:55px; text-align:center; border-bottom: 1px solid #000;">
                            <b> PROPOSTA DE TRABALHO </b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Título da proposta: </b>'.$candidato->tituloproposta.'
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b> Linha de pesquisa: </b>'.$candidato->linhaPesquisa->nome.'
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><br>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:50%">
                            <b>Curso Desejado: </b>'.$cursoDesejado[$candidato->cursodesejado].' 
                        </td>
                        <td>
                            <b>Regime de Dedicação: </b>'.$regimeDedicacao[$candidato->regime].'
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Solicita Bolsa de Estudos? </b>'.$simOuNao[$candidato->solicitabolsa].'
                        </td>
                        <td>
                            '.$cota.'
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            '.$deficiencia.'
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><br>
                        </td>
                    </tr>
                    <tr>
                        <td  style= "vertical-align: text-top;" colspan = "2">
                            <b> Exposição de motivos </b>(exponha resumidamente os motivos que o(a) levaram a se candidatar):  
                        </td>
                    </tr>
                    <tr>
                        <td  style= "border: solid 1px; vertical-align: text-top;" colspan = "2" height = "200px">
                            '.$candidato->motivos.'
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style= "height:55px" border = "0">
                            <b> Cartas de Recomendação </b>
                        </td>
                    </tr>

                    '.$cartasRecomendacoes.'

        </table>
        ');

    $pdf->addPage();

        $pdf->Ln(5);
        $pdf->MultiCell(0,6,"PERIÓDICOS",0, 'C');
        $pdf->WriteHTML("<hr>");
        for($i=0 ; $i<count($publicacoes1); $i++){
            $pdf->MultiCell(0,5,$publicacoes1[$i]->autores.''.$publicacoes1[$i]->titulo.'. '.$publicacoes1[$i]->local.'. '.$publicacoes1[$i]->ano.'.',0., 'L');
            $pdf->WriteHTML("<hr>");
        }

        $pdf->MultiCell(0,6,"CONFERÊNCIAS",0, 'C');
        $pdf->WriteHTML("<hr>");
        for($i=0 ; $i<count($publicacoes2); $i++){

            $pdf->WriteHTML("<table><tr><td>");
			$pdf->MultiCell(0,5,$publicacoes2[$i]->autores.''.$publicacoes2[$i]->titulo.'. '.$publicacoes2[$i]->local.'. '.$publicacoes2[$i]->ano.'.',0., 'L');
            $pdf->WriteHTML("</td></tr></table>");
            $pdf->WriteHTML("<hr>");
        }

    //$pdf->MultiCell(0,5,$periodicos,0, 'L');


    $pdf->Output('');

    $pdfcode = $pdf->output();
    fwrite($arqPDF,$pdfcode);
    fclose($arqPDF);

}

    /*Função que retorna o curso do edital ou se o curso deverá ser escolhido no formulário*/
    /*Curso Desejado:
         1 - Mestrado
         2 - Doutorado
     */
    public function getCursoDesejado($model){
        $ambos = 0;
        $edital = Edital::findOne(['numero' => $model->idEdital]);
        if( $edital->curso == 3)
            $ambos = 3;
        else
            $model->cursodesejado = $edital->curso;

        return $ambos;
    }

    public function notificarCartasRecomendacao($model){

        $recomendacoesArray = Recomendacoes::findAll(['idCandidato' => $model->id]);

        foreach ($recomendacoesArray as $recomendacoes) {
            echo "<script>console.log('$recomendacoes->nome')</script>";
            $link = "http://sistemas.icomp.ufam.edu.br/novoppgi/frontend/web/index.php?r=recomendacoes/create&token=".$recomendacoes->token;
            // subject
            $subject  = "[PPGI/UFAM] Solicitacao de Carta de Recomendacao para ".$model->nome;

            $mime_boundary = "<<<--==-->>>";
            $message = '';
            // message
            $message .= "Caro(a) ".$recomendacoes->nome.", \r\n\n";
            $message .= "Você foi requisitado(a) por ".$model->nome." (email: ".$model->email.") para escrever uma carta de recomendação para o processo de seleção do Programa de Pós-Graduação em Informática (PPGI) da Universidade Federal do Amazonas (UFAM).\r\n";
            $message .= "\nPara isso, a carta deve ser preenchida eletronicamente utilizando o link: \n ".$link."\r\n";
            $message .= "O prazo para preenchimento da carta é ".$recomendacoes->prazo.".\r\n";
            $message .= "Em caso de dúvidas, por favor nos contate. Agradecemos sua colaboração.\r\n";
            $message .= "\nCoordenação do PPGI - ".date(DATE_RFC822)."\r\n";
            $message .= $mime_boundary."\r\n";
			
            /*Envio das cartas de Email*/
           try{
               Yii::$app->mailer->compose()
                ->setFrom("secretariappgi@icomp.ufam.edu.br")
                ->setTo($recomendacoes->email)
                ->setSubject($subject)
                ->setTextBody($message)
                ->send();
            }catch(Exception $e){
                $this->mensagens('warning', 'Erro ao enviar Email(s)', 'Ocorreu um Erro ao Enviar as Solicitações de Cartas de Recomendação.
                    Tente novamente ou contate o adminstrador do sistema');
				return false;
            }
        }
		return true;		
    }


    /* Envio de mensagens para views
   Tipo: success, danger, warning*/
    protected function mensagens($tipo, $titulo, $mensagem){
        Yii::$app->session->setFlash($tipo, [
            'type' => $tipo,
            'icon' => 'home',
            'duration' => 5000,
            'message' => $mensagem,
            'title' => $titulo,
            'positonY' => 'top',
            'positonX' => 'center',
            'showProgressbar' => true,
        ]);
    }

}