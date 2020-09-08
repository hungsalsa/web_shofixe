<?php

namespace backend\modules\doanhthu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\doanhthu\models\DoanhthuKhac;

/**
 * DoanhthuKhacSearch represents the model behind the search form of `backend\modules\doanhthu\models\DoanhthuKhac`.
 */
class DoanhthuKhacSearch extends DoanhthuKhac
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'doanhthu_id', 'money'], 'integer'],
            [['name', 'note'], 'safe'],
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
        $query = DoanhthuKhac::find();

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
            'doanhthu_id' => $this->doanhthu_id,
            'money' => $this->money,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
