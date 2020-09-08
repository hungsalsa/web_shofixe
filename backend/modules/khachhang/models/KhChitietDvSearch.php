<?php

namespace backend\modules\khachhang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\khachhang\models\KhChitietDv;

/**
 * KhChitietDvSearch represents the model behind the search form of `backend\modules\khachhang\models\KhChitietDv`.
 */
class KhChitietDvSearch extends KhChitietDv
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_dv', 'id_Pro_dv', 'price', 'quantity'], 'integer'],
            [['suffixes'], 'safe'],
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
        $query = KhChitietDv::find();

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
            'id_dv' => $this->id_dv,
            'id_Pro_dv' => $this->id_Pro_dv,
            'price' => $this->price,
            'quantity' => $this->quantity,
        ]);

        $query->andFilterWhere(['like', 'suffixes', $this->suffixes]);

        return $dataProvider;
    }
}
