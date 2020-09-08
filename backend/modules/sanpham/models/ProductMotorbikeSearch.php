<?php

namespace backend\modules\sanpham\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sanpham\models\ProductMotorbike;

/**
 * ProductMotorbikeSearch represents the model behind the search form of `backend\modules\sanpham\models\ProductMotorbike`.
 */
class ProductMotorbikeSearch extends ProductMotorbike
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['pro_id', 'motor_id'], 'safe'],
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
        $query = ProductMotorbike::find()->alias('pmt');;

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

        $query->joinWith(['xe','sanpham pro']);
        // $query->joinWith([]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'pro_id' => $this->pro_id,
            // 'motor_id' => $this->motor_id,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'pro.proName', $this->pro_id])
            ->andFilterWhere(['like', 'xe.name', $this->motor_id]);

        return $dataProvider;
    }
}
