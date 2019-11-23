<?php

namespace backend\modules\setting\models;

use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property int $id
 * @property string $logo
 * @property string $title
 * @property string $description
 * @property string $keyword
 * @property string $ad
 * @property string $footer
 * @property string $google_analytics
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['logo','talk_do'], 'required'],
            [['description', 'footer'], 'string'],
            [['logo', 'title', 'keyword', 'ad', 'google_analytics'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'logo' => 'Logo',
            'talk_do' => 'Bật chát talk_do',
            'title' => 'Seo Title',
            'description' => 'Seo Description',
            'keyword' => 'Seo Keywords',
            'ad' => 'Ad',
            'footer' => 'Footer',
            'google_analytics' => 'Google Analytics',
        ];
    }
}
