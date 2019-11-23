<?php

namespace backend\modules\quanlytin\models;

use Yii;

/**
 * This is the model class for table "new_images".
 *
 * @property int $id_image
 * @property int $id_new
 * @property string $image_menu
 * @property string $image_cate
 */
class NewImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'new_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_new'], 'required'],
            [['id_new'], 'integer'],
            [['image_menu', 'image_cate'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_image' => 'Id Image',
            'id_new' => 'Id New',
            'image_menu' => 'Image Menu',
            'image_cate' => 'Image Cate',
        ];
    }
}
