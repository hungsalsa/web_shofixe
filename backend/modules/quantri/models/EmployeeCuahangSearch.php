<?php

namespace backend\modules\quantri\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\quantri\models\EmployeeCuahang;

/**
 * EmployeeCuahangSearch represents the model behind the search form of `backend\modules\quantri\models\EmployeeCuahang`.
 */
class EmployeeCuahangSearch extends EmployeeCuahang
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['id_employee', 'cuahang_id'], 'safe'],
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
        $query = EmployeeCuahang::find()->alias('lv');

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

        $query->innerJoinWith(['cuahang cu']);
        $query->innerJoinWith(['nhanvien nv']);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'cu.name' => $this->id_employee,
            // 'nv.name' => $this->cuahang_id,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'cu.name', $this->cuahang_id])
            ->andFilterWhere(['like', 'nv.name', $this->id_employee]);

        return $dataProvider;
    }
}
