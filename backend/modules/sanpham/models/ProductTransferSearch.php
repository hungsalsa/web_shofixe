<?php

namespace backend\modules\sanpham\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sanpham\models\ProductTransfer;

/**
 * ProductTransferSearch represents the model behind the search form of `backend\modules\sanpham\models\ProductTransfer`.
 */
class ProductTransferSearch extends ProductTransfer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transfer', 'cuahang_id', 'chuyenden_cuahang', 'ketoan', 'nhanvien', 'created_at', 'updated_at', 'user_add','user_update'], 'integer'],
            [['day', 'note', 'status', 'type'], 'safe'],
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
        $query = ProductTransfer::find();

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
            'id_transfer' => $this->id_transfer,
            'day' => $this->day,
            'cuahang_id' => $this->cuahang_id,
            'chuyenden_cuahang' => $this->chuyenden_cuahang,
            'ketoan' => $this->ketoan,
            'nhanvien' => $this->nhanvien,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_add' => $this->user_add,
            'user_update' => $this->user_update,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
