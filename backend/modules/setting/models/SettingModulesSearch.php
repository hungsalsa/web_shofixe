<?php

namespace backend\modules\setting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\setting\models\SettingModules;

/**
 * SettingModulesSearch represents the model behind the search form of `backend\modules\setting\models\SettingModules`.
 */
class SettingModulesSearch extends SettingModules
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'cate_id', 'created_at', 'updated_at', 'user_add', 'user_edit','status'], 'integer'],
            [['slug', 'page_show', 'positions', 'content'], 'safe'],
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
        $query = SettingModules::find();

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
            'name' => $this->name,
            'cate_id' => $this->cate_id,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_add' => $this->user_add,
            'status' => $this->status,
            'user_edit' => $this->user_edit,
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'page_show', $this->page_show])
            ->andFilterWhere(['like', 'positions', $this->positions])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
