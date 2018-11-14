<?php

namespace frontend\modules\setting\models;

use Yii;

/**
 * This is the model class for table "setting_category_home".
 *
 * @property int $id
 * @property int $category_id
 * @property int $location
 * @property int $status
 * @property int $updated_at
 * @property int $user_update
 */
class SettingCategoryHome extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting_category_home';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'location', 'status', 'updated_at', 'user_update'], 'required'],
            [['category_id', 'location', 'updated_at', 'user_update'], 'integer'],
            [['status'], 'string', 'max' => 4],
            [['location'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'location' => 'Location',
            'status' => 'Status',
            'updated_at' => 'Updated At',
            'user_update' => 'User Update',
        ];
    }
}
