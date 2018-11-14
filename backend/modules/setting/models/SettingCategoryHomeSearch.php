<?php

namespace backend\modules\setting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\setting\models\SettingCategoryHome;

/**
 * SettingCategoryHomeSearch represents the model behind the search form of `backend\modules\setting\models\SettingCategoryHome`.
 */
class SettingCategoryHomeSearch extends SettingCategoryHome
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'location', 'updated_at', 'user_update'], 'integer'],
            [[ 'category_id','status'], 'safe'],
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
        $query = SettingCategoryHome::find()->alias('setC');

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

        $query->joinWith("productCategory cate");

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'category_id' => $this->category_id,
            'location' => $this->location,
            'updated_at' => $this->updated_at,
            'user_update' => $this->user_update,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'cate.cateName', $this->category_id]);

        return $dataProvider;
    }
}
