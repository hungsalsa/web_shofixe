<?php

namespace backend\modules\setting\models;

use Yii;

/**
 * This is the model class for table "tbl_setting_brands".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $alt
 * @property string $description
 * @property int $order
 * @property int $status
 */
class SettingBrands extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_setting_brands';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'image', 'alt', 'status'], 'required'],
            [['description'], 'string'],
            [['order'], 'integer'],
            [['name', 'image', 'alt', 'link'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'image' => 'Image',
            'alt' => 'Alt',
            'description' => 'Description',
            'link' => 'Link',
            'order' => 'Order',
            'status' => 'Status',
        ];
    }
}
