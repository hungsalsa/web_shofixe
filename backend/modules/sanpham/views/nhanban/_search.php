<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

// dbg($dataCuahang);
?>
<br>
<h1 class="btn btn-info text-center col-md-12">Nhân bản phụ tùng từ 173 Tam Trinh sang cửa hàng khác</h1>
<br>
<br>
<div class="chingay-search col-md-12">

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
