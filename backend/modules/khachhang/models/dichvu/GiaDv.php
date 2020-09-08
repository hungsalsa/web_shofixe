<?php

namespace backend\modules\khachhang\models\dichvu;

use Yii;

/**
 * This is the model class for table "tbl_gia_dv".
 *
 * @property int $id
 * @property int $iddv
 * @property int $price
 */
class GiaDv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_gia_dv';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db1');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iddv', 'price'], 'required'],
            [['iddv', 'price'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iddv' => 'Iddv',
            'price' => 'Price',
        ];
    }

    public function getPrice($iddv)
    {
        return self::find()
        ->select(['price AS name','id'])
        // ->innerJoinWith('xeKhach mt',false)
        ->andWhere(['iddv' =>$iddv])
        ->asArray()
        ->all();
    }
}
