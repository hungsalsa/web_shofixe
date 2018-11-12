<?php

namespace backend\modules\quanlytin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\quanlytin\models\News;

/**
 * NewsSearch represents the model behind the search form of `backend\modules\quanlytin\models\News`.
 */
class NewsSearch extends News
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'view', 'sort', 'user_add', 'created_at', 'updated_at'], 'integer'],
            [['name', 'link', 'images', 'image_category', 'image_detail', 'htmltitle', 'htmlkeyword', 'htmldescriptions', 'short_description', 'content', 'hot', 'related_products', 'related_news', 'status'], 'safe'],
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
        $query = News::find();

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
            'category_id' => $this->category_id,
            'view' => $this->view,
            'sort' => $this->sort,
            'user_add' => $this->user_add,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'image_category', $this->image_category])
            ->andFilterWhere(['like', 'image_detail', $this->image_detail])
            ->andFilterWhere(['like', 'htmltitle', $this->htmltitle])
            ->andFilterWhere(['like', 'htmlkeyword', $this->htmlkeyword])
            ->andFilterWhere(['like', 'htmldescriptions', $this->htmldescriptions])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'hot', $this->hot])
            ->andFilterWhere(['like', 'related_products', $this->related_products])
            ->andFilterWhere(['like', 'related_news', $this->related_news])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
