<?php

namespace backend\modules\khachhang\models;

use Yii;
use backend\modules\quantri\models\Motorbike;
use backend\modules\sanpham\models\Product;
use backend\modules\sanpham\models\ProductMotorbike;
use backend\models\User;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "khachhang_dichvu_list".
 *
 * @property int $id
 * @property string $tendv
 * @property int $price
 * @property int $price_sale
 * @property int $xe_sd
 */
class KhachhangDichvuList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'khachhang_dichvu_list';
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
            [['tendv','status'], 'required','message'=>'{attribute} không được để trống'],
            [['price','updated_at', 'user_add','price_sale','guarantee'], 'integer'],
            [['tendv'], 'string', 'max' => 255],
            [['madichvu'], 'string', 'max' => 100],
            ['madichvu', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z0-9\-]/', 'message' => '{attribute} chỉ bao gồm các ký tự a->z, A->Z,0->9 và ko chứa khoảng trắng'],
            [['phutung'], 'integer', 'max' => 4],
            [['xe_sd'], 'safe'],
            [['tendv'], 'unique'],
            // [['tendv', 'xe_sd'], 'unique', 'targetAttribute' => ['tendv', 'xe_sd'],'message'=>'Dịch vụ cho xe này đã có, không thể thêm nữa'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phutung' => 'Phụ tùng',
            'madichvu' => 'Mã dịch vụ',
            'tendv' => 'Tên dịch vụ',
            'tenhoadon' => Yii::t('app', 'Tên trên hóa đơn'),
            'price' => 'Giá bán',
            'price_sale' => 'Giá bán 2',
            'guarantee' => 'Bảo hành',
            'xe_sd' => 'Xe sử dụng',
            'status' => 'Kích hoạt',
            'updated_at' => 'Chỉnh sửa',
            'user_add' => 'Người sửa',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_add']);
    }

    public function getXeKhach()
    {
        return $this->hasOne(Motorbike::className(), ['id' => 'xe_sd']);
    }

    public function getXesudung()
    {
        return $this->hasMany(ProductMotorbike::className(), ['id' => 'xe_sd']);
    }
    public function baohanh($id_pro_dv)
    {
        $data = self::find()->select('guarantee')->where(['id'=>$id_pro_dv])->one();
        return $data->guarantee;
    }

    public function getMotorbike($iddv)
    {
        $data = self::find()->select('xe_sd')->where(['id'=>$iddv])->one();
        // dbg($data);
        if ($data) {
            $moto = new Motorbike();
            $name = $moto->ReturnBikename(json_decode($data->xe_sd));
            return $name;
        }else {
            return '';
        }
    }

    public function getDefaultDistrict($param1)
    {
        $data=self::find()
        ->where(['id'=>$param1])
        ->select(['id','name' ])->asArray()->all();

        return $data;

    }

    // kiểm tra xem dịch vụ là sản phẩm thì có vị trí chưa?
    public function checkVitri($iddv,$cuahang_id)
    {
        $model = self::find()->select(['madichvu','phutung'])
                 ->where(['id'=>$iddv])->one();
        if ($model->phutung == 1) {
            $product = Product::find()->select('location')->where(['idPro'=>$model->madichvu,'cuahang_id'=>$cuahang_id])->one();
            if (!$product) {
                return false;
            }
            if ($product->location == 0) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    /*HÀM LẤY GIÁ DỊCH VỤ ĐỂ SHOW RA PHIẾU KHÁCH HÀNG */
    public function getPricService($iddv)
    {

        $data = self::find()
        ->select(['price','price_sale','id'])
        // ->innerJoinWith('xeKhach mt',false)
        ->andWhere(['id' =>$iddv])
        ->asArray()
        ->one();
        return $result = [
            0 =>[
                'id'=>$data['price'],
                'name'=>Yii::$app->formatter->asDecimal($data['price'],0),
            ],
            1 =>[
                'id'=>$data['price_sale'],
                'name'=>Yii::$app->formatter->asDecimal($data['price_sale'],0),
            ]
        ];
    }
    public function UpdatePhieuDV($iddv)
    {
        if ($this->getPricService($iddv)) {
            return ArrayHelper::map($this->getPricService($iddv),'id','name');
        } else {
            return array('id'=>'null','name'=>'null');
        }
    }

    // LẤY DỊCH VỤ ĐỂ SHOW RA DỊCH VỤ KHÁCH HÀNG (ko laays phu tung)
    public function AllDichvu($status=true,$phutung = 0)
    {
        $data = self::find()->alias('dv')
        ->select(['CONCAT(madichvu,"/",tendv,"/",price) AS TTDV','CONCAT(dv.id,"DV") AS iddv','dv.id',])
        ->where('status=:sta AND phutung=:pt',[':sta'=>$status,':pt'=>$phutung]);
        // ->where('status=:status',[':status'=>$status]);
        // ->innerJoinWith('xeKhach moto',false);
        // ->innerJoinWith('xeKhach mt',false)
        $data = $data->asArray()->orderBy(['madichvu'=>SORT_ASC,'tendv'=>SORT_ASC ])->all();
        return ArrayHelper::map($data,'iddv','TTDV');
    }

    // LẤY DỊCH VỤ ĐỂ SHOW RA DỊCH VỤ KHÁCH HÀNG
    public function getAllDichvu($status=true)
    {

        $phutung = $this->getAllPhutungDichvu();
        $phutung = $this->AllProduct($phutung);
        // dbg($phutung);
        $data = self::find()->alias('dv')
        ->select(['CONCAT(madichvu,"/",tendv,"/",tendv) AS TTDV','dv.id','xe_sd'])
        ->where('status=:status AND phutung =:phutung',[':status'=>$status,':phutung'=>0])
        ->asArray()->orderBy(['id'=>SORT_ASC,'tendv'=>SORT_ASC ])->all();
        $moto = new Motorbike();
        foreach ($data as $key => $value) {
            if ($value['xe_sd'] != '') {
                $data[$key]['TTDV'] .= ' ('. $moto->ReturnBikename(json_decode($value['xe_sd'])).')';
            }
        }
        $data =  ArrayHelper::map($data,'id','TTDV');
        
        return $result = ($data+$phutung);
        // pr(array_merge($data,$phutung));
       
    }

    // hàm lấy tất cả các dịch vụ là phụ tùng
    public function getAllPhutungDichvu($status=true)
    {
        $data = self::find()->alias('dv')
        ->select(['dv.id','madichvu','tendv'])
        ->where('status=:status AND phutung =:phutung',[':status'=>$status,':phutung'=>1])
        ->asArray()->orderBy(['id'=>SORT_ASC,'tendv'=>SORT_ASC ])->all();
        return ArrayHelper::map($data,'id','madichvu');
    }


    // Hàm lấy ra tất cả các phụ tùng hợp với dịch vụ
    private function AllProduct($idPro,$status = true)
    {
        $ListDV = [];
        foreach ($idPro as $key => $value) {

            $data = Product::find()->alias('p')
            ->select(['CONCAT(idPro, " / ", proName," /nsx: ",nsx.manuName, " (",cate.cateName,")") AS proName','p.id','cate.cateName'])

            ->innerJoinWith('category cate',false)
            ->innerJoinWith('nhasanxuat nsx',false)
            ->andWhere('p.status =:Status AND p.cuahang_id =:cuahang_id',[':Status'=>$status,':cuahang_id'=>2])
            ->andWhere(['idPro'=>$value])
            ->asArray()
            ->one();
            if ($data) {
                $ListDV[$key] = $data['proName'];
            }
        }
        // $data = Product::find()->alias('p')
        // ->select(['CONCAT(idPro, " / ", proName," /nsx: ",nsx.manuName, " (",cate.cateName,")") AS proName','p.id','cate.cateName'])

        // ->innerJoinWith('category cate',false)
        // ->innerJoinWith('nhasanxuat nsx',false)
        // ->andWhere('p.status =:Status AND p.cuahang_id =:cuahang_id',[':Status'=>$status,':cuahang_id'=>2])
        // ->asArray()
        // ->all();
        // return ArrayHelper::map($data,'id','proName');
        return $ListDV;
    }

    // Hàm cho vào thống kê xe
    public function ConcatAllDichvu($status = true)
    {
        $data = self::find()->alias('dv')
        ->select(['CONCAT(madichvu,"-", tendv) AS TTDV','dv.id']);
        // ->innerJoinWith('xeKhach moto',false);
        // ->innerJoinWith('xeKhach mt',false)
        return $data->asArray()->orderBy(['id'=>SORT_ASC,'tendv'=>SORT_ASC])->all();
    }

    public function ConcatAllProduct($status = true)
    {
        $data = self::find()->alias('dv')
        ->select(['CONCAT(madichvu,"-", tendv,"-",price) AS TTDV','dv.id'])
        ->innerJoinWith('xeKhach moto',false);
        // ->innerJoinWith('xeKhach mt',false)
        return $data->asArray()->orderBy(['id'=>SORT_ASC,'tendv'=>SORT_ASC])->all();
    }



    public function NhanbanPhutung($products)
    {
        foreach ($products as $value) {
            $oneService = self::findOne(['madichvu'=>$value['idPro']]);
            if ($oneService) {
                if ($oneService->tendv != $value['proName']) {
                    $oneService->tendv = $value['proName'];
                }
                if ($oneService->price != $value['price']) {
                    $oneService->price = $value['price'];
                }
                if ($oneService->price_sale != $value['price_sale']) {
                    $oneService->price_sale = $value['price_sale'];
                }
                if ($oneService->xe_sd != $value['bike_id']) {
                    $oneService->xe_sd = $value['bike_id'];
                }
                if ($value['guarantee'] != '') {
                    $oneService->guarantee = $value['guarantee'];
                }
                $oneService->save();
            } else {
                $newService = new KhachhangDichvuList();
                // dbg($value);

                $newService->madichvu = $value['idPro'];
                $newService->tendv = $value['proName'];
                $newService->price = $value['price'];
                if ($value['price_sale'] != '') {
                    $newService->price_sale = $value['price_sale'];
                }
                if ($value['price_sale'] != '') {
                    $newService->price_sale = $value['price_sale'];
                }
                if ($value['guarantee'] != '') {
                    $newService->guarantee = $value['guarantee'];
                }
                // $newService->xe_sd = $value['bike_id'];
                $newService->phutung = 1;
                $newService->status = 1;
                $newService->updated_at = time();
                $newService->user_add = getUser()->id;
                if($newService->save()===false){
                    pr($newService->errors);
                }

            }
            // pr(ArrayHelper::toArray($oneService));
            // pr($value);
            // dbg($oneService);
        }
        return true;
    }

    public function getDichvuByidPro($idPro)
    {
        return self::find()->where(['madichvu'=>$idPro])->one();
    }

}
