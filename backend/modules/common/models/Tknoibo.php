<?php

namespace backend\modules\common\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\sanpham\models\ProductTransfer;

class Tknoibo extends \yii\db\ActiveRecord
{
    /*HÀM LẤY DANH SÁCH CHUYỂN HÀNG NỘI BỘ*/
    public function getAllChuyenNB()
    {
        $data = ProductTransfer::find()->alias('tf')
            ->joinWith(['transferDetails tdt'],true)
            ->asArray()->orderBy(['tf.cuahang_id'=>SORT_ASC,'tf.status'=>SORT_ASC])->all();
        return $data;
    }

}
