<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Produto;

/**
 * ProdutoSearch represents the model behind the search form of `common\models\Produto`.
 */
class ProdutoSearch extends Produto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProduto', 'quantStock', 'pontos', 'subCategoria_id', 'iva_id'], 'integer'],
            [['nome', 'fotoProduto', 'descricao', 'descricaoGeral'], 'safe'],
            [['preco', 'valorDesconto'], 'number'],
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
        $query = Produto::find();

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
            'idProduto' => $this->idProduto,
            'preco' => $this->preco,
            'quantStock' => $this->quantStock,
            'valorDesconto' => $this->valorDesconto,
            'pontos' => $this->pontos,
            'subCategoria_id' => $this->subCategoria_id,
            'iva_id' => $this->iva_id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'fotoProduto', $this->fotoProduto])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'descricaoGeral', $this->descricaoGeral]);

        return $dataProvider;
    }
}
