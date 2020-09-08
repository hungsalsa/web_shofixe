<?php

namespace backend\modules\common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\common\models\SanphamThongke;

/**
 * SanphamThongkeSearch represents the model behind the search form of `backend\modules\common\models\SanphamThongke`.
 */
class SanphamThongkeSearch extends SanphamThongke
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cuahang_id', 'sldauky', 'tiendauky', 'slnhap', 'tiennhap', 'slxuat', 'tienxuat', 'slxuatnb', 'slnhapnb', 'slton', 'tienton'], 'integer'],
            [['masp', 'proName','cate_id'], 'safe'],
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
        $query = SanphamThongke::find();

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
            'cuahang_id' => $this->cuahang_id,
            'sldauky' => $this->sldauky,
            'tiendauky' => $this->tiendauky,
            'slnhap' => $this->slnhap,
            'tiennhap' => $this->tiennhap,
            'slxuat' => $this->slxuat,
            'tienxuat' => $this->tienxuat,
            'slxuatnb' => $this->slxuatnb,
            'slnhapnb' => $this->slnhapnb,
            'slton' => $this->slton,
            'cate_id' => $this->cate_id,
            'tienton' => $this->tienton,
        ]);

        $query->andFilterWhere(['like', 'masp', $this->masp])
            ->andFilterWhere(['like', 'proName', $this->proName])
            ->andFilterWhere(['like', 'cate_id', $this->cate_id]);

        return $dataProvider;
    }
}
