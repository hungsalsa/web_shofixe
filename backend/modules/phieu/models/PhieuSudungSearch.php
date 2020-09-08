<?php

namespace backend\modules\phieu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\phieu\models\PhieuSudung;

/**
 * PhieuSudungSearch represents the model behind the search form of `backend\modules\phieu\models\PhieuSudung`.
 */
class PhieuSudungSearch extends PhieuSudung
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','so_phieu_dau', 'so_phieu_cuoi', 'sl_phieu_tot', 'ke_toan', 'quan_ly', 'created_at', 'updated_at', 'user_create'], 'integer'],
            [['ngay_sd', 'phieu_ton', 'cuahang_id', 'phieu_ton_tt', 'phieu_huy', 'note', 'status'], 'safe'],
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
        $query = PhieuSudung::find()->alias('phieu');
        $query->joinWith(['cuahang cu']);

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
            // 'cuahang_id' => $this->cuahang_id,
            'ngay_sd' => $this->ngay_sd,
            'so_phieu_dau' => $this->so_phieu_dau,
            'so_phieu_cuoi' => $this->so_phieu_cuoi,
            'sl_phieu_tot' => $this->sl_phieu_tot,
            'ke_toan' => $this->ke_toan,
            'quan_ly' => $this->quan_ly,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_create' => $this->user_create,
        ]);

        $query->andFilterWhere(['like', 'phieu_ton', $this->phieu_ton])
            ->andFilterWhere(['like', 'phieu_ton_tt', $this->phieu_ton_tt])
            ->andFilterWhere(['like', 'phieu_huy', $this->phieu_huy])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'cu.name', $this->cuahang_id]);

        return $dataProvider;
    }
}
