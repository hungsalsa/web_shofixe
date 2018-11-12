<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Ban;

/**
 * BanSearch represents the model behind the search form of `backend\models\Ban`.
 */
class BanSearch extends Ban
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_tua', 'loinhuan', 'gianet', 'giaban', 'datcoc', 'thanhtoan', 'created_at', 'users_add'], 'integer'],
            [['name', 'birthday', 'sex', 'relationship', 'phone', 'email', 'price_sales', 'ngayphaitt', 'status', 'note'], 'safe'],
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
        $query = Ban::find();

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
            'id_tua' => $this->id_tua,
            'birthday' => $this->birthday,
            'loinhuan' => $this->loinhuan,
            'gianet' => $this->gianet,
            'giaban' => $this->giaban,
            'datcoc' => $this->datcoc,
            'thanhtoan' => $this->thanhtoan,
            'ngayphaitt' => $this->ngayphaitt,
            'created_at' => $this->created_at,
            'users_add' => $this->users_add,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'relationship', $this->relationship])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'price_sales', $this->price_sales])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
