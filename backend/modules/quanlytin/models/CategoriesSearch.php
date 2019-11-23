<?php

namespace backend\modules\quanlytin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\quanlytin\models\Categories;

/**
 * CategoriesSearch represents the model behind the search form of `backend\modules\quanlytin\models\Categories`.
 */
class CategoriesSearch extends Categories
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'groupId','sort', 'created_at', 'updated_at', 'userAdd'], 'integer'],
            [['cateName', 'parent_id', 'content', 'images', 'seo_title', 'keyword', 'seo_descriptions', 'status','slug','user_edit'], 'safe'],
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
        $query = Categories::find()->alias('c');

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

        $query->joinWith(["trangthai st","parent p"]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'groupId' => $this->groupId,
            // 'parent_id' => $this->parent_id,
            'sort' => $this->sort,
            'slug' => $this->slug,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'userAdd' => $this->userAdd,
            'user_edit' => $this->user_edit,
        ]);

        $query->andFilterWhere(['like', 'c.cateName', $this->cateName])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'keyword', $this->keyword])
            ->andFilterWhere(['like', 'seo_descriptions', $this->seo_descriptions])
            ->andFilterWhere(['like', 'st.name', $this->status])
            ->andFilterWhere(['like', 'p.cateName', $this->parent_id]);

        return $dataProvider;
    }
}
