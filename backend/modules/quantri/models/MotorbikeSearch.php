<?php

namespace backend\modules\quantri\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\quantri\models\Motorbike;

/**
 * MotorbikeSearch represents the model behind the search form of `backend\modules\quantri\models\Motorbike`.
 */
class MotorbikeSearch extends Motorbike
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['bikeName', 'note', 'status', 'hangxe_id'], 'safe'],
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
        $query = Motorbike::find()->alias('xe');
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
        $query->joinWith(['hang hx']);
        $query->andFilterWhere([
            'xe.id' => $this->id,
            // 'hangxe_id' => $this->hangxe_id,
        ]);

        $query->andFilterWhere(['like', 'bikeName', $this->bikeName])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'hx.name', $this->hangxe_id])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
