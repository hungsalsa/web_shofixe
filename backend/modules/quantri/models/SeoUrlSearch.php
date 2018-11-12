<?php

namespace backend\modules\quantri\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\quantri\models\SeoUrl;

/**
 * SeoUrlSearch represents the model behind the search form of `backend\modules\quantri\models\SeoUrl`.
 */
class SeoUrlSearch extends SeoUrl
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seo_url_id', 'language_id'], 'integer'],
            [['query', 'slug'], 'safe'],
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
        $query = SeoUrl::find();

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
            'seo_url_id' => $this->seo_url_id,
            'language_id' => $this->language_id,
        ]);

        $query->andFilterWhere(['like', 'query', $this->query])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
