<?php

namespace backend\modules\khachhang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\khachhang\models\KhXe;

/**
 * KhXeSearch represents the model behind the search form of `backend\modules\khachhang\models\KhXe`.
 */
class KhXeSearch extends KhXe
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['bks','id_KH', 'nguoi_sd', 'xe'], 'safe'],
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
        $query = KhXe::find()->alias('xek');

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
        $query->joinWith(['khachhang kh','xeKhach xe']);

        // grid filtering conditions
        // $query->andFilterWhere([
            // 'id' => $this->id,
            // 'id_KH' => $this->id_KH,
            // 'xe' => $this->xe,
        // ]);

        $query->andFilterWhere(['like', 'bks', $this->bks])
            ->andFilterWhere(['like', 'xek.id', $this->id])
            ->andFilterWhere(['like', 'kh.name', $this->id_KH])
            ->andFilterWhere(['like', 'xe.bikeName', $this->xe])
            ->andFilterWhere(['like', 'nguoi_sd', $this->nguoi_sd]);

        return $dataProvider;
    }
}
