<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use backend\modules\quantri\models\Employee;
use backend\modules\khachhang\models\KhXe;
/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhDichvu */

$this->title = 'Ngày: '.Yii::$app->formatter->asDate($model->day, 'dd-M-Y').' / '.$model->khachhang->name.' /xe : '.$model->xesua->bks;
$this->params['breadcrumbs'][] = ['label' => 'Kh Dichvus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="kh-dichvu-view">

    
<!-- if($model->user_add != getUser()->id && getUser()->manager != 1){ -->
    <p class="btn_save">
        <?php if (getUser()->manager == 1 || $model->status != 1 && $model->user_add == getUser()->id ): ?>
        <?= Html::a('In hóa đơn', ['print', 'id' => $model->iddv], ['class' => 'btn btn-danger button_luu','onclick'=>"window.print()"]) ?>
        <?= Html::a('Chi tiết', ['view', 'id' => $model->iddv], ['class' => 'btn btn-primary button_luu']) ?>
        <?= Html::a('Thêm mới khách hàng', ['/khachhang/khachhang/create'], ['class' => 'btn btn-success button_luu']) ?>
        <?php endif ?>
    </p>

<div class="inhoadon">
    <div class="header">
        <div class="left col-md-3 pull-left">
            <ul>
                <li><img src="<?= Yii::$app->homeUrl ?>images/anh-hdon.jpg"></li>
                <li>CS1 : 167 Kim Ngưu</li>
                <li>CS2 : 64 Trung Văn</li>
                <li>CS3 : 212 Định Công Thượng</li>
                <li>CS4 : Số 11 Ngõ 381 Nguyễn Khang</li>
                <li>CS5 : 173 Tam Trinh</li>
            </ul>
            
        </div>
        <div class="right col-md-7 pull-right">
            <h2 class="text-center"><strong>Phiếu thanh toán kiêm bảo hành</strong></h2>
            <table>
                <tr>
                    <td>Khách hàng: <span class="bold"><?= $model->khachhang->name ?></span></td>
                    <td>Địa chỉ: <span class="bold"><?= $model->khachhang->address ?></span></td>
                </tr>
                <tr>
                    <td>Xe: <span class="bold"><?= $model->xesua->xeKhach->bikeName; ?></span></td>
                    <td>BKS: <span class="bold"><?= $model->xesua->bks ?></span></td>
                </tr>
                <tr>
                    <td colspan="2">ĐT: <span class="bold">09834242</span></td>
                </tr>
            </table>
            <h3>Website: <span class="bold">https://mototech.com.vn</span></h3>
        </div>
        <div class="clearfix"></div>
    </div>
        <div class="phone">Điện thoại : 024.668.47600/ Hotline: 0984.557.937-0965.800.500/ Cứu hộ khẩn cấp: 0982.618.518</div>
    <div class="content_main">
        <table>
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th width="32%">Sửa chữa bảo dưỡng</th>
                    <th width="5%">Số lượng</th>
                    <th width="7%">Giá</th>
                    <th width="5%">CK</th>
                    <th width="10%">Thành tiền</th>
                    <th width="9%">BH</th>
                    <th>Tồn tại của xe</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($chitietDichvu as $key => $value): ?>
                <tr>
                    <td class="text-center"><?= $key+1 ?></td>
                    <td><?= (isset($value->danhsachdv->tendv)) ? $value->danhsachdv->tendv :''.' '.$value->suffixes ?></td>
                    <td class="text-center"><?= $value->quantity ?></td>
                    <td class="text-right"><?= Yii::$app->formatter->asDecimal($value->price*1000,0) ?></td>
                    <td class="text-center"><?= $value->quantity ?>%</td>
                    <td class="text-right"><?= Yii::$app->formatter->asDecimal($value->quantity*$value->price*1000,0) ?></td>
                    <td class="text-center"><?= ($value->danhsachdv->guarantee !='')? sprintf("%02d".' tháng', $value->danhsachdv->guarantee):'(không)'?></td>
                    <?php if ($key==0): ?>
                    <td rowspan="<?= count($chitietDichvu) ?>"><?= $model->tontai ?></td>
                    <?php endif ?>
                </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-center">Tổng tiền :</th>
                    <th colspan="3" class="text-right p-3"><strong><?= Yii::$app->formatter->asDecimal($model->total_money*1000,0) ?></strong></th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <th colspan="8" style="padding-left: 15px">
                        <strong><i>Bằng chữ : <?= $tienchu ?> đồng</i></strong>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
    <br>
    <div class="main_footer" style="padding: 0 15px">
        <div class="pull-left col-md-3 col-md-offset-1">
            <strong class="text-center">Kế toán</strong>
        </div>
        <div class="pull-right col-md-3 col-md-offset-1">
            <h5 class="text-center"><strong>Hà Nội, ngày <?= Yii::$app->formatter->asDate($model->day, 'd/M/Y');?></strong></h5>
            <h5 class="text-center"><strong>TM Trung tâm</strong></h5>
            <br><br><br><br>
            <h4 class="text-center"><strong><?= getUser()->fullname ?></strong></h4>
        </div>
        <br><br><br><br><br><br><br><br><br>
    </div>
</div>
</div>
<?php 
$this->registerCssFile("@web/css/hoadon.css");
$this->registerCss("
        
        @media print {
            .left-sidebar,.right-side-toggle,p.btn_save,footer.footer{
                display: none;
            }
            .inhoadon {
                background-color: white;
                height: 100%;
                width: 100%;
                padding:0;
                background: url(\"../images/chu-mototech.png\") no-repeat center center;
            }
            .header{
                padding-top:0px
                margin-top:0px
            }
            .content_main td,.content_main th{
                line-height: 24px;
                height: 24px;
            }
        }
");
?>
