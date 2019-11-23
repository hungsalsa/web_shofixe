<?php

namespace app\modules\setting\models;

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
class FSetting extends \yii\db\ActiveRecord
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
            'talk_do' => 'talk_do',
            'title' => 'Title',
            'description' => 'Description',
            'keyword' => 'Keyword',
            'ad' => 'Ad',
            'footer' => 'Footer',
            'google_analytics' => 'Google Analytics',
        ];
    }

    public function getSetting()
    {
        // return self::find()->one();
        $cache = Yii::$app->cache;
        // $data = \Yii::$app->cache->get('settings_app_website');
        // if ($cache->get('settings_app_website') === false)
        // {
            $data = self::find()->select(['google_analytics','talk_do','keyword','description','logo','title','footer'])->asArray()->one();
            $cache->set('settings_app_website', $data, 259200); //259200 3*24*3600 3 ngayf
        // }

    }
}
