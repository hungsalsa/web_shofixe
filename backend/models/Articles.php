<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $A_ID
 * @property string $A_Title
 * @property string $A_Alias
 * @property string $A_CreatedDate
 * @property string $A_Description
 * @property string $A_Content
 * @property string $A_Image
 * @property int $A_ImageState
 * @property string $A_ModifiedDate
 * @property int $A_State
 * @property int $A_Order
 * @property int $A_Hits
 * @property int $A_CategoryID
 * @property int $A_HighLight
 * @property int $A_CreatedUserID
 * @property int $A_ModifiedUserID
 * @property int $A_IS_SYNC
 * @property string $A_EnableDate
 * @property string $A_DisableDate
 * @property string $A_IP
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['A_CreatedDate', 'A_ModifiedDate', 'A_EnableDate', 'A_DisableDate'], 'safe'],
            [['A_Description', 'A_Content'], 'string'],
            [['A_Order', 'A_Hits', 'A_CategoryID', 'A_CreatedUserID', 'A_ModifiedUserID', 'A_IS_SYNC'], 'integer'],
            [['A_Title', 'A_Alias', 'A_Image', 'A_IP'], 'string', 'max' => 300],
            [['A_ImageState', 'A_State', 'A_HighLight'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'A_ID' => 'A  ID',
            'A_Title' => 'A  Title',
            'A_Alias' => 'A  Alias',
            'A_CreatedDate' => 'A  Created Date',
            'A_Description' => 'A  Description',
            'A_Content' => 'A  Content',
            'A_Image' => 'A  Image',
            'A_ImageState' => 'A  Image State',
            'A_ModifiedDate' => 'A  Modified Date',
            'A_State' => 'A  State',
            'A_Order' => 'A  Order',
            'A_Hits' => 'A  Hits',
            'A_CategoryID' => 'A  Category ID',
            'A_HighLight' => 'A  High Light',
            'A_CreatedUserID' => 'A  Created User ID',
            'A_ModifiedUserID' => 'A  Modified User ID',
            'A_IS_SYNC' => 'A  Is  Sync',
            'A_EnableDate' => 'A  Enable Date',
            'A_DisableDate' => 'A  Disable Date',
            'A_IP' => 'A  Ip',
        ];
    }
}
