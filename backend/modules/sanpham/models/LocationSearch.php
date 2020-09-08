<?php

namespace backend\modules\sanpham\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sanpham\models\Location;

/**
 * LocationSearch represents the model behind the search form of `backend\modules\sanpham\models\Location`.
 */
class LocationSearch extends Location
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cuahang_id','created_at','updated_at'], 'integer'],
            [['name', 'note','status','user_add'], 'safe'],
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
        $query = Location::find()->alias('po');

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
        $query->joinWith(['cuahang cu','user u']);
        if (getUser()->manager != 1) {
            $query->andFilterWhere(['IN', 'po.cuahang_id', json_decode(getUser()->cuahang_id)]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'po.cuahang_id' => $this->cuahang_id,
            'po.created_at' => $this->created_at,
            'po.updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'po.name', $this->cuahang_id])
            ->andFilterWhere(['like', 'u.username', $this->user_add])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
