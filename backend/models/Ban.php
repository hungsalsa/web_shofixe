<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_ban".
 *
 * @property int $id
 * @property string $name
 * @property int $id_tua
 * @property string $birthday
 * @property int $sex
 * @property string $relationship
 * @property string $phone
 * @property string $email
 * @property string $price_sales
 * @property int $loinhuan
 * @property int $gianet Chuyển thành lãi của người đós
 * @property int $giaban
 * @property int $datcoc
 * @property int $thanhtoan
 * @property string $ngayphaitt
 * @property int $status
 * @property string $note
 * @property int $created_at
 * @property int $users_add
 */
class Ban extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ban';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_tua', 'loinhuan', 'gianet', 'giaban', 'thanhtoan', 'status', 'created_at', 'users_add'], 'required'],
            [['id_tua', 'loinhuan', 'gianet', 'giaban', 'datcoc', 'thanhtoan', 'created_at', 'users_add'], 'integer'],
            [['birthday', 'ngayphaitt'], 'safe'],
            [['note'], 'string'],
            [['name', 'relationship', 'phone', 'email', 'price_sales'], 'string', 'max' => 255],
            [['sex', 'status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'id_tua' => 'Id Tua',
            'birthday' => 'Birthday',
            'sex' => 'Sex',
            'relationship' => 'Relationship',
            'phone' => 'Phone',
            'email' => 'Email',
            'price_sales' => 'Price Sales',
            'loinhuan' => 'Loinhuan',
            'gianet' => 'Gianet',
            'giaban' => 'Giaban',
            'datcoc' => 'Datcoc',
            'thanhtoan' => 'Thanhtoan',
            'ngayphaitt' => 'Ngayphaitt',
            'status' => 'Status',
            'note' => 'Note',
            'created_at' => 'Created At',
            'users_add' => 'Users Add',
        ];
    }
}
