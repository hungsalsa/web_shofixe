<?php

namespace backend\modules\sanpham\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sanpham\models\ProductCate;

/**
 * ProductCateSearch represents the model behind the search form of `backend\modules\sanpham\models\ProductCate`.
 */
class ProductCateSearch extends ProductCate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCate', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['cateName', 'note', 'parent_id', 'status'], 'safe'],
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
        $query = ProductCate::find()->alias('cate');

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
                'cateName' => [
                    'asc' => ['cateName' => SORT_ASC],
                    'desc' => ['cateName' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'parent_id' => [
                    'asc' => ['parent_id' => SORT_ASC],
                    'desc' => ['parent_id' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'updated_at' => [
                    'asc' => ['updated_at' => SORT_ASC],
                    'desc' => ['updated_at' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'status' => [
                    'asc' => ['status' => SORT_ASC],
                    'desc' => ['status' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                
            ],
            'defaultOrder' => [
                'updated_at' => SORT_DESC,
                'cateName' => SORT_ASC,
                'parent_id' => SORT_ASC,
            ]
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'idCate' => $this->idCate,
            // 'parent_id' => $this->parent_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_add' => $this->user_add,
        ]);

        $query->andFilterWhere(['like', 'cateName', $this->cateName])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'cate.cateName', $this->parent_id]);

        return $dataProvider;
    }
}
