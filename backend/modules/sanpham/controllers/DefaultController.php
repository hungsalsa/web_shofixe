<?php
namespace backend\modules\sanpham\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use backend\modules\sanpham\models\Thongkesp;
use backend\modules\sanpham\models\Product;
use backend\modules\sanpham\models\ProductCate;
use backend\modules\common\models\SanphamThongke;
use backend\modules\common\models\SanphamThongkeSearch;
use backend\modules\common\models\ThongkeSearch;
use backend\modules\quantri\models\CuaHang;
use yii\filters\AccessControl;
/**
 * Default controller for the `sanpham` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
 // $cache = Yii::$app->cache->get('cache_app_sanpham_ton');
 // dbg($cache);
        $searchModel = new ThongkeSearch();
        if (getUser()->manager != 1) {
            $cuahang_id = json_decode(getUser()->cuahang_id);
        }else {
            $cuahang_id = [1,2,3,4];
        }
        if (count($cuahang_id) == 1) {
            $searchModel->cuahang_id = $cuahang_id[0];
        }
        $search['cuahang'] = $search['cuahang_query'] = ArrayHelper::map(CuaHang::findAll($cuahang_id),'id','name');

        $cate= new ProductCate();
        $search['category'] = $search['category_query'] = $cate->getCategoryParent();
        // $search['parent'] = ArrayHelper::map(ProductCate::findAll(['status'=>true,'parent_id'=>0]),'idCate','idCate');

        $model= new SanphamThongke();
        $model->getThongke($cuahang_id);
//         // Laays tất cả các id danh mục trong bảng tồn kho > 0 
//         $datacateton = $model->getAllcatefomProduct();
// dbg($search['parent']);

        // Lấy tất cả sản phẩm để ra search
        $dataProduct =  $model->getProduct([2]);
        $dataProductquery = array_keys($dataProduct);
        // dbg($dataProduct);
        if ($searchModel->load($post = Yii::$app->request->post()))
        {
            $cuahang = $post['ThongkeSearch']['cuahang_id'];
            $cate_id = $post['ThongkeSearch']['cate_id'];
            $proId = $post['ThongkeSearch']['proId'];

            if (!empty($cuahang)) {
                unset($search['cuahang_query']);
                foreach ($cuahang as $value) {
                    $search['cuahang_query'][$value] = $search['cuahang'][$value];
                }
            }
            if (!empty($cate_id)) 
            {
                unset($search['category_query']);
                $search['category_query'] = $this->getCategoryQuery($cate_id,$search['category']);
            }

            if (!empty($proId)) {
                $product = new Product();
                // pr($proId);
                $cate_id = $product->getAllCateId(array_keys($search['cuahang_query']),$proId);
                if (empty($cate_id)) {
                    unset($search['category_query']);
                }
                $category_query = $this->getCategoryQuery($cate_id,$search['category']);
                $search['category_query'] = array_intersect_assoc($search['category_query'],$category_query);
                
                $dataProductquery = $proId;
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProductquery' => $dataProductquery,
            'search' => $search,
            'dataProduct' => $dataProduct,
        ]);
    }

    private function getCategoryQuery($cate_id,$categoryArray)
    {
        $cate= new ProductCate();

        $query = [];
        foreach ($cate_id as  $value) 
        {
            $listCate = $cate->getAllIDCate($value);
            foreach ($listCate as $idchild) {
                if (isset($query) && array_key_exists($idchild, $query)) {
                    continue;
                }
                $query[$idchild] =  $categoryArray[$idchild];
            }
        }
        return $query;
    }
}
