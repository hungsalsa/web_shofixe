<?php
use yii\helpers\Html;
$this->title = 'Quản lý của MOTOTECH';
use backend\modules\sanpham\models\Product;

$product = new Product();
?>      
<div class="row">
  <div class="col-md-12 align-self-center">
    <h3 class="text-themecolor text-center">Thống kê ngày <?= date("d/m/Y") ?></h3>
  </div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Info box -->
<!-- ============================================================== -->
  <h5 class="card-title col-md-12 text-center">Khách hàng đã thêm</h5>
  <!-- Column -->
  <?php $total = array_sum($dataCount['khachhang']['today']);
  if ( $total==0 ) {
    $total = 1;
  }
   
  ?>
  <div class="white-box">
    <div class="row row-in">
      <?php $i=1;
      foreach ($dataCount['khachhang']['today'] as $key => $value): ?>
        <div class="col-lg-3 col-sm-6 row-in-br">
          <ul class="col-in">
            <li>
              <?php if (isset($imageUser[$key])): ?>
                <?= Html::img($imageUser[$key], ['alt' => "$value",'style'=>'width: 75px; height: 75px; border-radius: 50%;']) ?>
              <?php else: ?>
                <span class="circle circle-md bg-danger"><i class="ti-clipboard"></i></span>
              <?php endif ?>
            </li>
            <li class="col-last">
              <h3 class="counter text-right m-t-15"><?= $value ?></h3>
            </li>
            <li class="col-middle">
              <h6><?= $dataCount['user'][$key] ?></h6>
              <div class="progress">
                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?=  ($value/$total)*100 ?>%">
                  <span class="sr-only">40% Complete (success)</span>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <?php if ($i%4==0): ?>
          <div class="clearfix"></div><hr>
        <?php endif ?>
        
        <?php $i++; endforeach ?>
        <!-- Column -->
      </div>
    </div>
  </div>
  <div class="row">
    <h5 class="card-title col-md-12 text-center">Phiếu dịch vụ đã thêm</h5>
    <!-- Column -->
    <?php $total = array_sum($dataCount['khdichvu']['today']);
        if ( $total==0 ) {
          $total = 1;
        }?>
        <div class="white-box">
          <div class="row row-in">
            <?php $count=1; foreach ($dataCount['khdichvu']['today'] as $key => $value): ?>

            <div class="col-lg-3 col-sm-6 row-in-br">
              <ul class="col-in">
                <li>
                  <?php if (isset($imageUser[$key])): ?>
                      <?= Html::img($imageUser[$key], ['alt' => "$value",'style'=>'width: 75px; height: 75px; border-radius: 50%;']) ?>
                    <?php else: ?>
                      <span class="circle circle-md bg-danger"><i class="ti-clipboard"></i></span>
                    <?php endif ?>
                </li>
                <li class="col-last">
                  <h3 class="counter text-right m-t-15"><?= $value ?></h3>
                </li>
                <li class="col-middle">
                  <h6><?= $dataCount['user'][$key] ?></h6>
                  <div class="progress">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?=  ($value/$total)*100 ?>%">
                      <span class="sr-only">40% Complete (success)</span>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <?php if ($count%4==0): ?>
              <div class="clearfix"></div><hr>
            <?php endif;$count++; endforeach ?>
          </div>
        </div>
  </div>
  <!-- Column -->
  <div class="row">
    <div class="col-md-12 align-self-center">
      <h3 class="text-themecolor text-center">Thống kê ngày <?= date('d/m/Y', strtotime('-1 day', strtotime(date("Y/m/d")))) ?></h3>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Info box -->
    <!-- ============================================================== -->

    <h5 class="card-title col-md-12 text-center">Khách hàng</h5>
    <!-- Column -->
    <?php $total = array_sum($dataCount['khachhang']['yesterday']);
    if ($total==0) {
      $total = 1;
    }?>
    <div class="white-box">
      <div class="row row-in">
        <?php $count=1; foreach ($dataCount['khachhang']['yesterday'] as $key => $value): ?>
        <div class="col-lg-3 col-sm-6 row-in-br">
          <ul class="col-in">
            <li>
              <?php if (isset($imageUser[$key])): ?>
                <?= Html::img($imageUser[$key], ['alt' => "$value",'style'=>'width: 75px; height: 75px; border-radius: 50%;']) ?>
              <?php else: ?>
                  <span class="circle circle-md bg-danger"><i class="ti-clipboard"></i></span>
              <?php endif ?>
            </li>
            <li class="col-last">
              <h3 class="counter text-right m-t-15"><?= $value ?></h3>
            </li>
            <li class="col-middle">
              <h6><?= $dataCount['user'][$key] ?></h6>
              <div class="progress">
                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?=  ($value/$total)*100 ?>%">
                  <span class="sr-only"><?=  ($value/$total)*100 ?>% Complete (success)</span>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <?php if ($count%4==0): ?>
          <div class="clearfix"></div><hr>
        <?php endif;$count++;endforeach ?>
      </div>
    </div>
    <!-- Column -->
  </div>
  <div class="row">
    <h5 class="card-title col-md-12 text-center">Phiếu dịch vụ đã thêm</h5>
    <!-- Dịch vụ ngày hôm qua -->
    <?php $total = array_sum($dataCount['khdichvu']['yesterday']);
    if ($total==0) {
      $total = 1;
    }?>
    <div class="white-box">
      <div class="row row-in">
        <?php $count=1; foreach ($dataCount['khdichvu']['yesterday'] as $key => $value): ?>
        <div class="col-lg-3 col-sm-6 row-in-br">
          <ul class="col-in">
            <li>
              <?php if (isset($imageUser[$key])): ?>
                <?= Html::img($imageUser[$key], ['alt' => "$value",'style'=>'width: 75px; height: 75px; border-radius: 50%;']) ?>
              <?php else: ?>
                  <span class="circle circle-md bg-danger"><i class="ti-clipboard"></i></span>
              <?php endif ?>
            </li>
            <li class="col-last">
              <h3 class="counter text-right m-t-15"><?= $value ?></h3>
            </li>
            <li class="col-middle">
              <h6><?= $dataCount['user'][$key] ?></h6>
              <div class="progress">
                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?= $value ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=  ($value/$total)*100 ?>%">
                  <span class="sr-only"><?=  ($value/$total)*100 ?>% Complete (success)</span>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <?php if ($count%4==0): ?>
          <div class="clearfix"></div><hr>
        <?php endif;$count++;endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Column -->
  <div class="row">
    <div class="col-md-12 align-self-center">
      <h3 class="text-themecolor text-center">Thống kê tổng</h3>
    </div>
    <h5 class="card-title col-md-12 text-center">Khách hàng</h5>
    <!-- Column -->
    <?php $total = array_sum($dataCount['khachhang']);
        if ($total==0) {
          $total = 1;
        }?>
        <div class="white-box">
          <div class="row row-in">
            <?php $count =1; foreach ($dataCount['khachhang'] as $key => $value): ?>
            <?php if (!array_key_exists($key, $dataCount['user'])){continue;} ?>
            <div class="col-lg-3 col-sm-6 row-in-br">
              <ul class="col-in">
                <li>
                  <?php if (isset($imageUser[$key])): ?>
                    <?= Html::img($imageUser[$key], ['alt' => "$value",'style'=>'width: 75px; height: 75px; border-radius: 50%;']) ?>
                  <?php else: ?>
                      <span class="circle circle-md bg-danger"><i class="ti-clipboard"></i></span>
                  <?php endif ?>
                </li>
                <li class="col-last">
                  <h3 class="counter text-right m-t-15"><?= $value ?></h3>
                </li>
                <li class="col-middle">
                  <h6><?= $dataCount['user'][$key] ?></h6>
                  <div class="progress">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?= $value ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=  ($value/$total)*100 ?>%">
                      <span class="sr-only"><?=  ($value/$total)*100 ?>% Complete (success)</span>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <?php if ($count%4==0): ?>
              <div class="clearfix"></div><hr>
            <?php endif;$count++;endforeach ?>
        </div>
      </div>
  </div>
  <div class="row">
    <h5 class="card-title col-md-12 text-center">Phiếu dịch vụ đã thêm</h5>
    <!-- Column -->
    <?php $total = array_sum($dataCount['khdichvu']);
        if ($total==0) {
          $total = 1;
        }?>
        <div class="white-box">
          <div class="row row-in">
            <?php $count=1; foreach ($dataCount['khdichvu'] as $key => $value): ?>
            <?php if (!array_key_exists($key, $dataCount['user'])){continue;} ?>
            <div class="col-lg-3 col-sm-6 row-in-br">
              <ul class="col-in">
                <li>
                  <?php if (isset($imageUser[$key])): ?>
                    <?= Html::img($imageUser[$key], ['alt' => "$value",'style'=>'width: 75px; height: 75px; border-radius: 50%;']) ?>
                  <?php else: ?>
                      <span class="circle circle-md bg-danger"><i class="ti-clipboard"></i></span>
                  <?php endif ?>
                </li>
                <li class="col-last">
                  <h3 class="counter text-right m-t-15"><?= $value ?></h3>
                </li>
                <li class="col-middle">
                  <h6><?= $dataCount['user'][$key] ?></h6>
                  <div class="progress">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?= $value ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=  ($value/$total)*100 ?>%">
                      <span class="sr-only"><?=  ($value/$total)*100 ?>% Complete (success)</span>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <?php if ($count%4==0): ?>
              <div class="clearfix"></div><hr>
            <?php endif;$count++; endforeach ?>
        </div>
      </div>
  </div>

  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Biểu đồ</h4> </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- row -->
    
    <!-- /.row -->
    <!-- .row -->
    <div class="row">
      <div class="col-md-6 col-lg-6 col-xs-12">
        <div class="white-box">
          <h3 class="box-title">Tỷ lệ phiều dịch vụ</h3>
          <div class="flot-chart">
            <div class="flot-chart-content" id="flot-pie-chart"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
               
<script type="text/javascript">
  var so_0 = <?= $dataCount['khdichvu'][1] ?>;
  var _label_0 = "<?= $dataCount['user'][1] ?>";

  var so_1 = <?= $dataCount['khdichvu'][2] ?>;
  var _label_1 = "<?= $dataCount['user'][2] ?>";
  
  var so_2 = <?= $dataCount['khdichvu'][7] ?>;
  var _label_2 = "<?= $dataCount['user'][7] ?>";
  
  var so_3 = <?= $dataCount['khdichvu'][8] ?>;
  var _label_3 = "<?= $dataCount['user'][8] ?>";
  
  var so_4 = <?= $dataCount['khdichvu'][9] ?>;
  var _label_4 = "<?= $dataCount['user'][9] ?>";
  
  var so_5 = <?= $dataCount['khdichvu'][10] ?>;
  var _label_5 = "<?= $dataCount['user'][10] ?>";
  
  var so_6 = <?= $dataCount['khdichvu'][12] ?>;
  var _label_6 = "<?= $dataCount['user'][12] ?>";
</script>
<?php
// $this->registerCss(".page-titles{border-top: 11px solid red; } .page-titles:first-child{border-top: none; }");

$this->registerJs('
$( document ).ready(function() {

    //Flot Pie Chart
  $(function() {

      var data = [
      {
          label: _label_0,
          data: so_0,
          color: "#f44336",
          
      },{
          label: _label_1,
          data: so_1,
          color: "#4f5467",
          
      }, {
          label: _label_2,
          data: so_2,
          color: "#00c292",
      }, {
          label: _label_3,
          data: so_3,
          color:"#01c0c8",
      }, {
          label: _label_4,
          data: so_4,
          color:"#fb9678",
      }, {
          label: _label_5,
          data: so_5,
          color:"#0927fb",
      }, {
          label: _label_6,
          data: so_6,
          color:"#0927fb",
      }
      ];

      var plotObj = $.plot($("#flot-pie-chart"), data, {
          series: {
              pie: {
                  innerRadius: 0.2,
                  show: true
              }
          },
          grid: {
              hoverable: true
          },
          color: null,
          tooltip: true,
          tooltipOpts: {
              content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
              shifts: {
                  x: 20,
                  y: 0
              },
              defaultTheme: false
          }
      });

  });
      
  });
  ');

?>

