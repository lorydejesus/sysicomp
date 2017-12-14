<?php

namespace selecaoppgi\controllers;

use Yii;
use app\models\Recomendacoes;
use app\models\Candidato;
use app\models\RecomendacoesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mPDF;

/**
 * RecomendacoesController implements the CRUD actions for Recomendacoes model.
 */
class RecomendacoesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Displays a single Recomendacoes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Recomendacoes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($token){
        
        $this->layout = '@app/views/layouts/main2.php';
        $model = Recomendacoes::findOne(['token' => $token]);

        $erro = array();

        if(!isset($model)){
            $erro['titulo'] = 'Token Inválido';
            $erro['menssagem'] = 'Confirme-o no email que você recebeu do PPGI.';

            return $this->render('cartarecomendacaoerro', [
                'erro' => $erro,
            ]);
        }

        $erroCarta = $model->erroCartaRecomendacao();

        if($erroCarta == 1){
            $erro['titulo'] = 'Carta de Recomendação Já Enviada';
            $erro['menssagem'] = 'Esta carta já foi submetida ao PPGI.';

            return $this->render('cartarecomendacaoerro', [
                'erro' => $erro,
            ]);
        }else if($erroCarta == 2){
            $erro['titulo'] = 'Carta de Recomendação Fora do Prazo';
            $erro['menssagem'] = 'Prazo esgotado para envio da carta. Contate o PPGI.';

            return $this->render('cartarecomendacaoerro', [
                'erro' => $erro,
            ]);
        }
        $model->passo = 2;

        if ($model->load(Yii::$app->request->post())){            
            if(isset($_POST['enviar']))
                $model->setDataResposta();
                $model->setCheckbox();
                if($model->save()){
                    if(isset($_POST['enviar'])){

                        $this->actionPdfcartas($model->idCandidato);
                        if($this->avisarCartaRecomendacaoRespondida($model))
                            return $this->render('cartarecomendacaomsg', ['model' => $model,]);
                    }
                    else{
                        $this->mensagens('success', 'Salvo com sucesso', 'As informações da carta de recomendação foram salvas com sucesso, mas ainda não foram enviadas ao PPGI.');
                    }
                }else
                    $this->mensagens('danger', 'Erro ao salvar carta', 'Ocorreu um erro ao salvar as informações da carta de recomendação. 
                        Verifique os campos e tente novamente');
        }
            
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function avisarCartaRecomendacaoRespondida($model){
        
        $candidato = Candidato::findOne(['id' => $model->idCandidato]);

            // subject
            $subject  = "[PPGI/UFAM] Resposta de Carta de Recomendacao para ".$candidato->nome;

            $mime_boundary = "<<<--==-->>>";
            $message = '';
            // message
            $message .= "Caro(a) ".$candidato->nome.", \r\n\n";
            $message .= "A carta de recomendação enviada para ".$model->nome." (email: ".$model->email.") foi devidamente respondida.\r\n";
            $message .= "Em caso de dúvidas, por favor nos contate. Agradecemos sua colaboração.\r\n";
            $message .= "\nCoordenação do PPGI - ".date(DATE_RFC822)."\r\n";
            $message .= $mime_boundary."\r\n";

            /*Envio das cartas de Email*/
           try{
               Yii::$app->mailer->compose()
                ->setFrom("secretariappgi@icomp.ufam.edu.br")
                ->setTo($candidato->email)
                ->setSubject($subject)
                ->setTextBody($message)
                ->send();
            }catch(Exception $e){
                $this->mensagens('warning', 'Erro ao enviar Email(s)', 'Ocorreu um Erro ao Enviar as Solicitações de Cartas de Recomendação.
                    Tente novamente ou contate o adminstrador do sistema');
                    return false;
        }
        
        return true;
        
    }

    /**
     * Updates an existing Recomendacoes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Recomendacoes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Recomendacoes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Recomendacoes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


   public function actionPdfcartas($id){

            $pdf = new mPDF('utf-8','A4','','','15','15','42','30');

            $pdf->SetHTMLHeader('
                <table style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
                    <tr>
                        <td width="20%" align="center" style="font-family: Helvetica;font-weight: bold; font-size: 175%;"> <img src = "../../frontend/web/img/logo-brasil.jpg" height="90px" width="90px"> </td>
                        <td width="60%" align="center" style="font-family: Helvetica;font-weight: bold; font-size: 135%;">  PODER EXECUTIVO <br> UNIVERSIDADE FEDERAL DO AMAZONAS <br> INSTITUTO DE COMPUTAÇÃO <br> PROGRAMA DE PÓS-GRADUAÇÃO EM INFORMÁTICA </td>
                        <td width="20%" align="center" style="font-family: Helvetica;font-weight: bold; font-size: 175%;"> <img src = "../../frontend/web/img/ufam.jpg" height="90px" width="70px"> </td>
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

            $model_cartas = new Recomendacoes();
            $candidato = Candidato::find()->where("id = ".$id)->one(); 
            $recomendacao = $model_cartas->getCartas($id);

            $i=0;

    while($i<count($recomendacao)){


            $pontos = array (1 => "Fraco",2 => "Regular",3 => "Bom",4 => "Muito bom",5 => "Excelente",6 => "Sem condições para afirmar");
			$titulacao = ['1' => 'Mestrado', '2' => 'Doutorado', '3' => 'Epecialização', '4' => 'Graduação', '5' => 'Ensino Médio'];

            $classificacao = array (1 => "entre os 50% mais aptos",2 => "entre os 30% mais aptos",3 => "entre os 10% mais aptos",4 => "entre os 5% mais aptos");

            $orientador = array (0 => "",1 => "Orientador; ");
            $professor = array (0 => "",1 => "Professor em Disciplina; ");
            $empregador = array (0 => "",1 => "Empregador; ");
            $coordenador = array (0 => "",1 => "Coordenador; ");
            $colegaCurso = array (0 => "",1 => "Colega em Curso Superior; ");
            $colegaTrabalho = array (0 => "",1 => "Colega de Profissão; ");
            $outrosContatos = array (0 => "",1 => "Outras Funções; ");
            $conheceGraduacao = array (0 => "",1 => "Curso de Graduação; ");
            $conhecePos = array (0 => "",1 => "Curso de Pós-Graduação; ");
            $conheceEmpresa = array (0 => "",1 => "Empresa; ");
            $conheceOutros = array (0 => "",1 => "Outros; ");


            $atributos = array(
                                       array('Atributos do Candidato'=>'Domínio em sua área de conhecimento científico','Nível'=>$pontos[$recomendacao[$i]->dominio])
                                       ,array('Atributos do Candidato'=>'Facilidade de aprendizado capacidade intelectual','Nível'=>$pontos[$recomendacao[$i]->aprendizado])
                                       ,array('Atributos do Candidato'=>'Assiduidade, perseverança','Nível'=>$pontos[$recomendacao[$i]->assiduidade])
                                       ,array('Atributos do Candidato'=>'Relacionamento com colegas e superiores','Nível'=>$pontos[$recomendacao[$i]->relacionamento])
                                       ,array('Atributos do Candidato'=>'Iniciativa, desembaraço, originalidade e liderança','Nível'=>$pontos[$recomendacao[$i]->iniciativa])
                                       ,array('Atributos do Candidato'=>'Capacidade de expressão escrita','Nível'=>$pontos[$recomendacao[$i]->expressao])
            );
            

            $pdf->writeHTML('

                <div style ="text-align:center"> <b>CARTA DE RECOMENDAÇÃO</b> </div>
                <hr>
                <div style ="text-align:center;margin-bottom:10px"> <b>DADOS DO CANDIDATO</b> </div>
                <div style ="text-align:left"> <b>Nome do Candidato:</b> '.$candidato->nome.' </div>
                <div style ="text-align:left"> <b>Graduado em: </b> '.$candidato->cursograd.' - '.$candidato->instituicaograd.' </div>
                </p>
                
                <hr>
                <div style ="text-align:center;"> <b>AVALIADOR DO CANDIDATO</b> </div>

                <div style ="text-align:left"> <b>Nome: </b>'.$recomendacao[$i]->nome.' </div>
                <div style ="text-align:left"> <b>Titulação: </b>'.$titulacao[$recomendacao[$i]->titulacao].' </div>
                <div style ="text-align:left"> <b>Instituição: </b>'.$recomendacao[$i]->instituicaoTitulacao.' </div>
                <div style ="text-align:left"> <b>Ano da Titulação: </b>'.$recomendacao[$i]->anoTitulacao.' </div>
                <div style ="text-align:left"> <b>Instituição/Empresa onde atua: </b>'.$recomendacao[$i]->instituicaoAtual.' </div>
                <div style ="text-align:left"> <b>Cargo: </b>'.($recomendacao[$i]->cargo).' </div>

                <hr>
                <div style ="text-align:center;margin-bottom:10px"> <b>AVALIAÇÃO DO CANDIDATO</b> </div>

                <div style ="text-align:left"> <b> Conheço o candidato desde: </b>'.$recomendacao[$i]->anoContato. ' em ' .$conheceGraduacao[$recomendacao[$i]->conheceGraduacao]."".$conhecePos[$recomendacao[$i]->conhecePos]."".$conheceEmpresa[$recomendacao[$i]->conheceEmpresa]."".$conheceOutros[$recomendacao[$i]->conheceOutros].'
                </div>

                <div style ="text-align:left"> <b> Com relação ao candidato, fui seu(sua): </b>'.$orientador[$recomendacao[$i]->orientador]."".$professor[$recomendacao[$i]->professor]."".$empregador[$recomendacao[$i]->empregador]."".$coordenador[$recomendacao[$i]->coordenador]."".$colegaCurso[$recomendacao[$i]->colegaCurso]."".$colegaTrabalho[$recomendacao[$i]->colegaTrabalho]."".$outrosContatos[$recomendacao[$i]->outrosContatos].'
                </div>

                <p> <b> Como classifica o candidato em relação aos atributos abaixo: </b> </p>

                <table style="border: solid; width: 100%; text-align:center">
                    <tr style="background-color:#848484">
                        <th>
                                Área
                        </th>
                        <th>
                                Nível
                        </th>
                    </tr>
                    <tr style="background-color:#F2F5A9">
                        <td style="text-align:left"> Domínio em sua área de conhecimento científico </td> 
                        <td> '.$pontos[$recomendacao[$i]->dominio].'</td>
                    <tr style="background-color:#D8D8D8">
                        <td style="text-align:left"> Facilidade de aprendizado capacidade intelectual </td>
                        <td>'.$pontos[$recomendacao[$i]->aprendizado].'</td>
                    </tr>
                    <tr style="background-color:#F2F5A9">
                        <td style="text-align:left"> Assiduidade, perseverança </td>
                        <td> '.$pontos[$recomendacao[$i]->assiduidade].'</td>
                    </tr>
                    <tr style="background-color:#D8D8D8">
                        <td style="text-align:left"> Relacionamento com colegas e superiores </td>
                        <td> '.$pontos[$recomendacao[$i]->relacionamento].'</td>
                    </td>
                    <tr style="background-color:#F2F5A9">
                        <td style="text-align:left"> '.'Iniciativa, desembaraço, originalidade e liderança </td>
                        <td> '.$pontos[$recomendacao[$i]->iniciativa].'</td>
                    </tr>
                    <tr style="background-color:#D8D8D8">
                        <td style="text-align:left"> '.'Capacidade de expressão escrita </td>
                        <td> '.$pontos[$recomendacao[$i]->expressao].'</td>
                    </tr>

                </table>

                <p> <div style=" display:inline; text-align: justify; font-weight:bold"> Comparando este candidato com outros alunos ou profissionais, com similar nível de educação e experiência, que conheceu nos últimos 2 anos, classifique a sua aptidão para realizar estudos avançados e pesquisas: '.$classificacao[$recomendacao[$i]->classificacao].'.</div> </p>

                <p> <b>Informações Adicionais:</b> </p>

                <p>'. $recomendacao[$i]->informacoes.'</p>

            ');


        $i++;

        if($i < count($recomendacao)){
            $pdf->addPage();
        }

    }

        $mudarDiretorioParaFrontEnd = "../../frontend/web/";
        $localArquivo = $mudarDiretorioParaFrontEnd.$candidato->getDiretorio();
        $pdf->output($localArquivo."Cartas.pdf","F");

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
