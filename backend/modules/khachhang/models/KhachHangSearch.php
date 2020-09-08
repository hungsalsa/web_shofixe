<?php

namespace backend\modules\khachhang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\khachhang\models\KhachHang;

/**
 * KhachHangSearch represents the model behind the search form of `backend\modules\khachhang\models\KhachHang`.
 */
class KhachHangSearch extends KhachHang
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idKH', 'created_at', 'age', 'updated_at'], 'integer'],
            [['name', 'phone', 'address', 'note', 'status', 'user_add','job','facebook','email','job'], 'safe'],
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
        $query = KhachHang::find();

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
                'name' => [
                    'asc' => ['name' => SORT_ASC],
                    'desc' => ['name' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'phone' => [
                    'asc' => ['phone' => SORT_ASC],
                    'desc' => ['phone' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'address' => [
                    'asc' => ['address' => SORT_ASC],
                    'desc' => ['address' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'created_at' => [
                    'asc' => ['created_at' => SORT_ASC],
                    'desc' => ['created_at' => SORT_DESC],
                    'default' => SORT_DESC
                ],
                'status' => [
                    'asc' => ['status' => SORT_ASC],
                    'desc' => ['status' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'updated_at' => [
                    'asc' => ['updated_at' => SORT_ASC],
                    'desc' => ['updated_at' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'user_add' => [
                    'asc' => ['user_add' => SORT_ASC],
                    'desc' => ['user_add' => SORT_DESC],
                    'default' => SORT_ASC,
                ]
            ],
            'defaultOrder' => [
                'updated_at' => SORT_DESC,
                'created_at' => SORT_DESC,
                'name' => SORT_ASC,
                'address' => SORT_ASC,
            ]
        ]);

        $query->joinWith(['user']);

        // grid filtering conditions
        $query->andFilterWhere([
            'idKH' => $this->idKH,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // 'user_add' => $this->user_add,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'user.fullname', $this->user_add]);

        return $dataProvider;
    }
}
