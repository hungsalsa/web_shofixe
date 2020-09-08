<?php

namespace backend\modules\chi\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "chi_loaichi".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 */
class ChiLoaichi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chi_loaichi';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên loại chi',
            'status' => 'Kích hoạt',
        ];
    }

    public function getAllCosttype($listID = '')
    {

        $data = self::find()->asArray()->where('status=:status',['status'=>1]);
        if ($listID != '') {
             $data->andWhere('IN','id',$listID);
        }
        return $data->all();
    }

    // Lấy danh sách tất cả các loại chi lẻ và gia công ngoài
    public function AllLC_le($loaichi='')
    {
        $data = self::find()->select(['id','name']);
        if ($loaichi != '') {
            $data->where(['IN','id',$loaichi]);
        }
        return ArrayHelper::map($data->asArray()->orderBy(['id' => SORT_ASC])->all(),'id','name');
    }

    // Lấy danh sách tất cả các loại chi không thuộc lẻ và gia công ngoài
    public function AllLC_Khac($loaichi='')
    {
        $data = self::find()->select(['id','name']);
        if ($loaichi != '') {
            $data->where(['NOT IN','id',$loaichi]);
        }
        return ArrayHelper::map($data->asArray()->orderBy(['id' => SORT_ASC])->all(),'id','name');
    }
}
