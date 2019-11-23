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
            [['id', 'view', 'see_more', 'sort', 'user_add', 'created_at', 'updated_at'], 'integer'],
            [['name', 'slug', 'images', 'image_category', 'image_detail', 'seo_title', 'seo_keyword', 'seo_descriptions', 'short_description', 'content', 'hot', 'related_products', 'related_news', 'status','popular', 'category_id','user_edit'], 'safe'],
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
        $query = News::find()->alias('n');

        // add conditions that should always apply here
// dbg(Yii::$app->user->id);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            // 'pagination' => [
            //     'pageSize' => 5,
            // ],
            // 'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith(['danhmuc dm']);
        $role = Yii::$app->user->identity->getRoleName();
        if ($role =='author' || $role =='manager') {
            $query->andFilterWhere(['n.user_add' => Yii::$app->user->id]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'category_id' => $this->category_id,
            'view' => $this->view,
            'see_more' => $this->see_more,
            'n.sort' => $this->sort,
            'popular' => $this->popular,
            'user_add' => $this->user_add,
            'user_edit' => $this->user_edit,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'n.slug', $this->slug])
            ->andFilterWhere(['like', 'popular', $this->popular])
            ->andFilterWhere(['like', 'dm.cateName', $this->category_id])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'image_category', $this->image_category])
            ->andFilterWhere(['like', 'image_detail', $this->image_detail])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_keyword', $this->seo_keyword])
            ->andFilterWhere(['like', 'seo_descriptions', $this->seo_descriptions])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'hot', $this->hot])
            ->andFilterWhere(['like', 'related_products', $this->related_products])
            ->andFilterWhere(['like', 'related_news', $this->related_news])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
