<?php
/*use yii\helpers\Html;
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset>
<?php foreach ($siteMap as $row):?>
<url>
<loc><?= Html::encode($row['loc'])?></loc>
<changepreq><?= Html::encode($row['frequency'])?></changepreq>
<priority><?= Html::encode($row['priority'])?></priority>
</url>
<?php endforeach;?>
</urlset>*/
// echo '<pre>';
// dbg($sitemap);
?>
<?php
header('Content-type: text/xml');
// Render without XmlEngine as we need the namespace in urlset
// Also use echo because <? short tags will explode if enabled

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

if ($sitemap) {
    foreach ($sitemap as $item) {
        echo '<url>';

        foreach ($item as $key => $value) {
            // echo "<$key><$value></$key>\n";
            echo htmlentities(sprintf('<%s>%s</%s>%s', $key, $value, $key,"\n"));
        }

        echo '</url>';
    }
}

echo '</urlset>';