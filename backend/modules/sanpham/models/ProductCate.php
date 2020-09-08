<?php

namespace backend\modules\sanpham\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\User;
use backend\modules\common\models\SanphamThongke;
/**
 * This is the model class for table "tbl_product_cate".
 *
 * @property int $idCate
 * @property string $cateName
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 */
class ProductCate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_cate';
    }

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
            [['cateName', 'status', 'created_at', 'updated_at', 'user_add'], 'required','message'=>'{attribute} không được để trống'],
            [['parent_id', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['note'], 'string'],
            [['cateName'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
            [['cateName'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCate' => 'Mã',
            'cateName' => 'Tên danh mục',
            'parent_id' => 'Danh mục cha',
            'note' => 'Ghi chú',
            'status' => 'Kích hoạt',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_add']);
    }
    public function getChild()
    {
        return $this->hasMany(ProductCate::className(), ['parent_id' => 'idCate']);
    }
    public function getSanpham()
    {
        return $this->hasMany(Product::className(), ['cate_id' => 'idCate']);
    }

    public function getParent()
    {
        return $this->hasOne(ProductCate::className(), ['idCate' => 'parent_id']);
        // return $this->hasOne(ProductCate::className(), ['parent_id' => 'idCate'])->from(ProductCate::tableName() . ' parent_page');
    }

    public function getAllCate($status=true)
    {
        return ArrayHelper::map(ProductCate::find()->where('status =:Status',['Status'=>$status])->orderBy(['cateName' => SORT_ASC,'parent_id' => SORT_ASC])->all(),'idCate','cateName');
    }

    public function getCateName($id,$status=true)
    {
        $data =  ProductCate::find()->select('cateName')->where('status =:Status AND idCate=:id',['Status'=>$status,'id'=>$id])->one();
        return $data->cateName;
    }

    private $data;
    public function getCategoryParent($parent = 0,$level = '')
    {
        $result = ProductCate::find()->asArray()->where('status =:active AND parent_id =:parent',['active'=>true,'parent'=>$parent])->all();

        $level .='--| ';
        foreach ($result as $key=>$value) {
            if($parent == 0){
                $level='--| ';
            }
            $this->data[$value['idCate']] = $level.$value['cateName'];
            self::getCategoryParent($value['idCate'],$level);
        }

        return $this->data;
    }

    // Hàm lấy tất cả các Cate con của nó
    function getAllIDCate($idCate,$status = true)
    {
        $result = self::find()->select(['idCate'])->where('status =:active AND parent_id =:parent',['active'=>$status,'parent'=>$idCate])->all();
        $idList[]  = $idCate;
        foreach ($result as $value) {
            $idList[]  = $value->idCate;
        }
        unset($result);
        return $idList;
    }

    // Hàm lấy tất cả các cate parent=0 and child của nó show ra thống kê
    // public function AllCateThongke()
    // {
    //     return ProductCate::find()->alias('ca')
    //         ->select(['ca.idCate','ca.cateName','ca.parent_id','ca.total_quantity'])
    //         ->where(['ca.status'=>true,'ca.parent_id'=>0])
    //         ->innerJoinWith(['child as ch'=> function (\yii\db\ActiveQuery $query) {
    //             $query->select(['ch.idCate','ch.cateName','ch.parent_id','ch.total_quantity']);
    //             $query->andWhere(['ch.status'=>true]);
    //             // $query->joinWith(['sanpham as pro'], true);
    //         }], true)
    //         ->asArray()
    //         ->all();
    // }

    protected function findIdCuahang(){
       if($user = Yii::$app->user->identity){
           return json_decode($user->cuahang_id);

       }
       throw new NotFoundHttpException('Không tìm thấy bản ghi nào');
   }
}
