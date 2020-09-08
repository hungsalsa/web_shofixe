<?php

namespace backend\modules\khachhang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\khachhang\models\KhDichvu;

/**
 * KhDichvuSearch represents the model behind the search form of `backend\modules\khachhang\models\KhDichvu`.
 */
class KhDichvuSearch extends KhDichvu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iddv','total_money', 'id_ketoan', 'id_quanly', 'created_at','sophieu', 'updated_at'], 'integer'],
            [['day', 'id_nhanvien', 'note', 'cuahang_id', 'id_kh', 'id_xe',  'status', 'user_add'], 'safe'],
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
        $query = KhDichvu::find()->alias('dv');

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

        $dataProvider->setSort([
            'attributes' => [
                'day' => [
                    'asc' => ['day' => SORT_ASC],
                    'desc' => ['day' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
                'cuahang_id' => [
                    'asc' => ['cuahang_id' => SORT_ASC],
                    'desc' => ['cuahang_id' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'id_kh' => [
                    'asc' => ['id_kh' => SORT_ASC],
                    'desc' => ['id_kh' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'created_at' => [
                    'asc' => ['created_at' => SORT_ASC],
                    'desc' => ['created_at' => SORT_DESC],
                    'default' => SORT_DESC
                ],
                'updated_at' => [
                    'asc' => ['updated_at' => SORT_ASC],
                    'desc' => ['updated_at' => SORT_DESC],
                    'default' => SORT_DESC
                ],
                'id_xe' => [
                    'asc' => ['id_xe' => SORT_ASC],
                    'desc' => ['id_xe' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'total_money' => [
                    'asc' => ['total_money' => SORT_ASC],
                    'desc' => ['total_money' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'sophieu' => [
                    'asc' => ['sophieu' => SORT_ASC],
                    'desc' => ['sophieu' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'status' => [
                    'asc' => ['status' => SORT_ASC],
                    'desc' => ['status' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'user_add' => [
                    'asc' => ['user_add' => SORT_ASC],
                    'desc' => ['user_add' => SORT_DESC],
                    'default' => SORT_ASC,
                ]
            ],
            'defaultOrder' => [
                'status' => SORT_ASC,
                'updated_at' => SORT_DESC,
                'user_add' => SORT_ASC,
                'day' => SORT_DESC,
                'total_money' => SORT_DESC,
            ]
        ]);

        $query->joinWith(['cuahang cu']);
        $query->joinWith(['khachhang kh','xesua xsua','user us']);

        // grid filtering conditions
        $query->andFilterWhere([
            'iddv' => $this->iddv,
            'day' => $this->day,
            // 'cuahang_id' => $this->cuahang_id,
            // 'id_kh' => $this->id_kh,
            // 'id_xe' => $this->id_xe,
            'sophieu' => $this->sophieu,
            'total_money' => $this->total_money,
            'id_ketoan' => $this->id_ketoan,
            'id_quanly' => $this->id_quanly,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // 'us.fullname' => $this->user_add,
        ]);

        $query->andFilterWhere(['like', 'id_nhanvien', $this->id_nhanvien])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'cu.name', $this->cuahang_id])
            ->andFilterWhere(['like', 'xsua.bks', $this->id_xe])
            ->andFilterWhere(['like', 'kh.name', $this->id_kh])
            ->andFilterWhere(['like', 'us.fullname', $this->user_add])
            ->andFilterWhere(['like', 'dv.status', $this->status]);

        return $dataProvider;
    }
}
