<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Edital;

/**
 * SearchEdital represents the model behind the search form about `app\models\Edital`.
 */
class SearchEdital extends Edital
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero'], 'integer'],
            [['cartarecomendacao', 'datainicio', 'datafim', 'documento'], 'safe'],
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
        $query = Edital::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'numero' => $this->numero,
            'datainicio' => $this->datainicio,
            'datafim' => $this->datafim,
        ]);

        $query->andFilterWhere(['like', 'cartarecomendacao', $this->cartarecomendacao])
            ->andFilterWhere(['like', 'documento', $this->documento]);

        return $dataProvider;
    }
}
