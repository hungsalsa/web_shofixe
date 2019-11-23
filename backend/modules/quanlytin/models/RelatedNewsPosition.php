<?php

namespace backend\modules\quanlytin\models;

use Yii;

/**
 * This is the model class for table "related_news_position".
 *
 * @property int $id
 * @property int $id_new
 * @property int $position
 */
class RelatedNewsPosition extends \yii\db\ActiveRecord
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
            [['id_new', 'position','status'], 'required'],
            [['id_new', 'position','status'], 'integer'],
            [['id_new', 'position'], 'unique', 'targetAttribute' => ['id_new', 'position']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idrel' => 'idrel',
            'id_new' => 'Id New',
            'position' => 'Position',
            'status' => 'status',
        ];
    }
}
