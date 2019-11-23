<?php

namespace backend\modules\quanlytin\models;

use Yii;

/**
 * This is the model class for table "related_news_interdependent".
 *
 * @property int $idin
 * @property int $id_main
 * @property int $status
 * @property int $id_related Các Id bài viết liên quan
 */
class RelatedNewsInterdependent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'related_news_interdependent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_main', 'status', 'id_related'], 'required'],
            [['id_main', 'id_related'], 'integer'],
            // [['status'], 'string', 'max' => 4],
            [['id_main', 'id_related'], 'unique', 'targetAttribute' => ['id_main', 'id_related']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idin' => 'Idin',
            'id_main' => 'Id Main',
            'status' => 'Status',
            'id_related' => 'Id Related',
        ];
    }

   /* public function fin($)
    {
        
    }*/
}
