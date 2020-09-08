<?php

namespace backend\modules\khachhang\models\dichvu;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ChingaySearch represents the model behind the search form of `backend\modules\chi\models\Chingay`.
 */
class Adddv extends Model
{
    /**
     * @inheritdoc
     */
    public $dichvu;
    public $price;
    public $quantity;
    public $suffixes;

    public function rules()
    {
        return [
            [['dichvu','price','quantity','suffixes'], 'safe'],
            // [['khachhang','price','quantity','suffixes'], 'safe'],
            // [['khachhang','price','quantity','suffixes'], 'safe','message'=>'Phải nhập {attribute} cần tra cứu'],
            // [['suffixes'], 'safe'],
            // [['start_date','end_date'], 'validatedate'],
            // ['dichvu', 'integer'],
            // ['dichvu', 'validateType'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'dichvu' => 'Thông tin dịch vụ',
            'price' => 'Giá',
            'quantity' => 'Số lượng',
            'suffixes' => 'Hậu tố',
        ];
    }
    
    // public function checkVitrisanpham($attribute, $params)
    // {
    //     // no real check at the moment to be sure that the error is triggered
    //     $this->addError('dichvu','Sản phẩm này chưa có vị trí, xin hãy nhập vị trí cho sản phẩm');
    // }

    // public function validateType($attribute){
    //     // $article_type = $this->$attribute;
    //     // if($article_type == "research"){
    //         $this->addError($attribute,'You are not allowed to see research Articles');
    //     // }
    // }

}
