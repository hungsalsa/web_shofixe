<?php

namespace backend\modules\setting\models;

use Yii;
use backend\modules\quantri\models\ProductCategory;
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
            [['location'], 'unique','message'=>'{attribute} này đã có xin chọn {attribute} khác'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Danh mục sản phẩm',
            'location' => 'Vị trí',
            'status' => 'Kích hoạt',
            'updated_at' => 'Updated At',
            'user_update' => 'User Update',
        ];
    }

    // Hai ham de lien ket filter index
    public function getProductCategory()
    {
        return $this->hasOne(Productcategory::className(),['idCate'=>'category_id']);
    }

    public function getDisplayProductType()
    {
        return $this->hasMany(SettingDisplayProductType::className(), ['category_home_id' => 'id']);
    }
}
