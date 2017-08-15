<?php
namespace backend\controllers;

use Yii;
use app\models\Aluno;
use app\models\User;
use yii\filters\AccessControl;
use app\models\Trancamento;
use app\models\TrancamentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * TrancamentoController implements the CRUD actions for Trancamento model.
 */
class TrancamentoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [   
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'ativar', 'encerrar'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                               return Yii::$app->user->identity->checarAcesso('administrador') || Yii::$app->user->identity->checarAcesso('secretaria');
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'ativar' => ['POST'],
                    'encerrar' => ['POST'],
                ],
            ],
        ];
    }

    /*
     * Envio de mensagens para views
     * Tipo: success, danger, warning, error
     */
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
    
    /**
     * Lists all Trancamento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrancamentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Trancamento model.
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
     * Creates a new Trancamento model.
     * If creation is successful, the browser will be redirected to the 'view' page for model 'Aluno'.
     * 
     * @author Pedro Frota <pvmf@icomp.ufam.edu.br>
     * 
     * @param integer $idAluno The student ID
     * 
     * @return mixed
     */
    public function actionCreate($idAluno, $ignoredWarning = false)
    {
        $model = new Trancamento();

        $model->scenario = 'create';
        
        $model->idAluno = $idAluno;


        if (!$model->canDoStopOut() && !$ignoredWarning) {
            return $this->render('_limitWarn', [
                'model'=>$model,
            ]);
        }

        $model->dataSolicitacao = date("Y-m-d"); //Get the current date
        $model->dataSolicitacao0 = date('d/m/Y', strtotime($model->dataSolicitacao));
        $model->tipo = 0; //Defines 'type' as 'Trancamento'
        $model->status = 1; //Defines status as active


        // registra quem solicitou este trancamento

        $model->id_responsavel = \Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post())) {

            //Required to adapt the date inserted in the view to the format that will be inserted into the database
            $model->dataSolicitacao = explode("/", $model->dataSolicitacao0);
            if (sizeof($model->dataSolicitacao) == 3) {
                $model->dataSolicitacao = $model->dataSolicitacao[2]."-".$model->dataSolicitacao[1]."-".$model->dataSolicitacao[0];
            }
            else $model->dataSolicitacao = '';


            //Required to adapt the date inserted in the view to the format that will be inserted into the database
            $model->dataInicio = explode("/", $model->dataInicio0);
            if (sizeof($model->dataInicio) == 3) {
                $model->dataInicio = $model->dataInicio[2]."-".$model->dataInicio[1]."-".$model->dataInicio[0];
            }
            else $model->dataInicio = '';

            //Required to adapt the date inserted in the view to the format that will be inserted into the database
            $model->prevTermino = explode("/", $model->prevTermino0);
            if (sizeof($model->prevTermino) == 3) {
                $model->prevTermino = $model->prevTermino[2]."-".$model->prevTermino[1]."-".$model->prevTermino[0];
            }
            else $model->prevTermino = '';
            
            $pre_path = 'uploads/trancamento/';
            $filename = 'trancamento-'.Yii::$app->security->generateRandomString().'.pdf';

            $path = $pre_path.$filename;
            
            $model->documento = $path;

            if($model->save()){

                if (!is_dir($pre_path)) {
                    mkdir($pre_path);
                }

                $this->generatePdf($model, $path);
                $this->mensagens('success', 'Sucesso', 'Trancamento criado com sucesso.');

                if (!$model->canDoStopOut() && !$ignoredWarning) {
                    return $this->render('_limitReached', [
                        'model'=>$model,
                    ]);
                }
                return $this->redirect(['trancamento/view', 'id'=>$model->id]);
            }
            else {
                $this->mensagens('error', 'Erro', 'Houve uma falha ao criar o trancamento.');
            }
        }

        return $this->render('create', [
            'model'=>$model,
        ]);
    }


    /**
     * Updates an existing Trancamento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->dataSolicitacao0 = date('d/m/Y', strtotime($model->dataSolicitacao));
        $model->dataInicio0 = date('d/m/Y', strtotime($model->dataInicio));
        $model->prevTermino0 = date('d/m/Y', strtotime($model->prevTermino));

        if ($model->load(Yii::$app->request->post())) {
            
            //Required to adapt the date inserted in the view to the format that will be inserted into the database
            $model->dataSolicitacao = explode("/", $model->dataSolicitacao0);
            if (sizeof($model->dataSolicitacao) == 3) {
                $model->dataSolicitacao = $model->dataSolicitacao[2]."-".$model->dataSolicitacao[1]."-".$model->dataSolicitacao[0];
            }
            else $model->dataSolicitacao = '';


            //Required to adapt the date inserted in the view to the format that will be inserted into the database
            $model->dataInicio = explode("/", $model->dataInicio0);
            if (sizeof($model->dataInicio) == 3) {
                $model->dataInicio = $model->dataInicio[2]."-".$model->dataInicio[1]."-".$model->dataInicio[0];
            }
            else $model->dataInicio = '';

            //Required to adapt the date inserted in the view to the format that will be inserted into the database
            $model->prevTermino = explode("/", $model->prevTermino0);
            if (sizeof($model->prevTermino) == 3) {
                $model->prevTermino = $model->prevTermino[2]."-".$model->prevTermino[1]."-".$model->prevTermino[0];
            }
            else $model->prevTermino = '';

            $pre_path = 'uploads/trancamento/';
            $filename = 'trancamento-'.Yii::$app->security->generateRandomString().'.pdf';

            $path = $pre_path.$filename;

            $docAntigo = $model->documento;
            $model->documento = $path;

            if ($model->save()) {
                $this->generatePdf($model, $path);
                unlink(getcwd().'/'.$docAntigo);
                $this->mensagens('success', 'Sucesso', 'Trancamento editado com sucesso.');

                return $this->redirect(['view', 'id' => $model->id]);
            }
            else {
                $this->mensagens('error', 'Erro', 'Houve uma falha ao editar o trancamento.');
            }
        }

        return $this->render('update', [
                'model' => $model,
        ]);
    }

    public function actionAtivar($id) {
        $model = $this->findModel($id);

        $model->dataTermino = null;
        $model->status = 1;

        if ($model->save()) {
            $this->mensagens('success', 'Sucesso', 'Trancamento ativado com sucesso.');
        }
        else {
             $this->mensagens('error', 'Erro', 'Falha ao ativar trancamento');
        }

        return $this->redirect(['index']);
    }

    public function actionEncerrar($id) {
        $model = $this->findModel($id);

        $model->dataTermino = date("Y-m-d");
        $model->status = 0;

        if ($model->save()) {
            $this->mensagens('success', 'Sucesso', 'Trancamento encerrado com sucesso.');
        }
        else {
             $this->mensagens('error', 'Erro', 'Falha ao encerrar trancamento.');
        }

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Trancamento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * 
     * @author Pedro Frota <pvmf@icomp.ufam.edu.br>
     * 
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $aluno_id = $model->idAluno;

        // $documento = $model->documento;

        if ($model->delete()) {
            //Delete the document related to the stop out
            //getcwd() is used to get the current working directory (cwd)
            // unlink(getcwd().'/'.$documento);
            $this->mensagens('success', 'Sucesso', 'Trancamento deletado com sucesso.');
        }
        else {
            $this->mensagens('error', 'Erro', 'Falha ao deletar trancamento.');
        }

        $url = Url::to(['aluno/view', 'id' => $aluno_id]);

        return $this->redirect($url);
    }
    /**
     * Finds the Trancamento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Trancamento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Trancamento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function generatePdf($model, $filename) {
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_FILE,
            'filename' => $filename,
            // your html content input
            'content' => '
                            <table style="width: 647px;" cellspacing="1" cellpadding="5">
                            <tbody>
                            <tr>
                            <td style="width: 104px;" valign="top" height="89">
                            <p><span style="font-family: \'Arial Narrow\', sans-serif;"><span style="font-size: large;"><strong><img src='.getcwd().'/img/ufam.jpg alt="" width="82" height="106" /></strong></span></span></p>
                            </td>
                            <td style="width: 542px;" valign="top" height="89">
                            <p><span style="font-family: \'Arial Narrow\', sans-serif;"><span style="font-size: large;"><strong>UNIVERSIDADE FEDERAL DO AMAZONAS</strong></span></span></p>
                            <p><span style="font-size: small;"><span style="font-family: \'Arial Narrow\', sans-serif;"><span style="font-size: large;">Instituto de Computa&ccedil;&atilde;o</span></span></span></p>
                            <p><span style="font-family: \'Arial Narrow\', sans-serif;"><span style="font-size: large;">Programa de P&oacute;s-Gradua&ccedil;&atilde;o em Inform&aacute;tica</span></span></p>
                            </td>
                            </tr>
                            </tbody>
                            </table>
                            <p class="western" align="center">&nbsp;</p>
                            <p class="western" align="center">&nbsp;</p>
                            <p class="western" align="center"><span style="font-family: Arial, sans-serif;"><span style="font-size: small;"><strong>Solicita&ccedil;&atilde;o de Trancamento</strong></span></span></p>
                            <p class="western">&nbsp;</p>
                            <p class="western">&nbsp;</p>
                            <p class="western">&nbsp;</p>
                            <p class="western"><span style="font-size: small;"><span style="font-family: Arial, sans-serif;"><b>De</b>: '.$model->aluno->nome.'</span></span></p>
                            <p class="western"><span style="font-size: small;"><span style="font-family: Arial, sans-serif;"><b>Matr&iacute;cula</b>: '.$model->aluno->matricula.'</span></span></p>
                            <p class="western"><span style="font-size: small;"><span style="font-family: Arial, sans-serif;"><b>Para</b>: Coordena&ccedil;&atilde;o do Programa de P&oacute;s-Gradua&ccedil;&atilde;o Em Inform&aacute;tica &ndash; PPGI/UFAM</span></span></p>
                            <p class="western">&nbsp;</p>
                            <p class="western"><span style="font-size: small;"><span style="font-family: Arial, sans-serif;">Solicito ao colegiado o TRANCAMENTO DE CURSO </span><span style="font-family: Arial, sans-serif;">à partir do dia <b>'.date('d/m/Y', strtotime($model->dataInicio)).'</b> até o dia <b>'.date('d/m/Y', strtotime($model->prevTermino)).'</b></span><span style="font-family: Arial, sans-serif;">.</span></span></p>
                            <p class="western">&nbsp;</p>
                            <p class="western"><span style="font-family: Arial, sans-serif;"><span style="font-size: small;"><b>Justificativa</b>:<br>'.$model->justificativa.'&nbsp;</span></span></p>
                            <p class="western">&nbsp;</p>
                            <p class="western">Anexo (se houver):&nbsp;</p>
                            <p class="western">&nbsp;</p>
                            <p style="text-align: right;">&nbsp;</p>
                            <p style="text-align: right;">&nbsp;</p>
                            <p style="text-align: right;"><span style="font-family: Arial, sans-serif;"><span style="font-size: small;">Data: '.date('d/m/Y', strtotime($model->dataSolicitacao)).'</span></span></p>
                            <p class="western">&nbsp;</p>
                            <p class="western">&nbsp;</p>
                            <p class="western">&nbsp;</p>
                            <table style="margin-left: auto; margin-right: auto; width: 518.5px;">
                            <tbody>
                            <tr style="height: 21px;">
                            <td style="height: 21px; width: 207px;">--------------------------------------------</td>
                            <td style="height: 21px; width: 100px;">&nbsp;</td>
                            <td style="height: 21px; width: 209.5px; text-align: right;">--------------------------------------------</td>
                            </tr>
                            <tr style="height: 21px;">
                            <td style="height: 21px; width: 207px;">Orientador</td>
                            <td style="height: 21px; width: 100px;">&nbsp;</td>
                            <td style="text-align: right; height: 21px; width: 209.5px;">Discente</td>
                            </tr>
                            </tbody>
                            </table>
                            <p class="western" align="center">&nbsp;</p>
                            <p class="western" align="center">&nbsp;</p>
                         '
            ,  
            //'cssInline' => '', 
             // set mPDF properties on the fly
            'options' => ['title' => $filename],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetFooter'=>[
                '
                   <p align="center"><span style="font-family: Arial, sans-serif;"><span style="font-size: xx-small;">Av. Gal. Rodrigo Oct&aacute;vio Jord&atilde;o Ramos, 6200 CEP.:69077-000 Manaus &ndash;AM</span></span></p>
                    <p align="center"><span style="font-family: Arial, sans-serif;"><span style="font-size: xx-small;"> Fone: 3305 2809 / 2808 / 1193 e-mail: secretariappgi@icomp.ufam.edu.br</span></span></p>
                    <p align="center">&nbsp;</p>
                '
                ],
            ]
        ]);

        return $pdf->render();
    }
}