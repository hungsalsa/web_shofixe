<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\User;
use kartik\checkbox\CheckboxX;
/**
 * UserSearch represents the model behind the search form of `backend\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'manager', 'view_cuahang', 'status', 'created_at', 'updated_at','editquantity'], 'integer'],
            [['username', 'fullname', 'cuahang_id', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'image','user_update'], 'safe'],
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
        $query = User::find();

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

        $dataProvider->setSort([
                'attributes' => [
                    'id' => [
                        'asc' => ['id' => SORT_ASC],
                        'desc' => ['id' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],
                    'username' => [
                        'asc' => ['username' => SORT_ASC],
                        'desc' => ['username' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],
                    'fullname' => [
                        'asc' => ['fullname' => SORT_ASC],
                        'desc' => ['fullname' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],
                    'image' => [
                        'asc' => ['image' => SORT_ASC],
                        'desc' => ['image' => SORT_DESC],
                        'default' => SORT_DESC
                    ],
                    'manager' => [
                        'asc' => ['manager' => SORT_ASC],
                        'desc' => ['manager' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],
                    'editquantity' => [
                        'asc' => ['editquantity' => SORT_ASC],
                        'desc' => ['editquantity' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],
                    'view_cuahang' => [
                        'asc' => ['view_cuahang' => SORT_ASC],
                        'desc' => ['view_cuahang' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],
                    'cuahang_id' => [
                        'asc' => ['cuahang_id' => SORT_ASC],
                        'desc' => ['cuahang_id' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],
                    'status' => [
                        'asc' => ['status' => SORT_ASC],
                        'desc' => ['status' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],
                    'created_at' => [
                        'asc' => ['created_at' => SORT_ASC],
                        'desc' => ['created_at' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],
                    'updated_at' => [
                        'asc' => ['updated_at' => SORT_ASC],
                        'desc' => ['updated_at' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],
                    'user_update' => [
                        'asc' => ['user_update' => SORT_ASC],
                        'desc' => ['user_update' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],
                ],
                'defaultOrder' => [
                    'status' => SORT_DESC,
                    'updated_at' => SORT_DESC,
                    'username' => SORT_ASC,
                    'editquantity' => SORT_ASC,
                ]
            ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'manager' => $this->manager,
            'view_cuahang' => $this->view_cuahang,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'editquantity' => $this->editquantity,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'cuahang_id', $this->cuahang_id])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'editquantity', $this->editquantity])
            ->andFilterWhere(['like', 'user_update', $this->user_update])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
