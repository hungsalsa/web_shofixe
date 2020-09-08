<?php

namespace backend\modules\phieu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\phieu\models\PhieuGiao;

/**
 * PhieuGiaoSearch represents the model behind the search form of `backend\modules\phieu\models\PhieuGiao`.
 */
class PhieuGiaoSearch extends PhieuGiao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sophieu_dau', 'sophieu_cuoi', 'nguoi_giao', 'nguoi_nhan'], 'integer'],
            [['ngay_giao', 'status', 'cuahang_id', 'note'], 'safe'],
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
        $query = PhieuGiao::find()->alias('giao');

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

        $query->joinWith(['cuahang cu']);

        $dataProvider->setSort([
            'attributes' => [
                'created_at' => [
                    'asc' => ['created_at' => SORT_ASC],
                    'desc' => ['created_at' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
                'ngay_giao' => [
                    'desc' => ['ngay_giao' => SORT_DESC],
                    'asc' => ['ngay_giao' => SORT_ASC],
                    'default' => SORT_DESC
                ],
                'cuahang_id' => [
                    'asc' => ['cuahang_id' => SORT_ASC],
                    'desc' => ['cuahang_id' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'sophieu_dau' => [
                    'asc' => ['sophieu_dau' => SORT_ASC],
                    'desc' => ['sophieu_dau' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'sophieu_cuoi' => [
                    'asc' => ['sophieu_cuoi' => SORT_ASC],
                    'desc' => ['sophieu_cuoi' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'nguoi_giao' => [
                    'asc' => ['nguoi_giao' => SORT_ASC],
                    'desc' => ['nguoi_giao' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'nguoi_nhan' => [
                    'asc' => ['nguoi_nhan' => SORT_ASC],
                    'desc' => ['nguoi_nhan' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'user_add' => [
                    'asc' => ['user_add' => SORT_ASC],
                    'desc' => ['user_add' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
            ],
            'defaultOrder' => [
                'created_at' => SORT_DESC,
                'ngay_giao' => SORT_DESC,
                'cuahang_id' => SORT_ASC,
            ]
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ngay_giao' => $this->ngay_giao,
            // 'cuahang_id' => $this->cuahang_id,
            'sophieu_dau' => $this->sophieu_dau,
            'sophieu_cuoi' => $this->sophieu_cuoi,
            'nguoi_giao' => $this->nguoi_giao,
            'nguoi_nhan' => $this->nguoi_nhan,
        ]);

        $query->andFilterWhere(['like', 'giao.status', $this->status])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'cu.name', $this->cuahang_id]);;

        return $dataProvider;
    }
}
