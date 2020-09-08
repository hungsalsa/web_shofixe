<?php

namespace backend\modules\sanpham\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sanpham\models\Product;
/**
 * ChingaySearch represents the model behind the search form of `backend\modules\chi\models\Chingay`.
 */
class Inma extends Model
{
    /**
     * @inheritdoc
     */
    public $idPro;
    public $soluong;
   public $cuahang_id;

    public function rules()
    {
        return [
            // [['id', 'total_money', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['idPro'], 'required'],
            [['idPro','cuahang_id','soluong'], 'safe'],
            [['idPro'], 'validatedate'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'idPro' => 'Tên sản phẩm',
            'soluong' => 'So luong',
            'cuahang_id' => 'Cửa hàng',
        ];
    }


    public function validatedate($attribute, $params)
    {

        $idPro = $this->$attribute;
        $cuahang_id = $this->cuahang_id;
        // print_r($params);die;
        if ($cuahang_id !='') {
            $product = Product::findOne(['cuahang_id'=>$cuahang_id,'idPro'=>$idPro]);
            if(empty($product)){
                $this->addError($attribute, 'Sản phẩm này không phải của cửa hàng');
            }
        }
        
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
    
}
