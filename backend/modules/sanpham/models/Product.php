<?php

namespace backend\modules\sanpham\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\quantri\models\CuaHang;
use backend\modules\quantri\models\Unit;
use backend\models\User;
use backend\modules\quantri\models\Motorbike;
/**
 * This is the model class for table "tbl_product".
 *
 * @property int $id
 * @property string $idPro
 * @property int $cuahang_id
 * @property string $proName
 * @property int $quantity
 * @property string $price
 * @property string $note
 * @property int $unit đơn vị tính
 * @property string $bike_id lắp cho xe nào
 * @property int $manu_id Nhà sản xuất
 * @property int $cate_id thuộc nhóm nào
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 * @property int $location
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product';
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
            [['idPro', 'cuahang_id', 'proName', 'unit', 'manu_id', 'cate_id', 'status'], 'required','message'=>'{attribute} không được để trống'],
            // [['cuahang_id', 'quantity', 'price_sale', 'cong_dv', 'unit', 'manu_id', 'cate_id', 'created_at', 'updated_at', 'user_add','location'], 'integer'],
            ['idPro', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z0-9]+[-]/', 'message' => '{attribute} chỉ bao gồm các ký tự a->z, A->Z,0->9 và ko chứa khoảng trắng'],
            [['price','import_price','guarantee'], 'number'],
            [['note'], 'string'],
            [['idPro'], 'string', 'max' => 100],
            [['proName'], 'string', 'max' => 255],
            [['status'], 'integer', 'max' => 4],
            [['idPro', 'cuahang_id'], 'unique', 'targetAttribute' => ['idPro', 'cuahang_id'],'message' => '{attribute}'],
            [['cuahang_id', 'proName', 'manu_id'], 'unique', 'targetAttribute' => ['cuahang_id', 'proName', 'manu_id']],


            [['cuahang_id', 'quantity', 'price_sale', 'cong_dv', 'unit', 'location', 'manu_id', 'cate_id', 'created_at', 'updated_at', 'user_add'], 'integer'],


            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idPro' => 'Mã sản phẩm',
            'cuahang_id' => 'Của cửa hàng',
            'proName' => 'Tên sản phẩm',
            'quantity' => 'Tồn đầu kỳ',
            'import_price' => 'Giá nhập',
            'price' => 'Giá bán',
            'price_sale' => 'Giá bán 2',
            'guarantee' => 'Bảo hành',
            'cong_dv' => 'Công dịch vụ',
            'note' => 'Ghi chú',
            'location' => 'Vị trí',
            'unit' => 'Đơn vị tính',
            'bike_id' => 'Lắp cho xe',
            'manu_id' => 'Nhà sản xuất',
            'cate_id' => 'Danh mục',
            'status' => 'Kích hoạt',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'user_add' => 'Người sửa',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(ProductCate::className(), ['idCate' => 'cate_id']);
    }
    public function getXesd()
    {
        return $this->hasMany(ProductMotorbike::className(), ['pro_id' => 'id']);
    }
    // public function getLapxe()
    // {
    //     return $this->hasMany(Motorbike::className(), ['pro_id' => 'id']);
    // }

    public function getVitri()
    {
        return $this->hasOne(Location::className(), ['id' => 'location']);
    }

    public function getDonvitinh()
    {
        return $this->hasOne(Unit::className(), ['id' => 'unit']);
    }

    public function getNhasanxuat()
    {
        return $this->hasOne(Manufacture::className(), ['id' => 'manu_id']);
    }

    public function getCuahang()
    {
        return $this->hasOne(CuaHang::className(), ['id' => 'cuahang_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_add']);
    }

    public function getConcatAllProduct($status = true)
    {
        $data = self::find()->alias('pro')
        // ->select(['CONCAT(idPro,"-",proName,"-",price,"-",cu.name,"-slg: ",quantity) AS nameCon','pro.id AS masp','cu.name'])
        ->select(['CONCAT(idPro, " / ", proName," /nsx: ",nsx.manuName, " (",cu.name,")") AS proName','pro.id','cu.name AS tenCH'])

        ->innerJoinWith('cuahang cu',false)
        ->innerJoinWith('nhasanxuat nsx',false)
        ->asArray()
        ->andWhere('pro.status =:Status',[':Status'=>$status]);

        if (getUser()->manager !=1) {
            $data->andWhere(['in','pro.cuahang_id',json_decode(getUser()->cuahang_id)]);
        }
        // if (!empty($cuahang)) {
        //     $data->andWhere(['in','pro.cuahang_id',$cuahang]);
        // }

        return $data->orderBy(['pro.id'=>SORT_ASC,'cu.name'=>SORT_ASC, 'quantity'=>SORT_ASC ])->all();
    }

    // Hàm để thống kê sản phẩm trang thống kê
    public function getProductThongke($cuahang_id = '',$cate_id = [],$sort ='')
    {
        $query = self::find()->select(['id','idPro','cuahang_id','proName','quantity','price','import_price','bike_id','cate_id','updated_at','manu_id'])->where('status=:status',[':status'=>true]);
        if($cuahang_id != ''){
            $query->andWhere(['in','cuahang_id',$cuahang_id]);
        }
        if(!empty($cate_id)){
            $query->andWhere(['in','cate_id',$cate_id]);
        }
        $query->orderBy(['quantity'=>SORT_DESC,'proName'=>SORT_ASC]);
        
        return $query->all();
    }

    public function AllProduct($status = true)
    {
        $cuahang = new CuaHang();
        $data = self::find()->alias('pro')
        ->select(['idPro','cuahang_id','proName','price','quantity','pro.id AS masp'])
        ->innerJoinWith(['cuahang'])
        ->asArray()
        ->andWhere('pro.status =:Status',[':Status'=>$status])
               ->orderBy(['cuahang_id'=>SORT_ASC, 'quantity'=>SORT_ASC ])->all();
        $list = [];
        foreach ($data as $value) {
            // print_r($value);die;
            $list[$value['masp']] = $value['idPro'].' - '. $value['proName'].' - '.$cuahang->getName($value['cuahang_id']).$value['cuahang_id'].'-'.$value['price'].'- slg tồn: '.$value['quantity'];
        }
        unset($data,$cuahang,$status);
        return $list;
    }

    // Hàm lấy sản phẩm cửa hàng 2 để nhân bản sang dịch vụ
    public function allProducts()
    {
        return self::find()->select(['id','idPro','proName','price','price_sale','bike_id','guarantee'])->where('cuahang_id=:cuahang AND status=:status',[':cuahang'=>2,':status'=>true])->asArray()->all();
    }

    // dem so luong theo cate cua hang
     public function getProductQuantity($cuahang_id,$cate_id='')
    {
        $data =  self::find()->where('status=:status AND cuahang_id=:cuahang_id',[':status'=>true,':cuahang_id'=>$cuahang_id]);
        if ($cate_id != '') {
            $data->andWhere(['in','cate_id',$cate_id]);
        }
        return $data->sum('quantity');
    }

    // Hàm trả về các danh mục sản phẩm khi search tìm kiếm
    public function getAllCateId($cuahang, $idPro_Aray){
        $data = self::find('cate_id')->select(['id','cate_id'])->distinct()->where('status=:status',[':status'=>true])
        ->andWhere(['IN','cuahang_id',$cuahang]);
        // dbg($idPro_Aray);
        if (!empty($idPro_Aray)) {
            $data->andWhere(['IN','idPro',$idPro_Aray]);
        }
        // pr($data->asArray()->orderBy('cate_id asc')->all());
        return array_values(ArrayHelper::map($data->asArray()->orderBy('cate_id asc')->all(),'id','cate_id'));
    }

    public function getProductByidPro($idPro)
    {
        return self::find()->where(['idPro'=>$idPro])->all();
    }
}
