<?php

namespace backend\modules\phieu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\phieu\models\PhieuTon;

/**
 * PhieuTonSearch represents the model behind the search form of `backend\modules\phieu\models\PhieuTon`.
 */
class PhieuTonSearch extends PhieuTon
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'so_phieu_ton'], 'integer'],
            [['ngay_sd', 'note', 'status'], 'safe'],
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
        $query = PhieuTon::find();

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
            'so_phieu_ton' => $this->so_phieu_ton,
            'ngay_sd' => $this->ngay_sd,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}