<?php

namespace backend\modules\quantri\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_unit".
 *
 * @property int $id
 * @property string $unitName
 * @property int $status
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_unit';
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
            [['unitName', 'status'], 'required'],
            [['unitName'], 'string', 'max' => 50],
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
            'unitName' => 'Unit Name',
            'status' => 'Status',
        ];
    }

    public function getAllUnit($status=true)
    {
        return ArrayHelper::map(Unit::find()->where('status =:Status',['Status'=>$status])->all(),'id','unitName');
    }
}
