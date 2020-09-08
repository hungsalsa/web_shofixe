<?php

namespace backend\modules\sanpham\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\User;
/**
 * This is the model class for table "tbl_manufacture".
 *
 * @property int $id
 * @property string $manuName
 * @property string $address
 * @property string $phone
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 */
class Manufacture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_manufacture';
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
            [['manuName', 'status', 'created_at', 'updated_at', 'user_add'], 'required','message'=>'{attribute} không được để trống'],
            [['note'], 'string'],
            [['created_at', 'updated_at', 'user_add'], 'integer'],
            [['manuName', 'address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
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
            'manuName' => 'Tên nhà sản xuất',
            'address' => 'Địa chỉ',
            'phone' => 'Số điện thoại',
            'note' => 'Note',
            'status' => 'Kích hoạt',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_add']);
    }

    public function getAllManufacture($status=true)
    {
        return ArrayHelper::map(Manufacture::find()->where('status =:Status',['Status'=>$status])->all(),'id','manuName');
    }

    public function getManuName($id,$status=true)
    {
        $data =  Manufacture::find()->select('manuName')->where('status =:Status AND id=:id',['Status'=>$status,'id'=>$id])->one();
        if (empty($data)) {
            return false;
        } else {
            return $data->manuName;
        }
    }

    // tra ve ten hang san xuat truyen vao id=:id
    public function getName($id)
    {
        if (($model = Manufacture::findOne($id)) !== null) {
            return $model->manuName;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
}
