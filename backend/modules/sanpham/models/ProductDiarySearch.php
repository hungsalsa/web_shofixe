<?php

namespace backend\modules\sanpham\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sanpham\models\ProductDiary;

/**
 * ProductDiarySearch represents the model behind the search form of `backend\modules\sanpham\models\ProductDiary`.
 */
class ProductDiarySearch extends ProductDiary
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cuahang_id', 'store_number', 'quantity', 'created_ad'], 'integer'],
            [['day', 'pro_id', 'status'], 'safe'],
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
        $query = ProductDiary::find();

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
            'day' => $this->day,
            'cuahang_id' => $this->cuahang_id,
            'store_number' => $this->store_number,
            'quantity' => $this->quantity,
            'created_ad' => $this->created_ad,
        ]);

        $query->andFilterWhere(['like', 'pro_id', $this->pro_id])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
