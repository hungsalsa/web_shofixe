<?php
use yii\helpers\Html;

$this->title = 'Nhân bản phụ tùng từ 173 Tam Trinh sang cửa hàng khác';
$this->params['breadcrumbs'][] = $this->title;
?>

<br>
<div class="btn btn-info text-center col-md-12">Nhân bản phụ tùng từ 173 Tam Trinh sang cửa hàng khác</div>
<br>
<div class="col-md-12 text-center" style="margin-top: 20px">

    <?php foreach ($dataCuahang as $key => $value): ?>
        
    <?= Html::a('173 Tam trinh => '.$value, ['/sanpham/nhanban'], [
        'class' => 'btn btn-success button_luu',
        'data' => [
            'confirm' => 'Bạn có chắc muốn nhân bản dịch vụ từ phụ tùng',
            'method' => 'post',
            'params' => ['cuahang_id' => $key],
        ],
    ]) ?>
    <?php endforeach ?>

</div>