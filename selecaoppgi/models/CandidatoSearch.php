<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Candidato;

/**
 * CandidatoSearch represents the model behind the search form about `app\models\Candidato`.
 */
class CandidatoSearch extends Candidato
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'passoatual', 'nacionalidade', 'cursodesejado', 'regime', 'anoposcomp', 'idLinhaPesquisa', 'egressograd', 'tipopos', 'egressopos', 'periodicosinternacionais', 'periodicosnacionais', 'conferenciasinternacionais', 'conferenciasnacionais', 'duracaoingles', 'resultado'], 'integer'],
            [['senha', 'inicio', 'fim', 'nome', 'endereco', 'bairro', 'cidade', 'uf', 'cep', 'email', 'datanascimento', 'pais', 'estadocivil', 'rg', 'orgaoexpedidor', 'dataexpedicao', 'passaporte', 'cpf', 'sexo', 'telresidencial', 'telcomercial', 'telcelular', 'nomepai', 'nomemae', 'inscricaoposcomp', 'notaposcomp', 'solicitabolsa', 'vinculoemprego', 'empregador', 'cargo', 'vinculoconvenio', 'convenio', 'tituloproposta', 'motivos', 'proposta', 'curriculum', 'cartaempregador', 'comprovantepagamento', 'cursograd', 'instituicaograd', 'crgrad', 'dataformaturagrad', 'cursoesp', 'instituicaoesp', 'dataformaturaesp', 'cursopos', 'instituicaopos', 'mediapos', 'dataformaturapos', 'instituicaoingles', 'nomeexame', 'dataexame', 'notaexame', 'empresa1', 'empresa2', 'empresa3', 'cargo1', 'cargo2', 'cargo3', 'periodoprofissional1', 'periodoprofissional2', 'periodoprofissional3', 'instituicaoacademica1', 'instituicaoacademica2', 'instituicaoacademica3', 'atividade1', 'atividade2', 'atividade3', 'periodoacademico1', 'periodoacademico2', 'periodoacademico3', 'periodo'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Candidato::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'inicio' => $this->inicio,
            'fim' => $this->fim,
            'passoatual' => $this->passoatual,
            'nacionalidade' => $this->nacionalidade,
            'cursodesejado' => $this->cursodesejado,
            'regime' => $this->regime,
            'anoposcomp' => $this->anoposcomp,
            'idLinhaPesquisa' => $this->idLinhaPesquisa,
            'egressograd' => $this->egressograd,
            'tipopos' => $this->tipopos,
            'egressopos' => $this->egressopos,
            'periodicosinternacionais' => $this->periodicosinternacionais,
            'periodicosnacionais' => $this->periodicosnacionais,
            'conferenciasinternacionais' => $this->conferenciasinternacionais,
            'conferenciasnacionais' => $this->conferenciasnacionais,
            'duracaoingles' => $this->duracaoingles,
            'resultado' => $this->resultado,
        ]);

        $query->andFilterWhere(['like', 'senha', $this->senha])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'endereco', $this->endereco])
            ->andFilterWhere(['like', 'bairro', $this->bairro])
            ->andFilterWhere(['like', 'cidade', $this->cidade])
            ->andFilterWhere(['like', 'uf', $this->uf])
            ->andFilterWhere(['like', 'cep', $this->cep])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'datanascimento', $this->datanascimento])
            ->andFilterWhere(['like', 'pais', $this->pais])
            ->andFilterWhere(['like', 'estadocivil', $this->estadocivil])
            ->andFilterWhere(['like', 'rg', $this->rg])
            ->andFilterWhere(['like', 'orgaoexpedidor', $this->orgaoexpedidor])
            ->andFilterWhere(['like', 'dataexpedicao', $this->dataexpedicao])
            ->andFilterWhere(['like', 'passaporte', $this->passaporte])
            ->andFilterWhere(['like', 'cpf', $this->cpf])
            ->andFilterWhere(['like', 'sexo', $this->sexo])
            ->andFilterWhere(['like', 'telresidencial', $this->telresidencial])
            ->andFilterWhere(['like', 'telcomercial', $this->telcomercial])
            ->andFilterWhere(['like', 'telcelular', $this->telcelular])
            ->andFilterWhere(['like', 'nomepai', $this->nomepai])
            ->andFilterWhere(['like', 'nomemae', $this->nomemae])
            ->andFilterWhere(['like', 'inscricaoposcomp', $this->inscricaoposcomp])
            ->andFilterWhere(['like', 'notaposcomp', $this->notaposcomp])
            ->andFilterWhere(['like', 'solicitabolsa', $this->solicitabolsa])
            ->andFilterWhere(['like', 'vinculoemprego', $this->vinculoemprego])
            ->andFilterWhere(['like', 'empregador', $this->empregador])
            ->andFilterWhere(['like', 'cargo', $this->cargo])
            ->andFilterWhere(['like', 'vinculoconvenio', $this->vinculoconvenio])
            ->andFilterWhere(['like', 'convenio', $this->convenio])
            ->andFilterWhere(['like', 'tituloproposta', $this->tituloproposta])
            ->andFilterWhere(['like', 'motivos', $this->motivos])
            ->andFilterWhere(['like', 'proposta', $this->proposta])
            ->andFilterWhere(['like', 'curriculum', $this->curriculum])
            ->andFilterWhere(['like', 'cartaempregador', $this->cartaempregador])
            ->andFilterWhere(['like', 'comprovantepagamento', $this->comprovantepagamento])
            ->andFilterWhere(['like', 'cursograd', $this->cursograd])
            ->andFilterWhere(['like', 'instituicaograd', $this->instituicaograd])
            ->andFilterWhere(['like', 'crgrad', $this->crgrad])
            ->andFilterWhere(['like', 'dataformaturagrad', $this->dataformaturagrad])
            ->andFilterWhere(['like', 'cursoesp', $this->cursoesp])
            ->andFilterWhere(['like', 'instituicaoesp', $this->instituicaoesp])
            ->andFilterWhere(['like', 'dataformaturaesp', $this->dataformaturaesp])
            ->andFilterWhere(['like', 'cursopos', $this->cursopos])
            ->andFilterWhere(['like', 'instituicaopos', $this->instituicaopos])
            ->andFilterWhere(['like', 'mediapos', $this->mediapos])
            ->andFilterWhere(['like', 'dataformaturapos', $this->dataformaturapos])
            ->andFilterWhere(['like', 'instituicaoingles', $this->instituicaoingles])
            ->andFilterWhere(['like', 'nomeexame', $this->nomeexame])
            ->andFilterWhere(['like', 'dataexame', $this->dataexame])
            ->andFilterWhere(['like', 'notaexame', $this->notaexame])
            ->andFilterWhere(['like', 'empresa1', $this->empresa1])
            ->andFilterWhere(['like', 'empresa2', $this->empresa2])
            ->andFilterWhere(['like', 'empresa3', $this->empresa3])
            ->andFilterWhere(['like', 'cargo1', $this->cargo1])
            ->andFilterWhere(['like', 'cargo2', $this->cargo2])
            ->andFilterWhere(['like', 'cargo3', $this->cargo3])
            ->andFilterWhere(['like', 'periodoprofissional1', $this->periodoprofissional1])
            ->andFilterWhere(['like', 'periodoprofissional2', $this->periodoprofissional2])
            ->andFilterWhere(['like', 'periodoprofissional3', $this->periodoprofissional3])
            ->andFilterWhere(['like', 'instituicaoacademica1', $this->instituicaoacademica1])
            ->andFilterWhere(['like', 'instituicaoacademica2', $this->instituicaoacademica2])
            ->andFilterWhere(['like', 'instituicaoacademica3', $this->instituicaoacademica3])
            ->andFilterWhere(['like', 'atividade1', $this->atividade1])
            ->andFilterWhere(['like', 'atividade2', $this->atividade2])
            ->andFilterWhere(['like', 'atividade3', $this->atividade3])
            ->andFilterWhere(['like', 'periodoacademico1', $this->periodoacademico1])
            ->andFilterWhere(['like', 'periodoacademico2', $this->periodoacademico2])
            ->andFilterWhere(['like', 'periodoacademico3', $this->periodoacademico3])
            ->andFilterWhere(['like', 'periodo', $this->periodo]);

        return $dataProvider;
    }
}
