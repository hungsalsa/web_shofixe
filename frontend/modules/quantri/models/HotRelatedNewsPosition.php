<?php

namespace app\modules\quantri\models;

use Yii;

/**
 * This is the model class for table "related_news_position".
 *
 * @property int $id
 * @property int $id_new
 * @property int $status
 * @property int $position 1 => Tại vị trí Slider
 2 =>Tại vị trí chạy chữ
 */
class HotRelatedNewsPosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'related_news_position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_new', 'status', 'position'], 'required'],
            [['id_new', 'position'], 'integer'],
            // [['status'], 'string', 'max' => 4],
            [['id_new', 'position'], 'unique', 'targetAttribute' => ['id_new', 'position']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idrel' => 'ID',
            'id_new' => 'Id New',
            'status' => 'Status',
            'position' => 'Position',
        ];
    }
}
