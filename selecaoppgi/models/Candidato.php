<?php

namespace app\models;

use Yii;
use yiibr\brvalidator\CpfValidator;
use yii\web\UploadedFile;
use yii\db\IntegrityException;
use yii\base\Exception;
use yii\helpers\Html;


class Candidato extends \yii\db\ActiveRecord
{
    /*Variáveis intermediarias para uploads*/
    public $recomendacoes;
    public $cartaOrientadorFile;
    public $curriculumFile;
    public $propostaFile;
    public $comprovanteFile;
    public $publicacoesFile;

    public $cartaOrientadorUpload;
    public $curriculumUpload;
    public $propostaUpload;
    public $comprovanteUpload;

    /*Cartas de recomendação Obrigatórias*/
    public $cartaNomeReq1;
    public $cartaNomeReq2;
    public $cartaEmailReq1;
    public $cartaEmailReq2;

    /*Cartas de recomendação Optativas (array)*/
    public $cartaNome;
    public $cartaEmail;

    public $instituicaoacademica1;
    public $instituicaoacademica2;
    public $instituicaoacademica3;
    public $atividade1;
    public $atividade2;
    public $atividade3;
    public $periodoacademico1;
    public $periodoacademico2;
    public $periodoacademico3;

    public $repetirSenha;
    public $auth_key;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'j17_candidatos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {

        return [
/*Inicio Validações para passo 0*/
            [['email', 'senha', 'repetirSenha', 'idEdital'], 'required', 'when' => function($model){ return $model->passoatual == 0;},
                'whenClient' => "function (attribute, value) {
                    return $('#form_hidden').val() == 'passo_form_0';
                }"],
            [['repetirSenha'], 'compare', 'compareAttribute' => 'senha', 'message' => '"Repetir Senha" deve ser igual ao campo "Senha"', 'when' => function($model){ return $model->passoatual == 0;},
                'whenClient' => "function (attribute, value) {
                    return $('#form_hidden').val() == 'passo_form_0';
                }"],
            [['idEdital'], 'string'],
            [['email'], 'email'],
/*FIM Validações para passo 0*/
/*Inicio Validações para passo 1*/

            [['nome', 'sexo', 'cep', 'uf',  'cidade', 'endereco', 'bairro' , 'datanascimento', 'nacionalidade', 'telresidencial' , 'cursodesejado', 'solicitabolsa' , 'cotas', 'regime', 'solicitabolsa', 'deficiencia'], 'required', 'when' => function($model){ return $model->passoatual == 1;},
            'whenClient' => "function (attribute, value) {
                return $('#form_hidden').val() == 'passo_form_1';
            }"],

            [['cpf'], 'required', 'when' => function($model){ return $model->passoatual == 1 && $model->nacionalidade == 1;},
            'whenClient' => "function (attribute, value) {
                return $('input:radio[name=\"Candidato[nacionalidade]\"]:checked').val() == 1;
            }"],


            [['pais', 'passaporte'], 'required', 'when' => function($model){ return $model->passoatual == 1 && $model->nacionalidade == 2;},
            'whenClient' => "function (attribute, value) {
                return $('input:radio[name=\"Candidato[nacionalidade]\"]:checked').val() == 2;
            }"],
/*FIM Validações para passo 1*/
/*Inicio Validações para passo 2*/

            [['cursograd', 'instituicaograd', 'egressograd'], 'required', 'when' => function($model){ return $model->passoatual == 2;},
            'whenClient' => "function (attribute, value) {
                return $('#form_hidden').val() == 'passo_form_2' && $('#ignorarRequired').val() == '0';
            }"],
            [['curriculumFile'], 'required', 'when' => function($model){ return !isset($model->curriculum) && $model->passoatual == 2;},
                'whenClient' => "function (attribute, value) {
                    return $('#form_hidden').val() == 'passo_form_2' && $('#ignorarRequired').val() == '0' && ($('#form_upload').val() == 0);
                }"],
         //   [['publicacoesFile'], 'required', 'when' => function($model){ return !isset($model->publicacoesFile) && $model->passoatual == 3;},
           // 'whenClient' => "function (attribute, value) {
             //   return $('#form_hidden').val() == 'passo_form_2' && ($('#form_uploadxml').val() == 0);
            //}"],

/*FIM Validações para passo 2*/
/*Inicio Validações para passo 3*/
            [['idLinhaPesquisa', 'tituloproposta', 'motivos', 'declaracao'], 'required', 'when' => function($model){ return $model->passoatual == 3;},
            'whenClient' => "function (attribute, value) {
                return $('#form_hidden').val() == 'passo_form_3';
            }"],
            [['cartaOrientadorFile'], 'required', 'when' => function($model){ return (!isset($model->cartaorientador) && $model->passoatual == 3 && $model->cursodesejado == 2 && $model->cartaorientador($model->idEdital)) ;},
                'whenClient' => "function (attribute, value) {
				    return $('#form_hidden').val() == 'passo_form_3' && $('#form_ignorarRequiredCartaOrientador').val() == 0;

            }"],
            [['propostaFile'], 'required', 'when' => function($model){ return !isset($model->proposta) && $model->passoatual == 3;},
            'whenClient' => "function (attribute, value) {
                return $('#form_hidden').val() == 'passo_form_3' && ($('#form_upload').val() == '2' || $('#form_upload').val() == '0');
            }"],
            [['comprovanteFile'], 'required', 'when' => function($model){ return !isset($model->comprovantepagamento) && $model->passoatual == 3;},
            'whenClient' => "function (attribute, value) {
                return $('#form_hidden').val() == 'passo_form_3' && ($('#form_upload').val() == '1' || $('#form_upload').val() == '0');
            }"],


            [['cartaNomeReq1', 'cartaNomeReq2', 'cartaEmailReq1' , 'cartaEmailReq2'], 'required', 'when' => function($model){ return $model->passoatual == 3 && $model->edital->cartarecomendacao == 1;},
            'whenClient' => "function (attribute, value) {
                return $('#form_carta').val() == '1';
            }"],
/*FIM Validações para passo 3*/

            [['cartaNome', 'cotaTipo', 'deficienciaTipo', 'posicaoEdital', 'declaracao'], 'string'],
            [['cartaEmail'], 'email'],
            [['cpf'], CpfValidator::className(), 'message' => 'CPF Inválido'],

            [['cartaOrientadorFile', 'curriculumFile', 'propostaFile', 'comprovanteFile', 'publicacoesFile'], 'safe'],
            [['cartaOrientadorFile', 'curriculumFile', 'propostaFile', 'comprovanteFile'], 'file', 'extensions' => 'pdf', 'maxSize' => 1024 * 1024 * 3],
            [['publicacoesFile'], 'file', 'extensions' => 'xml'],
            [['inicio', 'fim'], 'safe'],
            [['passoatual', 'nacionalidade', 'cursodesejado', 'regime', 'tipopos', 'resultado'], 'integer', 'min' => 0, 'max' => 2099],
            [['anoposcomp', 'egressograd', 'egressopos'], 'integer', 'min' => 1900, 'max' => 2099],
            [['cartaorientador', 'motivos', 'proposta', 'curriculum', 'comprovantepagamento'], 'string'],
            [['cidade'], 'string', 'max' => 40],
            [['motivos'], 'string', 'max' => 1000],
            [['nome', 'nomesocial'], 'string', 'max' => 60],
            [['endereco'], 'string', 'max' => 160],
            [['bairro', 'cursograd', 'instituicaograd', 'cursopos', 'instituicaopos', 'instituicaoacademica1', 'instituicaoacademica2', 'instituicaoacademica3', 'atividade1', 'atividade2', 'atividade3'], 'string', 'max' => 50],
            [['uf'], 'string', 'max' => 2],
            [['cep'], 'string', 'max' => 9],
            [['datanascimento', 'dataformaturagrad', 'dataformaturapos', 'periodo'], 'string', 'max' => 10],
            [['pais', 'passaporte', 'inscricaoposcomp'], 'string', 'max' => 20],
            [['cpf'], 'string'],
            [['sexo'], 'string', 'max' => 1],
            [['telresidencial', 'telcelular'], 'string', 'max' => 18],
            [['notaposcomp'], 'string', 'max' => 5],
            [['solicitabolsa'], 'string', 'max' => 3],
            [['tituloproposta'], 'string', 'max' => 100],
            [['periodoacademico1', 'periodoacademico2', 'periodoacademico3'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'nomesocial' => 'Nome Social',
            'endereco' => 'Endereço',
            'bairro' => 'Bairro',
            'cidade' => 'Cidade',
            'uf' => 'UF',
            'cep' => 'CEP',
            'email' => 'Email',
            'datanascimento' => 'Data de Nascimento',
            'nacionalidade' => 'Nacionalidade',
            'pais' => 'Pais',
            'passaporte' => 'Passaporte',
            'cpf' => 'CPF',
            'sexo' => 'Sexo',
            'telresidencial' => 'Telefone Principal',
            'telcelular' => 'Telefone Alternativo',
            'cursodesejado' => 'Curso Desejado',
            'regime' => 'Regime',
            'inscricaoposcomp' => 'Nº Inscrição PosComp',
            'anoposcomp' => 'Ano PosComp',
            'notaposcomp' => 'Nota PosComp',
            'solicitabolsa' => 'Solicita Bolsa de Estudo',
            'cursograd' => 'Curso',
            'instituicaograd' => 'Instituição',
            'egressograd' => 'Ano de Egresso',
            'cursopos' => 'Curso',
            'instituicaopos' => 'Instituição',
            'tipopos' => 'Tipo',
            'egressopos' => 'Ano Egresso',
            'cartaorientador' => 'Carta de Aceite do Orientador',
            'periodicosinternacionais' => 'Periódicos Internacionais',
            'periodicosnacionais' => 'Periódicos Nacionais',
            'conferenciasinternacionais' => 'Conferências Internacionais',
            'conferenciasnacionais' => 'Conferências Nacionais',
            'instituicaoacademica1' => 'Instituição Acadêmica',
            'instituicaoacademica2' => 'Instituição Acadêmica',
            'instituicaoacademica3' => 'Instituição Acadêmica',
            'atividade1' => 'Atividade',
            'atividade2' => 'Atividade',
            'atividade3' => 'Atividade',
            'periodoacademico1' => 'Período Acadêmico',
            'periodoacademico2' => 'Período Acadêmico',
            'periodoacademico3' => 'Período Acadêmico',
            'senha' => 'Senha',
            'inicio' => 'Data Início',
            'fim' => 'Data Fim',
            'idLinhaPesquisa' => 'Linha de Pesquisa',
            'tituloproposta' => 'Titulo da Proposta',
            'motivos' => 'Motivos',
            'proposta' => 'Proposta',
            'curriculum' => 'Curriculum',
            'comprovantepagamento' => 'Comprovante de Pagamento',
            'dataformaturagrad' => 'Data de formatura da Graduação',
            'dataformaturapos' => 'Data de Formatura da Pós',
            'resultado' => 'Resultado',
            'periodo' => 'Período',
            'idEdital' => 'Edital',
            'declaracao' => 'Declaração de Veracidade de Informações',
            'cartaNomeReq1' => 'Nome',
            'cartaNomeReq2' => 'Nome',
            'cartaEmailReq1' => 'E-mail',
            'cartaEmailReq2' => 'E-mail',

                'cartaOrientadorFile' => 'Carta de Aceite do Orientador',
                'curriculumFile' => 'Curriculum Vittae',
                'propostaFile' => 'Proposta de Trabalho',
                'comprovanteFile' => 'Comprovante de Pagamento',
                'publicacoesFile' => 'Curriculum Vittae XML',

        ];
    }


    /*Inicio dos Relacionamentos*/
    public function getEdital()
    {
        return $this->hasOne(Edital::className(), ['numero' => 'idEdital']);
    }

    public function getlinhaPesquisa()
    {
        return $this->hasOne(LinhaPesquisa::className(), ['id' => 'idLinhaPesquisa']);
    }

    /*Fim dos Relacionamentos*/

    public function getNumeroInscricao(){
        return $this->idEdital.'-'.str_pad($this->posicaoEdital, 3, "0", STR_PAD_LEFT);
    }


    public function getDiretorio(){
        $salt1 = "programadeposgraduacaoufamicompPPGI";
        $salt2 = $this->id * 777;
        $id = $this->id;
        $idCriptografado = md5($salt1+$id+$salt2);
        //definição de um caminho padrão, baseado no ID do candidato
        $caminho = 'documentos/'.$this->idEdital.'/'.$idCriptografado.'/';
        //fim da definição do caminho padrão
        return $caminho;

    }

    public function gerarDiretorio($id,$idEdital){

        $caminho = $this->getDiretorio();

        //verificação se o diretório a ser criado já existe, pois se já existe, não há necessidade de criar outro
        $caminho_ja_existe = is_dir($caminho);
        $edital_ja_existe =  is_dir('documentos/'.$idEdital);

        if($edital_ja_existe != true)
            mkdir('documentos/'.$idEdital);

        if($caminho_ja_existe != true){
            mkdir($caminho); //cria de fato o diretório
        }
        //fim da verificação

        return $caminho;
    }

    public function uploadPasso2($curriculumFile, $enviar){
        //obtenção o ID do usuário pelo meio de sessão
        $id = Yii::$app->session->get('candidato');
        //fim da obtenção
        //método que gera o diretório, retornando o caminho do diretório
        $caminho = $this->gerarDiretorio($id,$this->idEdital);
        //fim do método que gera o diretório

        if(isset($curriculumFile)){
            $this->curriculum = "Curriculum.".$curriculumFile->extension;
            $curriculumFile->saveAs($caminho.$this->curriculum);
        }

        if($enviar || (isset($this->curriculum))) {
            return true;
        }else{
            return false;
        }
    }

    public function uploadPasso3($cartaOrientadorFile, $propostaFile, $comprovanteFile, $idEdital)
    {
        //obtenção o ID do usuário pelo meio de sessão
        $id = Yii::$app->session->get('candidato');
        //fim da obtenção

        //método que gera o diretório, retornando o caminho do diretório
        $caminho = $this->gerarDiretorio($id,$idEdital);
        //fim do método que gera o diretório

        if (isset($cartaOrientadorFile)) {
            $this->cartaorientador = "CartaOrientador.".$cartaOrientadorFile->extension;
            $cartaOrientadorFile->saveAs($caminho.$this->cartaorientador);
        }

        if (isset($propostaFile)) {
            $this->proposta = "Proposta.".$propostaFile->extension;
            $propostaFile->saveAs($caminho.$this->proposta);
        }

        if(isset($comprovanteFile)){
            $this->comprovantepagamento = "Comprovante.".$comprovanteFile->extension;
            $comprovanteFile->saveAs($caminho.$this->comprovantepagamento);
        }

        if((($this->edital->cartaorientador == 1 && ((isset($this->cartaorientador) && $this->cursodesejado == 2) || $this->cursodesejado == 1)) || $this->edital->cartaorientador == 0) && isset($this->proposta) && isset($this->comprovantepagamento)){
            return true;
        } else {
            return false;
        }
        return true;
    }

    /*Busca nas tabelas de recomendações e experiencias acadêmicas para atribuir aos campos do formulário*/
    public function afterFind(){
        $this->recomendacoes = Recomendacoes::findAll(['idCandidato' => $this->id]);
        if(count($this->recomendacoes) != 0){
            $this->cartaNomeReq1 = $this->recomendacoes[0]->nome;
            $this->cartaNomeReq2 = $this->recomendacoes[1]->nome;
            $this->cartaEmailReq1 = $this->recomendacoes[0]->email;
            $this->cartaEmailReq2 = $this->recomendacoes[1]->email;
        }

        for($i = 2 ; $i < count($this->recomendacoes) ; $i++){
            $this->cartaNome[$i-2] = $this->recomendacoes[$i]->nome;
            $this->cartaEmail[$i-2] = $this->recomendacoes[$i]->email;
        }

        $experienciaAcademica = ExperienciaAcademica::findAll(['idCandidato' => $this->id]);


        for ($i=0; $i < count($experienciaAcademica); $i++) {
            if($i == 0){
                $this->instituicaoacademica1 = $experienciaAcademica[0]->instituicao;
                $this->atividade1 = $experienciaAcademica[0]->atividade;
                $this->periodoacademico1 = $experienciaAcademica[0]->periodo;
            }else if($i == 1){
                $this->instituicaoacademica2 = $experienciaAcademica[1]->instituicao;
                $this->atividade2 = $experienciaAcademica[1]->atividade;
                $this->periodoacademico2 = $experienciaAcademica[1]->periodo;
            }else{
                $this->instituicaoacademica3 = $experienciaAcademica[2]->instituicao;
                $this->atividade3 = $experienciaAcademica[2]->atividade;
                $this->periodoacademico3 = $experienciaAcademica[2]->periodo;
            }
        }

        return true;
    }

    /*Validação para identificar se usuário já está cadastrado*/
    public function beforeSave($insert)
    {

      parent::beforeSave($insert);

        if($this->passoatual == 0 && !Candidato::find()->where(['idEdital' => $this->idEdital])->andWhere(['email' => $this->email])->count()){
            $this->posicaoEdital = (Candidato::find()->where(['idEdital' => $this->idEdital])->count() + 1);
            return true;
        }else if($this->passoatual != 0){
            return true;
        }else
            return false;
    }

    public function salvaExperienciaAcademica(){
        try{
            $sql = "DELETE FROM j17_candidato_experiencia_academica WHERE idCandidato = '$this->id'";
            Yii::$app->db->createCommand($sql)->execute();
            if($this->instituicaoacademica1 != ""){
                $sql = "INSERT INTO j17_candidato_experiencia_academica (idCandidato, instituicao, atividade, periodo) VALUES ($this->id, '$this->instituicaoacademica1', '$this->atividade1', '$this->periodoacademico1');";
                Yii::$app->db->createCommand($sql)->execute();
            }
            if($this->instituicaoacademica2 != ""){
                $sql = "INSERT INTO j17_candidato_experiencia_academica (idCandidato, instituicao, atividade, periodo) VALUES ($this->id, '$this->instituicaoacademica2', '$this->atividade2', '$this->periodoacademico2');";
                Yii::$app->db->createCommand($sql)->execute();
            }
            if($this->instituicaoacademica3 != ""){
                $sql = "INSERT INTO j17_candidato_experiencia_academica (idCandidato, instituicao, atividade, periodo) VALUES ($this->id, '$this->instituicaoacademica3', '$this->atividade3', '$this->periodoacademico3');";
                Yii::$app->db->createCommand($sql)->execute();
            }
            return true;
        }catch(Exception $e){
            return false;
        }
    }


    /*Responsável pela reunião de todas as cartas de recomendações em um array para salvamento*/
    public function arrayCartas(){
        $array = [];

        $array['nome'] = $this->cartaNomeReq1 != "" && $this->cartaNomeReq2 != "" ? [$this->cartaNomeReq1, $this->cartaNomeReq2] : [];
        $array['email'] = [$this->cartaEmailReq1, $this->cartaEmailReq2];

        if(isset($this->cartaNome) && isset($this->cartaEmail)){
            $this->cartaNome = array_filter($this->cartaNome);
            $this->cartaEmail = array_filter($this->cartaEmail);
        }

        for ($i=0; $i < count($this->cartaNome); $i++){
            if($this->cartaNome[$i] != "" && $this->cartaEmail[$i] != ""){
                array_push($array['nome'], $this->cartaNome[$i]);
                array_push($array['email'], $this->cartaEmail[$i]);
            }
        }
        return $array;
    }

    public function salvaCartaRecomendacao(){
        $cartas = $this->arrayCartas();
        try{
            Recomendacoes::deleteAll(['idCandidato' => $this->id]);
            for ($i=0; $i < count($cartas['nome']); $i++) {
                $recomendacao = new Recomendacoes();
                $recomendacao->idCandidato = $this->id;
                $recomendacao->dataResposta = '0000-00-00 00:00:00';
                $recomendacao->prazo = date('Y-m-d', strtotime($this->edital->datafim. ' + 1 days'));
                $recomendacao->edital_idEdital = $this->idEdital;
                $recomendacao->nome = $cartas['nome'][$i];
                $recomendacao->email = $cartas['email'][$i];
                $recomendacao->token = md5($this->id.$recomendacao->email.$recomendacao->nome.time());
                $this->recomendacoes[$i] = $recomendacao;
                if(!$recomendacao->save())
                    return false;
            }
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    /*Extração dos periódicos e conferências e salvamento no banco*/
    public function uploadXml($xmlFile) {
        if(!isset($xmlFile))

            return true;

        else{
            if($xmlFile->type == 'text/xml'){
                $caminho = $this->gerarDiretorio($this->id,$this->idEdital);
                $xmlFile->saveAs($caminho."publicacao.xml");
                if($xml = simplexml_load_file($this->diretorio.'publicacao.xml')){

                    CandidatoPublicacoes::deleteAll('idCandidato = \''.$this->id.'\' AND tipo = 1');
                    CandidatoPublicacoes::deleteAll('idCandidato = \''.$this->id.'\' AND tipo = 2');

					if($xml->{'PRODUCAO-BIBLIOGRAFICA'}->{'ARTIGOS-PUBLICADOS'}){

						foreach ($xml->{'PRODUCAO-BIBLIOGRAFICA'}->{'ARTIGOS-PUBLICADOS'} as $publicacao) {

							for ($i=0; $i < count($publicacao); $i++) {

								$candidatoPublicacoes = new CandidatoPublicacoes();
								$candidatoPublicacoes->idCandidato = $this->id;

								$candidatoPublicacoes->titulo = Html::encode($publicacao->{'ARTIGO-PUBLICADO'}[$i]->{'DADOS-BASICOS-DO-ARTIGO'}['TITULO-DO-ARTIGO']);
								$candidatoPublicacoes->local = Html::encode($publicacao->{'ARTIGO-PUBLICADO'}[$i]->{'DETALHAMENTO-DO-ARTIGO'}['TITULO-DO-PERIODICO-OU-REVISTA']);
								$candidatoPublicacoes->ano = Html::encode($publicacao->{'ARTIGO-PUBLICADO'}[$i]->{'DADOS-BASICOS-DO-ARTIGO'}['ANO-DO-ARTIGO']);
								$candidatoPublicacoes->natureza = ucwords(strtolower(Html::encode($publicacao->{'ARTIGO-PUBLICADO'}[$i]->{'DADOS-BASICOS-DO-ARTIGO'}['NATUREZA'])));
								$candidatoPublicacoes->tipo = 2;
								$candidatoPublicacoes->autores = "";
								foreach ($publicacao->{'ARTIGO-PUBLICADO'}[$i]->{'AUTORES'} as $autor) {
									$candidatoPublicacoes->autores .= ucwords(strtolower(Html::encode($autor['NOME-COMPLETO-DO-AUTOR'])))."; ";
								}

								if(!$candidatoPublicacoes->save())
									return false;
							}
						}
					}
					if($xml->{'PRODUCAO-BIBLIOGRAFICA'}->{'TRABALHOS-EM-EVENTOS'}){

						foreach ($xml->{'PRODUCAO-BIBLIOGRAFICA'}->{'TRABALHOS-EM-EVENTOS'} as $publicacao) {

							for ($i=0; $i < count($publicacao); $i++) {

								$candidatoPublicacoes = new CandidatoPublicacoes();
								$candidatoPublicacoes->idCandidato = $this->id;

								$candidatoPublicacoes->titulo = Html::encode($publicacao->{'TRABALHO-EM-EVENTOS'}[$i]->{'DADOS-BASICOS-DO-TRABALHO'}['TITULO-DO-TRABALHO']);
								$candidatoPublicacoes->local = Html::encode($publicacao->{'TRABALHO-EM-EVENTOS'}[$i]->{'DETALHAMENTO-DO-TRABALHO'}['NOME-DO-EVENTO']);
								$candidatoPublicacoes->ano = Html::encode($publicacao->{'TRABALHO-EM-EVENTOS'}[$i]->{'DADOS-BASICOS-DO-TRABALHO'}['ANO-DO-TRABALHO']);
								$candidatoPublicacoes->tipo = 1;
								$candidatoPublicacoes->natureza = ucwords(strtolower(Html::encode($publicacao->{'TRABALHO-EM-EVENTOS'}[$i]->{'DADOS-BASICOS-DO-TRABALHO'}['NATUREZA'])));
								$candidatoPublicacoes->autores = "";
								foreach ($publicacao->{'TRABALHO-EM-EVENTOS'}[$i]->{'AUTORES'} as $autor) {
									$candidatoPublicacoes->autores .= ucwords(strtolower(Html::encode($autor['NOME-COMPLETO-DO-AUTOR'])))."; ";
								}

								if(!$candidatoPublicacoes->save())
									return false;
							}
						}
					}
                    return true;
                }
            }
        }
        return false;
    }


    public function cartaOrientador($idEdital){

        $edital = Edital::find()->where(["numero" => $idEdital])->one();

        if ($edital->cartaorientador == 0){
            return false;
        }
        else{
            return true;
        }

    }

}
