<?php

namespace backend\modules\quanlytin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\quanlytin\models\Videos;

/**
 * VideosSearch represents the model behind the search form of `backend\modules\quanlytin\models\Videos`.
 */
class VideosSearch extends Videos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idVideo', 'created_at', 'updated_at', 'user_add', 'user_edit'], 'integer'],
            [['name', 'slug', 'seo_title', 'seo_description', 'status','category_id','content','link','showtab'], 'safe'],
            [['sort'], 'number'],
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
        $query = Videos::find()->alias('v');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['updated_at'=>SORT_DESC,'created_at'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $role = Yii::$app->user->identity->getRoleName();
        if ($role =='author' || $role =='manager') {
            $query->andFilterWhere(['v.user_add' => Yii::$app->user->id]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idVideo' => $this->idVideo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_add' => $this->user_add,
            'sort' => $this->sort,
            'showtab' => $this->showtab,
            'category_id' => $this->category_id,
            'user_edit' => $this->user_edit,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'showtab', $this->showtab])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
