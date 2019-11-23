<?php

namespace backend\modules\quanlytin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\quanlytin\models\NewImages;

/**
 * NewImagesSearch represents the model behind the search form of `backend\modules\quanlytin\models\NewImages`.
 */
class NewImagesSearch extends NewImages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_image', 'id_new'], 'integer'],
            [['image_menu', 'image_cate'], 'safe'],
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
        $query = NewImages::find();

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
            'id_image' => $this->id_image,
            'id_new' => $this->id_new,
        ]);

        $query->andFilterWhere(['like', 'image_menu', $this->image_menu])
            ->andFilterWhere(['like', 'image_cate', $this->image_cate]);

        return $dataProvider;
    }
}
