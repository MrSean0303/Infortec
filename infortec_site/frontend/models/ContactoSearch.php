<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ContactoForm;

/**
 * ContactoSearch represents the model behind the search form of `frontend\models\ContactoForm`.
 */
class ContactoSearch extends ContactoForm
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idContacto', 'numero', 'utilizador_id', 'indicativo_id'], 'integer'],
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
        $query = ContactoForm::find();

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
            'idContacto' => $this->idContacto,
            'numero' => $this->numero,
            'utilizador_id' => $this->utilizador_id,
            'indicativo_id' => $this->indicativo_id,
        ]);

        return $dataProvider;
    }
}
