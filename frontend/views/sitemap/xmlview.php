<?php
use yii\helpers\Html;
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset>
<?php foreach ($list as $row):?>
<url>
<loc><?= Html::encode($row['loc'])?></loc>
<changepreq><?= Html::encode($row['frequency'])?></changepreq>
<priority><?= Html::encode($row['priority'])?></priority>
</url>
<?php endforeach;?>
</urlset>