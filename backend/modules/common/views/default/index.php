<div class="common-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        <?php 
//7h 30m 02s 18-05-2016
 
$time = mktime(7,30,2,5,18,2016);
 
//$time là timestamp, sử dụng nó trong hàm date()
 
// echo date("Y-m-d H:i:s",$time),'<br>';


echo $date = date("d-m-Y 0:0:0"),'<br>';
$timestamp = strtotime($date);
echo $timestamp,'<br>';
echo  date("d-m-Y H:i:s",$timestamp),'<br>';
// echo date("d-m-Y H:i:s"),'<br>';
 echo 'Cong them - 1h:= ';
 
echo  $timestamp-= 1*60*60,'<br>';
echo  $timestamp = strtotime(date("d-m-Y 0:0:0"))-1*60*60,'<br>';
echo $date = date("d-m-Y H:i:s",$timestamp),'<br>';
//công thêm 5 phút
 
$time = strtotime(date("d-m-Y 0:0:0"));
 
// echo '5 min after: ',date("Y-m-d H:i:s",$time),'<br>';
 
// và công thêm 1 ngày
 
echo ' 1 date after: ',date("Y-m-d H:i:s",($date+1*60*60*24));


         ?>
    </p>
</div>
