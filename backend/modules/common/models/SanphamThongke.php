<?php

namespace backend\modules\common\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\sanpham\models\ProductCate;
use backend\modules\quantri\models\CuaHang;

/**
 * This is the model class for table "sanpham_thongke".
 *
 * @property int $id
 * @property string $masp
 * @property int $cuahang_id
 * @property string $proName
 * @property int $sldauky
 * @property int $tiendauky
 * @property int $slnhap
 * @property int $tiennhap
 * @property int $slxuat
 * @property int $tienxuat
 * @property int $slxuatnb
 * @property int $slnhapnb
 * @property int $slton
 * @property int $tienton
 */
class SanphamThongke extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sanpham_thongke';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db1');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['masp', 'cuahang_id', 'cate_id', 'proName', 'sldauky', 'tiendauky', 'slnhap', 'tiennhap', 'slxuat', 'tienxuat', 'slxuatnb', 'slnhapnb', 'slton', 'tienton'], 'required'],
            [['cuahang_id', 'cate_id', 'sldauky', 'tiendauky', 'slnhap', 'tiennhap', 'slxuat', 'tienxuat', 'slxuatnb', 'slnhapnb', 'slton', 'tienton'], 'integer'],
            [['masp'], 'string', 'max' => 100],
            [['proName'], 'string', 'max' => 255],
            [['masp', 'cuahang_id'], 'unique', 'targetAttribute' => ['masp', 'cuahang_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'masp' => Yii::t('app', 'Masp'),
            'cuahang_id' => Yii::t('app', 'Cuahang ID'),
            'cate_id' => Yii::t('app', 'Cate ID'),
            'proName' => Yii::t('app', 'Pro Name'),
            'sldauky' => Yii::t('app', 'Sldauky'),
            'tiendauky' => Yii::t('app', 'Tiendauky'),
            'slnhap' => Yii::t('app', 'Slnhap'),
            'tiennhap' => Yii::t('app', 'Tiennhap'),
            'slxuat' => Yii::t('app', 'Slxuat'),
            'tienxuat' => Yii::t('app', 'Tienxuat'),
            'slxuatnb' => Yii::t('app', 'Slxuatnb'),
            'slnhapnb' => Yii::t('app', 'Slnhapnb'),
            'slton' => Yii::t('app', 'Slton'),
            'tienton' => Yii::t('app', 'Tienton'),
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(ProductCate::className(), ['idCate' => 'cate_id']);
    }

    public function getCuaHang()
    {
        return $this->hasOne(CuaHang::className(), ['id' => 'cuahang_id']);
    }

    public function getThongke($cuahang_id=[],$reset = false)
    {
            $data = self::find()->alias('tk')->select(['{{tk}}.*','cate.cateName','ch.name AS tencuahang'])->joinWith(['category cate','cuaHang ch'],false);
            if (!empty($cuahang_id)) {
                $data->andWhere(['IN','cuahang_id',$cuahang_id]);
            }
            
            $product = $data->asArray()->orderBy(['tk.cuahang_id'=>SORT_ASC,'cate.cateName'=>SORT_ASC, 'tk.slton'=>SORT_ASC,'tk.proName'=>SORT_ASC])->all();
            // dbg($product);
            return $product;
    }

    public function getThongkeQuery($cuahang_id=[],$cate_id =[],$proId = [])
    {
            $data = self::find()->alias('tk')->select(['{{tk}}.*','cate.cateName','ch.name AS tencuahang'])->joinWith(['category cate','cuaHang ch'],false);
            if (!empty($cuahang_id)) {
                $data->andWhere(['IN','cuahang_id',$cuahang_id]);
            }
            if (!empty($cate_id)) {
                $data->andWhere(['IN','cate_id',$cate_id]);
            }
            if (!empty($proId)) {
                $data->andWhere(['IN','tk.masp',$proId]);
            }
            $data->asArray()->orderBy(['tk.cuahang_id'=>SORT_ASC,'cate.cateName'=>SORT_ASC, 'tk.slton'=>SORT_ASC,'tk.proName'=>SORT_ASC])->all();
            // dbg($product);
        return $data;
    }

    public function getProduct($cuahang_id=[])
    {
        $data = self::find()->alias('tk')->select(['tk.masp','CONCAT(tk.masp," / ",tk.proName) AS tensp','ch.name AS tencuahang'])->joinWith(['category cate','cuaHang ch'],false);
        if (!empty($cuahang_id)) {
            $data->where(['IN','cuahang_id',$cuahang_id]);
        }
        
        // return $data->asArray()->orderBy(['tk.cuahang_id'=>SORT_ASC,'cate.cateName'=>SORT_ASC, 'tk.proName'=>SORT_ASC ])->all();
        return ArrayHelper::map($data->asArray()->orderBy(['tk.cuahang_id'=>SORT_ASC,'cate.cateName'=>SORT_ASC, 'tk.proName'=>SORT_ASC ])->all(),'masp','tensp');
    }

    // Hàm lấy tất cả các Cate con của nó
    public function getAllIDCate($idCate,$status = true)
    {
        $result = ProductCate::find()->select(['idCate'])->where('status =:active',['active'=>$status])
        ->andWhere(['IN','parent_id',$idCate])->all();
        $idList  = [$idCate];
        foreach ($result as $value) {
            $idList[]  = $value->idCate;
        }
        unset($result);
        return $idList;
    }

    public function getCate($idPro)
    {

        $data = self::find()->alias('tk')->select(['tk.cate_id'])->distinct()->andWhere(['IN','masp',$idPro])->asArray()->all();
        $list=[];
        foreach ($data as $value) {
            $list = array_merge($list,array_values($value));
        }
        return $list;
    }

    public function getProductQuantity($cuahang_id,$cate_id=[])
    {
        $data =  self::find()->where('cuahang_id=:cuahang_id',[':cuahang_id'=>$cuahang_id]);
        if (!empty($cate_id)) {
            $listCate = [];
            foreach ($cate_id as $value) {
                $listCate = array_merge($listCate,$this->getAllIDCate($value));
            }
            $data->andWhere(['in','cate_id',$listCate]);
        }
        return $data->sum('slton');
    }
    // Hàm kiểm tra sản phẩm 
    public function checkCountSP($cuahang_id,$cate_id)
    {
        return self::find()->where(['cate_id'=>$cate_id,'cuahang_id'=>$cuahang_id])->count();
    }

    // Laays tất cả danh sách cate có trong bảng sản phẩm
    // public function getAllcatefomProduct()
    // {
    //     return $data = self::find('cate_id')
    //     // ->distinct()->select('cate_id')
    //     ->where(['cuahang_id'=>2])
    //     ->andWhere(['>','slton',0])
    //     ->asArray()->orderBy(['cate_id'=>SORT_ASC])->all();
    //     // return ArrayHelper::map($data,'cate_id','cate_id');
    // }
}
