<?php

namespace backend\modules\sanpham\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sanpham\models\ProductTransferDetail;

/**
 * ProductTransferDetailSearch represents the model behind the search form of `backend\modules\sanpham\models\ProductTransferDetail`.
 */
class ProductTransferDetailSearch extends ProductTransferDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_transfer', 'quantity'], 'integer'],
            [['pro_id', 'note'], 'safe'],
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
        $query = ProductTransferDetail::find();

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
            'id' => $this->id,
            'id_transfer' => $this->id_transfer,
            'quantity' => $this->quantity,
        ]);

        $query->andFilterWhere(['like', 'pro_id', $this->pro_id])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
