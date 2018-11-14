<?php

namespace frontend\modules\quantri\models;

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
            'typeName' => 'Type Name',
            'status' => 'Status',
        ];
    }

    public function getIdList($typeName,$status = true)
    // $typeName = array();
    {
        $data = self::find()->select(['id'])->where('status=:status',[':status'=>$status])->andWhere(['in','typeName',$typeName])->all();
        $id = [];
        foreach ($data as $value) {
            $id[] = $value->id;
        }
        unset($data);
        return $id;
    }

    public function getAllType($status = true)
    // $typeName = array();
    {
        return ArrayHelper::map(self::find()->where('status=:status',[':status'=>$status])->all(),'id','typeName');
        
    }
}
