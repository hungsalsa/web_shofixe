<?php

namespace backend\modules\sanpham\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sanpham\models\Product;

/**
 * ProductSearch represents the model behind the search form of `backend\modules\sanpham\models\Product`.
 */
class ProductSuaSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'quantity', 'price_sale', 'cong_dv', 'unit', 'created_at', 'updated_at', 'user_add', 'location','guarantee'], 'integer'],
            [['idPro', 'proName', 'note', 'bike_id', 'status', 'manu_id', 'cate_id', 'cuahang_id'], 'safe'],
            [['import_price', 'price'], 'number'],
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
        $query = Product::find()->alias('pro');

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

        $query->joinWith(['cuahang cu','xesd xes','category cate','nhasanxuat manu','user','vitri vt']);

        $query->andFilterWhere(['IN', 'pro.cuahang_id', [2]]);
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'cuahang_id' => $this->cuahang_id,
            'quantity' => $this->quantity,
            'import_price' => $this->import_price,
            'price' => $this->price,
            'price_sale' => $this->price_sale,
            'cong_dv' => $this->cong_dv,
            'unit' => $this->unit,
            // 'manu_id' => $this->manu_id,
            // 'cate_id' => $this->cate_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // 'user_add' => $this->user_add,
            'location' => $this->location,
            'guarantee' => $this->guarantee,
        ]);

        $query->andFilterWhere(['like', 'idPro', $this->idPro])
            ->andFilterWhere(['like', 'proName', $this->proName])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'bike_id', $this->bike_id])
            ->andFilterWhere(['like', 'cu.name', $this->cuahang_id])
            ->andFilterWhere(['like', 'cate.cateName', $this->cate_id])
            ->andFilterWhere(['like', 'manu.manuName', $this->manu_id])
            ->andFilterWhere(['like', 'user.username', $this->user_add])
            ->andFilterWhere(['like', 'pro.status', $this->status]);

        return $dataProvider;
    }
}