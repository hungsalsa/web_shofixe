<?php

namespace backend\modules\quantri\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tbl_product_type".
 *
 * @property int $id
 * @property string $typeName
 * @property int $status
 */
class ProductType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['typeName'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'typeName' => 'Loại sản phẩm',
            'status' => 'Trạng thái',
        ];
    }

    public function getAllProductType($status = true)
    {
        return ArrayHelper::map(self::find()->where('status=:active',[':active'=>$status])->all(),'id','typeName');
    }
}
