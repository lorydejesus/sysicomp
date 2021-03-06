<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "j17_trancamentos".
 * Part of this class was self-generated by the Framework
 * 
 * @author Pedro Frota <pvmf@icomp.ufam.edu.br>
 *
 * @property integer $id
 * @property integer $idAluno
 * @property string $dataSolicitacao
 * @property string $dataInicio
 * @property string $prevTermino
 * @property string $dataTermino
 * @property string $justificativa
 * @property string $documento
 * @property integer $status
 * 
 * Obtained through relationships:
 * 
 * @property Aluno $aluno
 * @property User $orientador0
 * @property User $responsavel
 * 
 * Symbolic, responsible for business rules and search:
 * 
 * @property string orientador
 * @property string matricula
 * @property string linhaPesquisa
 * @property string dataSolicitacao0
 * @property string dataInicio0
 * @property string prevTermino0
 */
class Trancamento extends \yii\db\ActiveRecord
{
    public $orientador;
    public $matricula;
    public $linhaPesquisa;
    public $dataSolicitacao0;
    public $dataInicio0;
    public $prevTermino0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j17_trancamentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idAluno', 'dataSolicitacao', 'dataInicio', 'dataInicio0', 'prevTermino', 'prevTermino0', 'justificativa', 'qtd_dias'], 'required'],
            [['documento', 'dataSolicitacao0'], 'required', 'on' => 'create'],
            [['idAluno', 'tipo', 'status'], 'integer'],
            [['matricula', 'orientador','dataSolicitacao', 'dataInicio', 'prevTermino', 'dataTermino', 'dataInicio0', 'dataSolicitacao0'], 'safe'],
            [['dataSolicitacao0', 'dataInicio0', 'prevTermino0'], 'date', 'format' => 'php:d/m/Y'],
            [['dataInicio0'], 'validateDataInicio0'],
            [['prevTermino0'], 'validatePrevTermino0'],
            [['id_responsavel'], 'integer'],
            [['qtd_dias'], 'integer'],
            [['documento'], 'string'],
            [['justificativa'], 'string', 'max' => 250],
            [['idAluno'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['idAluno' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID do Trancamento',
            'idAluno' => 'Aluno',
            'matricula' => 'Matrícula',
            'linhaPesquisa' => 'Linha de Pesquisa',
            'dataSolicitacao' => 'Data de Solicitação',
            'dataSolicitacao0' => 'Data de Solicitação',
            'dataInicio' => 'Data de Início',
            'dataInicio0' => 'Data de Início',
            'orientador' => 'Orientador',
            'prevTermino' => 'Data de Término',
            'prevTermino0' => 'Previsão de Término',
            'dataTermino' => 'Data de Término',
            'justificativa' => 'Justificativa',
            'id_responsavel' => 'Responsável',
            'qtd_dias' => 'Quantidade de Dias',
            'documento' => 'Documento',
            'tipo' => 'Tipo',
            'status' => 'Status',
        ];
    }

    /**
     * Gets the student object
     * 
     * @author Pedro Frota <pvmf@icomp.ufam.edu.br>
     * 
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(Aluno::className(), ['id' => 'idAluno']);
    }

    /**
     * Gets the advisor object
     * 
     * @author Pedro Frota <pvmf@icomp.ufam.edu.br>
     * 
     * @return \yii\db\ActiveQuery
     */

    public function getOrientador0() {
        return $this->hasOne(User::className(), ['id' => 'orientador'])->via('aluno');
    }

    /**
     * Checks if student can still perform a stop out
     * 
     * @author Pedro Frota <pvmf@icomp.ufam.edu.br>
     * 
     * @return boolean 'true' if student can still perform a stop out, 'false' if not
     */
    public function canDoStopOut() {
        //Limit in Days
        $limitMestrado =  365; //1 Year
        $limitDoutorado = 365; //1 Year

        //Tipo: 0 - Trancamento | 1 - Suspensao
        $stopOuts = $this->find()->where('`idAluno` = '.$this->idAluno.' AND `tipo` = 0')->all();
        $sum = 0;

        foreach ($stopOuts as $stopOut) {
            $initialDate = strtotime($stopOut->dataInicio);

            if ($stopOut->dataTermino != null) {
                $finalDate = strtotime($stopOut->dataTermino);
            }
            else {
                $finalDate = strtotime($stopOut->prevTermino);
            }

            $days = (int)floor( ($finalDate - $initialDate) / (60 * 60 * 24));

            $sum = $sum + $days;
        }

        if ($this->aluno->curso == 1) { //Mestrado
            if ($sum >= $limitMestrado) return false;
        }
        else { //Doutorado
            if ($sum >= $limitDoutorado) return false;

        }
        return true;
    }

    /**
     * Validates the start date of a stop out. This cannot be less or equal than the request date.
     * 
     * @author Pedro Frota <pvmf@icomp.ufam.edu.br>
     */

    public function validateDataInicio0($attribute, $params){
        //Number 1 at the end is required to avoid conflicts between variable names
        //I know I could reference class variables using 'this', but I think by doing so, the code 
        //becomes more readable. (Or at least 'less worse' than the other way)

        //Symbolic "declarations" of variables
        //$dataSolicitacao1;
        //$dataInicio1;

        //Required to adapt the date inserted in the view to the format that will be used here
        $dataSolicitacao1 = explode("/", $this->dataSolicitacao0);
        if (sizeof($dataSolicitacao1) == 3) {
            $dataSolicitacao1 = $dataSolicitacao1[2]."-".$dataSolicitacao1[1]."-".$dataSolicitacao1[0];
        }
        else $dataSolicitacao1 = '';
        
        //Required to adapt the date inserted in the view to the format that will be used here
        $dataInicio1 = explode("/", $this->dataInicio0);
        if (sizeof($dataInicio1) == 3) {
            $dataInicio1 = $dataInicio1[2]."-".$dataInicio1[1]."-".$dataInicio1[0];
        }
        else $dataInicio1 = '';

        if (!$this->hasErrors()) {
            if (date("Y-m-d", strtotime($dataInicio1)) < date("Y-m-d", strtotime($dataSolicitacao1))) {
                $this->addError($attribute, 'Por favor, informe uma data posterior ou igual à data de solicitação');
            }
        }
    }

    /**
     * Validates the expected completion of a stop out. This cannot be less than or equal to the start date
     * 
     * @author Pedro Frota <pvmf@icomp.ufam.edu.br>
     */

    public function validatePrevTermino0($attribute, $params) {
        //Number 1 at the end is required to avoid conflicts between variable names
        //I know I could reference class variables using 'this', but I think by doing so, the code 
        //becomes more readable. (Or at least 'less worse' than the other way)

        //Symbolic "declarations" of variables
        //$dataInicio1;
        //$prevTermino1;

        //Required to adapt the date inserted in the view to the format that will be used here
        $dataInicio1 = explode("/", $this->dataInicio0);
        if (sizeof($dataInicio1) == 3) {
            $dataInicio1 = $dataInicio1[2]."-".$dataInicio1[1]."-".$dataInicio1[0];
        }
        else $dataInicio1 = '';

        //Required to adapt the date inserted in the view to the format that will be used here
        $prevTermino1 = explode("/", $this->prevTermino0);
        if (sizeof($prevTermino1) == 3) {
            $prevTermino1 = $prevTermino1[2]."-".$prevTermino1[1]."-".$prevTermino1[0];
        }
        else $prevTermino1 = '';
        
        if (!$this->hasErrors()) {
            if (date("Y-m-d", strtotime($prevTermino1)) < date("Y-m-d", strtotime($dataInicio1))) {
                $this->addError($attribute, 'Por favor, informe uma data posterior ou igual à data de início');
            }
        }
    }

    public function getResponsavel() {
        return $this->hasOne(User::className(), ['id' => 'id_responsavel']);
    }


    public function getId()
    {
        return $this->getPrimaryKey();
    }
}
