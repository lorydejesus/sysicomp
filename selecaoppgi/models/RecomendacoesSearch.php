<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Recomendacoes;

/**
 * RecomendacoesSearch represents the model behind the search form about `app\models\Recomendacoes`.
 */
class RecomendacoesSearch extends Recomendacoes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idCandidato', 'anoTitulacao', 'dominio', 'aprendizado', 'assiduidade', 'relacionamento', 'iniciativa', 'expressao', 'ingles', 'classificacao', 'anoContato', 'conheceGraduacao', 'conhecePos', 'conheceEmpresa', 'conheceOutros', 'orientador', 'professor', 'empregador', 'coordenador', 'colegaCurso', 'colegaTrabalho', 'outrosContatos'], 'integer'],
            [['dataEnvio', 'prazo', 'nome', 'email', 'token', 'titulacao', 'cargo', 'instituicaoTitulacao', 'instituicaoAtual', 'informacoes', 'outrosLugares', 'outrasFuncoes'], 'safe'],
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
        $query = Recomendacoes::find();

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
            'idCandidato' => $this->idCandidato,
            'dataEnvio' => $this->dataEnvio,
            'prazo' => $this->prazo,
            'anoTitulacao' => $this->anoTitulacao,
            'dominio' => $this->dominio,
            'aprendizado' => $this->aprendizado,
            'assiduidade' => $this->assiduidade,
            'relacionamento' => $this->relacionamento,
            'iniciativa' => $this->iniciativa,
            'expressao' => $this->expressao,
            'ingles' => $this->ingles,
            'classificacao' => $this->classificacao,
            'anoContato' => $this->anoContato,
            'conheceGraduacao' => $this->conheceGraduacao,
            'conhecePos' => $this->conhecePos,
            'conheceEmpresa' => $this->conheceEmpresa,
            'conheceOutros' => $this->conheceOutros,
            'orientador' => $this->orientador,
            'professor' => $this->professor,
            'empregador' => $this->empregador,
            'coordenador' => $this->coordenador,
            'colegaCurso' => $this->colegaCurso,
            'colegaTrabalho' => $this->colegaTrabalho,
            'outrosContatos' => $this->outrosContatos,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'token', $this->token])
            ->andFilterWhere(['like', 'titulacao', $this->titulacao])
            ->andFilterWhere(['like', 'cargo', $this->cargo])
            ->andFilterWhere(['like', 'instituicaoTitulacao', $this->instituicaoTitulacao])
            ->andFilterWhere(['like', 'instituicaoAtual', $this->instituicaoAtual])
            ->andFilterWhere(['like', 'informacoes', $this->informacoes])
            ->andFilterWhere(['like', 'outrosLugares', $this->outrosLugares])
            ->andFilterWhere(['like', 'outrasFuncoes', $this->outrasFuncoes]);

        return $dataProvider;
    }
}
