<?php

namespace app\models;

use DateTime;
use Yii;
use yii\helpers\VarDumper;
use yiibr\brvalidator\CpfValidator;

class Aluno extends \yii\db\ActiveRecord
{
    public $siglaLinhaPesquisa;
    public $corLinhaPesquisa;
    public $nomeOrientador;
    public $icone;
    public $username;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j17_aluno';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'email', 'curso', 'cpf', 'cep', 'endereco', 'datanascimento', 'sexo', 'uf', 'cidade', 'bairro', 'telresidencial', 'regime', 'matricula', 'orientador', 'dataingresso', 'curso', 'area'], 'required'],
            [['financiadorbolsa', 'dataimplementacaobolsa'], 'required', 'when' => function ($model) { return $model->bolsista; }, 'whenClient' => "function (attribute, value) {
                    return $('#form_bolsista').val() == '1';
                }"],
            [['area', 'curso', 'regime', 'status', 'egressograd', 'orientador'], 'integer'],
            [['nome'], 'string', 'max' => 60],
            [['email'],'email'],
            [['cidade'], 'string', 'max' => 40],
            [['senha'], 'string', 'max' => 255],
            [['matricula'], 'string', 'max' => 15],
            [['endereco'], 'string', 'max' => 160],
            [['bairro'], 'string', 'max' => 50],
            [['uf'], 'string', 'max' => 5],
            [['cep', 'conceitoExameProf'], 'string', 'max' => 9],
            [['datanascimento', 'dataExameProf'], 'string', 'max' => 10],
            [['sexo'], 'string', 'max' => 1],
            [['cpf'], CpfValidator::className(), 'message' => 'CPF Inválido'],
            [['telresidencial', 'telcelular'], 'string', 'max' => 18],
            [['bolsista'], 'string', 'max' => 3],
            [['financiadorbolsa'], 'string', 'max' => 45],
            [['idiomaExameProf'], 'string', 'max' => 20],
            [['cursograd', 'instituicaograd'], 'string', 'max' => 100],
            [['sede'], 'string', 'max' => 2],
            [['dataingresso', 'dataimplementacaobolsa'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nome' => 'Nome',
            'email' => 'Email',
            'senha' => 'Senha',
            'matricula' => 'Matrícula',
			'name' => 'Nome do Aluno',
            'area' => 'Linha de Pesquisa',
            'curso' => 'Curso',
            'endereco' => 'Endereço',
            'bairro' => 'Bairro',
            'cidade' => 'Cidade',
            'uf' => 'UF',
            'cep' => 'CEP',
            'datanascimento' => 'Data de Nascimento',
            'sexo' => 'Sexo',
            'cpf' => 'CPF',
            'rg' => 'RG',
            'telresidencial' => 'Telefone Principal',
            'telcelular' => 'Telefone Alternativo',
            'regime' => 'Regime',
            'bolsista' => 'Bolsista',
            'status' => 'Status',
            'dataingresso' => 'Data de Ingresso',
            'idiomaExameProf' => 'Idioma do Exame de Proficiência',
            'conceitoExameProf' => 'Conceito do Exame de Proficiência',
            'dataExameProf' => 'Data do Exame de Proficiência',
            'cursograd' => 'Curso da Graduação',
            'instituicaograd' => 'Instituicão da Graduação',
            'egressograd' => 'Término da Graduação',
            'orientador' => 'Orientador',
            'anoconclusao' => 'Ano de Conclusão',
            'sede' => 'Sede',
            'financiadorbolsa' => 'Financiador da Bolsa',
            'dataimplementacaobolsa' => 'Início da Vigência',
            'orientador1.nome' => 'Orientador',
        ];
    }

    public static function getStatusFromId($id){
        $statusAluno = [0 => 'Aluno Corrente',1 => 'Aluno Egresso',2 => 'Aluno Desistente',3 => 'Aluno Desligado',4 => 'Aluno Jubilado',5 => 'Aluno com Matrícula Trancada'];

        return $statusAluno[$id];
    }

    public function beforeSave($insert){
        // o codigo a seguir armazena alteracoes realizadas no model
        // para consultas futuras por parte dos secretarios
        // a sua intencao eh manter um registro da serie historica
        // de alteracoes dos dados do aluno
        if(!$this->isNewRecord){ // queremos pegar apenas updates
            $old = $this->getOldAttributes();
            $new = $this->getDirtyAttributes();
            $diff = array_diff_assoc($new, $old); // apenas os que mudam de valor

            $valid_diff = [];

            foreach ($diff as $attr => $value) {
                $date_pattern = "/\d\d\-\d\d\-\d\d\d\d/";

                if (preg_match($date_pattern, $value)){
                    // isso aqui tem a unica finalidade de lidar com as cagadas que
                    // fizeram com as datas nesse sistema. como as datas estao em formatos
                    // diferentes, o array_diff sempre acusa diferencas nao existentes.
                    // essas diferencas sao checadas manualmente aqui
                    // o if checa se eh possivel fazer o parse da data, pq as vezes da uns bagulho estranho
                    if(DateTime::createFromFormat('d-m-Y', $new[$attr]) && DateTime::createFromFormat('Y-m-d', $old[$attr])){
                        $new_value = DateTime::createFromFormat('d-m-Y', $new[$attr])->format('d-m-Y');
                        $old_value = DateTime::createFromFormat('Y-m-d', $old[$attr])->format('d-m-Y');

                        if($old_value != $new_value){
                            $valid_diff[$attr] = ['old_value' => $old_value, 'new_value' => $new_value];
                        }
                    }
                }else{
                    if($new[$attr] != $old[$attr]){
                        $valid_diff[$attr] = ['old_value' => $old[$attr], 'new_value' => $new[$attr]];
                    }
                }

            }

            foreach ($valid_diff as $attr => $value){
                $mod = new AlunoModification();

                // preciso checar isso pq simplesmente NAO TEM RESTRICAO DE FK NA TABELA ALUNO
                // pra poder fazer introspeccao
                if($attr == 'orientador'){
                    $mod->antigo_valor = User::find()->where(['id' => $value['old_value']])->one()->nome;
                    $mod->novo_valor = User::find()->where(['id' => $value['new_value']])->one()->nome;
                } else if($attr == 'area') {
                    $mod->antigo_valor = LinhaPesquisa::find()->where(['id' => $value['old_value']])->one()->nome;
                    $mod->novo_valor = LinhaPesquisa::find()->where(['id' => $value['new_value']])->one()->nome;
                } else if ($attr == 'curso'){
                    $mod->antigo_valor = "" . $value["old_value"] == '1' ? 'Mestrado' : 'Doutorado';
                    $mod->novo_valor =  "" . $value["new_value"] == '1' ? 'Mestrado' : 'Doutorado';
                } else if ($attr == 'regime'){
                    $mod->antigo_valor = "" . $value["old_value"] == '1' ? 'Integral' : 'Parcial';
                    $mod->novo_valor =  "" . $value["new_value"] == '1' ? 'Integral' : 'Parcial';
                } else if ($attr == 'bolsista'){
                    $mod->antigo_valor = "" . $value["old_value"] == '0' ? 'Não' : 'Sim';
                    $mod->novo_valor =  "" . $value["new_value"] == '0' ? 'Não' : 'Sim';
                } else if ($attr == 'status'){
                    $mod->antigo_valor = Aluno::getStatusFromId($value["old_value"]);
                    $mod->novo_valor =  Aluno::getStatusFromId($value["new_value"]);
                }

                else {
                    $mod->antigo_valor = $value['old_value'];
                    $mod->novo_valor = $value['new_value'];
                }

                $mod->atributo = $this->getAttributeLabel($attr);
                $mod->id_responsavel = Yii::$app->user->id;
                $mod->id_aluno = $this->getId();

                $mod->save();
            }

        }

        // ----- aqui termina o codigo do log das alteracoes -----

        if (parent::beforeSave($insert)) {
            if($this->dataingresso) $this->dataingresso = date('Y-m-d', strtotime($this->dataingresso));
    		if($this->datanascimento) $this->datanascimento = date('Y-m-d', strtotime($this->datanascimento));
            if($this->dataExameProf) $this->dataExameProf =  date('Y-m-d', strtotime($this->dataExameProf));
    		if($this->dataimplementacaobolsa) $this->dataimplementacaobolsa =  date('Y-m-d', strtotime($this->dataimplementacaobolsa));
            return true;
        } else {
            return false;
        }

    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getlinhaPesquisa()
    {
        return $this->hasOne(LinhaPesquisa::className(), ['id' => 'area']);
    }

    public function getOrientador1()
    {
        return $this->hasOne(User::className(), ['id' => 'orientador']);
    }

    public function orientados($idusuario){
       $alunos = Aluno::find()->where(["orientador" => $idusuario])->all();
       return $alunos;
    }

    /**
     * Gets the stop out's related to the student
     * Returns an array with all student-related stop out's
     *
     * @author Pedro Frota <pvmf@icomp.ufam.edu.br>
     *
     * @return \yii\db\ActiveQuery
     */

    public function getTrancamentos() {
        return $this->hasMany(Trancamento::className(), ['idAluno' => 'id']);
    }

    public function getModifications() {
        return $this->hasMany(AlunoModification::className(), ['id_aluno' => 'id']);
    }

    public function getDiasParaFormar() {

        if($this->curso == 1){  //Mestrado
            $diasParaFormar= 730;
        }else{                  //Doutorado
            $diasParaFormar= 1460;
        }
        $dataIngresso= strtotime($this->dataingresso);
        $dataConclusao= strtotime($this->anoconclusao);
        $dataAtual= strtotime(date("Y-m-d"));

        if($dataConclusao == null){
            $diasPassados= (int)floor(($dataAtual - $dataIngresso) / (60 * 60 * 24));
        }else{
            $diasPassados= (int)floor(($dataConclusao - $dataIngresso) / (60 * 60 * 24));
        }

        $diasPassados= $diasPassados -1;
        $dMestrado= 730;
        $dDoutorado= 1460;
        $dSem= 180;

        if($this->curso == 1){
            //Prorrogação
            $prorrogacaoAluno= Prorrogacao::find()->where('idAluno =' . $this->id)->all();
            $tDiasProrrogacaoM= 0;
            foreach($prorrogacaoAluno as $pM) {
                if($this->id == $pM->idAluno){
                    $tDiasProrrogacaoM= $tDiasProrrogacaoM + $pM->qtdDias;
                }
            }

            if($diasPassados > $dMestrado+$tDiasProrrogacaoM){
                $diasPassados= $diasPassados - $dMestrado;
            }else{
            	$diasPassados= -1;
            }//Quando não está com prazo vencido----------------<

            //Trancamento
            $trancamentoAluno= Trancamento::find()->where('idAluno =' . $this->id)->all();
            $tDiasTrancamentoM= 0;
            $flagM= false;
            foreach($trancamentoAluno as $tM) {
                if($this->id == $tM->idAluno){
                    $datIni= strtotime($tM->dataInicio);
                    $datTer= strtotime($tM->dataTermino);
                    if($datTer == null){
                        $tDiasTrancamentoM= (int)floor(($dataAtual - $datIni) / (60 * 60 * 24)) + $tDiasTrancamentoM;
                    }else{
                        $tDiasTrancamentoM= (int)floor(($datTer - $datIni) / (60 * 60 * 24)) + $tDiasTrancamentoM;
                    }
                    $flagM= true;
                }
            }

            if($tDiasTrancamentoM > 2*$dSem){
                $diasPassados= $tDiasTrancamentoM - 2*$dSem;
            }else if($flagM == true){
                $diasPassados= -1;
            }
        }

        if($this->curso == 2){
            //Prorrogação
            $prorrogacaoAluno= Prorrogacao::find()->where('idAluno =' . $this->id)->all();
            $tDiasProrrogacaoD= 0;
            foreach($prorrogacaoAluno as $pD) {
                if($this->id == $pD->idAluno){
                    $tDiasProrrogacaoD= $tDiasProrrogacaoD + $pD->qtdDias;
                }
            }

            if($diasPassados > $dDoutorado+$tDiasProrrogacaoD){
                $diasPassados= $diasPassados - $dDoutorado;
            }else{
            	$diasPassados= -1;
            }//Quando não está com prazo vencido----------------<

            //Trancamento
            $trancamentoAluno= Trancamento::find()->where('idAluno =' . $this->id)->all();
            $tDiasTrancamentoD= 0;
            $flagD= false;
            foreach($trancamentoAluno as $tD) {
                if($this->id == $tD->idAluno){
                    $datIni= strtotime($tM->dataInicio);
                    $datTer= strtotime($tM->dataTermino);
                    if($datTer == null){
                        $tDiasTrancamentoD= (int)floor(($dataAtual - $datIni) / (60 * 60 * 24)) + $tDiasTrancamentoD;
                    }else{
                        $tDiasTrancamentoM= (int)floor(($datTer - $datIni) / (60 * 60 * 24)) + $tDiasTrancamentoD;
                    }
                    $flagD= true;
                }
            }

            if($tDiasTrancamentoD > 2*$dSem){
                $diasPassados= $tDiasTrancamentoD - 2*$dSem;
            }else if($flagD == true){
                $diasPassados= -1;
            }

        }

        return $diasPassados;
    }

}