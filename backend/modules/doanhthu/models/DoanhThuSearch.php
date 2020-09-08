<?php

namespace backend\modules\doanhthu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\doanhthu\models\DoanhThu;

/**
 * DoanhThuSearch represents the model behind the search form of `backend\modules\doanhthu\models\DoanhThu`.
 */
class DoanhThuSearch extends DoanhThu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'giao_sang', 'tt_ck', 'tt_the', 'tt_tien_mat', 'tong_doanh_thu_phieu', 'doanh_thu_thuc', 'thu_khac', 'tien_chi', 'tien_hom', 'tien_le', 'chenh_lech', 'ketoan', 'nguoi_ky', 'created_at', 'updated_at','tong_tien_mat', 'user_add'], 'integer'],
            [['ngay', 'note', 'cua_hang', 'status'], 'safe'],
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
        $query = DoanhThu::find()->alias('dt');

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ngay' => $this->ngay,
            'giao_sang' => $this->giao_sang,
            'tt_ck' => $this->tt_ck,
            'tt_the' => $this->tt_the,
            'tt_tien_mat' => $this->tt_tien_mat,
            'tong_doanh_thu_phieu' => $this->tong_doanh_thu_phieu,
            'doanh_thu_thuc' => $this->doanh_thu_thuc,
            'thu_khac' => $this->thu_khac,
            'tien_chi' => $this->tien_chi,
            'tien_hom' => $this->tien_hom,
            'tien_le' => $this->tien_le,
            'tt_tien_mat' => $this->tt_tien_mat,
            'chenh_lech' => $this->chenh_lech,
            'ketoan' => $this->ketoan,
            'nguoi_ky' => $this->nguoi_ky,
            // 'cua_hang' => $this->cua_hang,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_add' => $this->user_add,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'cu.name', $this->cua_hang]);

        return $dataProvider;
    }
}
