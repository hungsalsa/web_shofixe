<?php

namespace backend\modules\quantri\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\quantri\models\ImgproList;

/**
 * ImgproListSearch represents the model behind the search form of `backend\modules\quantri\models\ImgproList`.
 */
class ImgproListSearch extends ImgproList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pro_id'], 'integer'],
            [['image', 'title', 'alt', 'status'], 'safe'],
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
        $query = ImgproList::find();

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
            'pro_id' => $this->pro_id,
        ]);

        $query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'alt', $this->alt])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
