<?php

namespace backend\modules\khachhang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\khachhang\models\KhachhangDichvuList;

/**
 * KhachhangDichvuListSearch represents the model behind the search form of `backend\modules\khachhang\models\KhachhangDichvuList`.
 */
class KhachhangDichvuListSearch extends KhachhangDichvuList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'price','price_sale','guarantee'], 'integer'],
            [['madichvu', 'tendv', 'updated_at', 'user_add', 'xe_sd','phutung','status'], 'safe'],
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
        $query = KhachhangDichvuList::find()->alias('ds');

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
        $query->joinWith(['user us','xeKhach xk']);
        // grid filtering conditions
        $query->andFilterWhere([
            // 'id' => $this->id,
            'price' => $this->price,
            'phutung' => $this->phutung,
            'guarantee' => $this->guarantee,
            'ds.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'madichvu', $this->madichvu])
            ->andFilterWhere(['like', 'xk.bikeName', $this->xe_sd])
            ->andFilterWhere(['like', 'us.fullname', $this->user_add])
            ->andFilterWhere(['like', 'ds.status', $this->status])
            ->andFilterWhere(['like', 'ds.id', $this->id])
            ->andFilterWhere(['like', 'tendv', $this->tendv]);

        return $dataProvider;
    }
}
