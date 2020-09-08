<?php

namespace backend\modules\chi\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\chi\models\ChiKhoanchi;

/**
 * ChiKhoanchiSearch represents the model behind the search form of `backend\modules\chi\models\ChiKhoanchi`.
 */
class ChiKhoanchiSearch extends ChiKhoanchi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'status', 'loaichi_id', 'updated_at', 'user_add','donvitinh','makhoanchi'], 'safe'],
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
        $query = ChiKhoanchi::find()->alias('ck');

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
        $query->joinWith(['loaichi lc']);

        // grid filtering conditions
        $query->andFilterWhere([
            'ck.id' => $this->id,
            // 'loaichi_id' => $this->loaichi_id,
            'updated_at' => $this->updated_at,
            'makhoanchi' => $this->makhoanchi,
            'user_add' => $this->user_add,
        ]);

        $query->andFilterWhere(['like', 'ck.name', $this->name])
            ->andFilterWhere(['like', 'lc.name', $this->loaichi_id])
            ->andFilterWhere(['like', 'ck.status', $this->status]);

        return $dataProvider;
    }
}
