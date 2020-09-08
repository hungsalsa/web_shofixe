<?php

namespace backend\modules\chi\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\chi\models\DungcuThietbi;

/**
 * DungcuThietbiSearch represents the model behind the search form of `backend\modules\chi\models\DungcuThietbi`.
 */
class DungcuThietbiSearch extends DungcuThietbi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'donvitinh', 'quantity', 'price', 'tongnhap', 'tongxuat', 'toncuoi', 'updated_at', 'user_add'], 'integer'],
            [['madungcu', 'name', 'status', 'note'], 'safe'],
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
        $query = DungcuThietbi::find();

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
            'donvitinh' => $this->donvitinh,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'tongnhap' => $this->tongnhap,
            'tongxuat' => $this->tongxuat,
            'toncuoi' => $this->toncuoi,
            'updated_at' => $this->updated_at,
            'user_add' => $this->user_add,
        ]);

        $query->andFilterWhere(['like', 'madungcu', $this->madungcu])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
