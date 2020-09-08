<?php

namespace backend\modules\chi\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\chi\models\Chingay;

/**
 * ChingaySearch represents the model behind the search form of `backend\modules\chi\models\Chingay`.
 */
class ChingaySearch extends Chingay
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cuahang_id', 'nguoi_chi', 'total_money', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['day', 'note', 'status','nguoimua','kieunhap'], 'safe'],
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
        $query = Chingay::find();

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
            'day' => $this->day,
            'cuahang_id' => $this->cuahang_id,
            'nguoi_chi' => $this->nguoi_chi,
            'nguoimua' => $this->nguoimua,
            'total_money' => $this->total_money,
            'kieunhap' => $this->kieunhap,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_add' => $this->user_add,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
