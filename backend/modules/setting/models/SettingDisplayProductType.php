<?php

namespace backend\modules\setting\models;

use Yii;

/**
 * This is the model class for table "setting_display_product_type".
 *
 * @property int $id
 * @property int $category_home_id
 * @property int $product_type_id
 * @property string $name
 */
class SettingDisplayProductType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting_display_product_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_type_id', 'name'], 'required'],
            [['category_home_id', 'product_type_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['product_type_id', 'category_home_id'], 'unique', 'targetAttribute' => ['product_type_id', 'category_home_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_home_id' => 'Category Home ID',
            'product_type_id' => 'Loại sản phẩm',
            'name' => 'Tên hiển thị',
        ];
    }
}
