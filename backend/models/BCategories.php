<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $C_ID
 * @property int $C_ParentID
 * @property string $C_Alias
 * @property string $C_Title
 * @property int $C_Level
 * @property int $C_Order
 * @property int $C_State
 * @property string $C_Description
 * @property int $C_ComponentID
 * @property int $C_CreatedUserID
 * @property int $C_ModifiedUserID
 * @property string $C_CreatedDate
 * @property string $C_ModifiedDate
 * @property string $C_Image
 *
 * @property Articles[] $articles
 * @property BCategories $cParent
 * @property BCategories[] $bCategories
 */
class BCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['C_ParentID', 'C_Level', 'C_Order', 'C_State', 'C_ComponentID', 'C_CreatedUserID', 'C_ModifiedUserID'], 'integer'],
            [['C_Description'], 'string'],
            [['C_CreatedDate', 'C_ModifiedDate'], 'safe'],
            [['C_Alias', 'C_Title', 'C_Image'], 'string', 'max' => 300],
            [['C_ParentID'], 'exist', 'skipOnError' => true, 'targetClass' => BCategories::className(), 'targetAttribute' => ['C_ParentID' => 'C_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'C_ID' => 'C  ID',
            'C_ParentID' => 'C  Parent ID',
            'C_Alias' => 'C  Alias',
            'C_Title' => 'C  Title',
            'C_Level' => 'C  Level',
            'C_Order' => 'C  Order',
            'C_State' => 'C  State',
            'C_Description' => 'C  Description',
            'C_ComponentID' => 'C  Component ID',
            'C_CreatedUserID' => 'C  Created User ID',
            'C_ModifiedUserID' => 'C  Modified User ID',
            'C_CreatedDate' => 'C  Created Date',
            'C_ModifiedDate' => 'C  Modified Date',
            'C_Image' => 'C  Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Articles::className(), ['A_CategoryID' => 'C_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCParent()
    {
        return $this->hasOne(BCategories::className(), ['C_ID' => 'C_ParentID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBCategories()
    {
        return $this->hasMany(BCategories::className(), ['C_ParentID' => 'C_ID']);
    }
}
