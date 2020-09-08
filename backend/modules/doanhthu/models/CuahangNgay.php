<?php

namespace backend\modules\doanhthu\models;

use Yii;

/**
 * This is the model class for table "tbl_cuahang_ngay".
 *
 * @property int $id
 * @property string $ngay
 * @property int $cuahang_id
 */
class CuahangNgay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cuahang_ngay';
    }
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
            [['ngay', 'cuahang_id'], 'required'],
            [['ngay'], 'safe'],
            [['cuahang_id'], 'integer'],
            [['ngay', 'cuahang_id'], 'unique', 'targetAttribute' => ['ngay', 'cuahang_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ngay' => 'Ngay',
            'cuahang_id' => 'Cuahang ID',
        ];
    }

    public function checkExits_Save($ngay,$cuahang)
    {
        $data = self::find()->where('ngay=:ngay AND cuahang_id=:cuahang_id',[':ngay'=>$ngay,':cuahang_id'=>$cuahang])->one();
        if(!$data){
            $model = new CuahangNgay();
            $model->ngay = $ngay;
            $model->cuahang_id = $cuahang;
            $model->save();
        }
        return true;
    }
}
