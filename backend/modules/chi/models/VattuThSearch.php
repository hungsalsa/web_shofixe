<?php

namespace backend\modules\chi\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\chi\models\VattuTh;

/**
 * VattuThSearch represents the model behind the search form of `backend\modules\chi\models\VattuTh`.
 */
class VattuThSearch extends VattuTh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dvt', 'sl_dk', 'sl_nhap', 'sl_xuat', 'sl_ton', 'updated_at', 'user_add'], 'integer'],
            [['name', 'machi', 'status','cuahang_id'], 'safe'],
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
        $query = VattuTh::find();

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
            'dvt' => $this->dvt,
            'sl_dk' => $this->sl_dk,
            'sl_nhap' => $this->sl_nhap,
            'sl_xuat' => $this->sl_xuat,
            'sl_ton' => $this->sl_ton,
            'updated_at' => $this->updated_at,
            'user_add' => $this->user_add,
            'cuahang_id' => $this->cuahang_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'machi', $this->machi])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
