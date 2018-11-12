<?php

namespace backend\modules\setting\models;

use Yii;

/**
 * This is the model class for table "tbl_banner".
 *
 * @property int $id
 * @property string $image
 * @property string $url
 * @property string $alt
 * @property int $order
 * @property string $content
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_id
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image', 'status', 'created_at', 'updated_at', 'user_id'], 'required'],
            [['order', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['content'], 'string'],
            [['image', 'url', 'alt'], 'string', 'max' => 255],
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
            'image' => 'Image',
            'url' => 'Url',
            'alt' => 'Alt',
            'order' => 'Order',
            'content' => 'Content',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }
}
