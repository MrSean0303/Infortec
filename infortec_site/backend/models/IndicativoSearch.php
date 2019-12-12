<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Indicativo;

/**
 * IndicativoSearch represents the model behind the search form of `common\models\Indicativo`.
 */
class IndicativoSearch extends Indicativo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idIndicativo'], 'integer'],
            [['icon', 'pais', 'indicativo'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Indicativo::find();

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
            'idIndicativo' => $this->idIndicativo,
        ]);

        $query->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'pais', $this->pais])
            ->andFilterWhere(['like', 'indicativo', $this->indicativo]);

        return $dataProvider;
    }
}
