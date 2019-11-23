<?php

namespace app\modules\setting\models;

use Yii;

/**
 * This is the model class for table "modules_position".
 *
 * @property int $id
 * @property int $position
 * @property int $module_id
 */
class ModulesPosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modules_position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position', 'module_id'], 'required'],
            [['position', 'module_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'position' => 'Position',
            'module_id' => 'Module ID',
        ];
    }
}
