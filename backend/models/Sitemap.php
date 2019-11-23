<?php

namespace backend\models;

use Yii;
use backend\modules\quanlytin\models\Categories;
use backend\modules\quanlytin\models\News;
use yii\helpers\Url;
/**

 */
class Sitemap extends \yii\db\ActiveRecord
{
    public function actionCreateSitemap()
    {

        $begin = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    ';
        $end = '</urlset>';

        $string = '    <url>
            <loc>'.Yii::$app->request->hostInfo.'</loc>
            <lastmod>2005-01-01</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
';

        $dataCate = Categories::find()->select(['slug'])->where(['status'=>true])->all();
        foreach ($dataCate as $category) {
        $string .= '        <url>
            <loc>'.Yii::$app->request->hostInfo.'/'.$category->slug.'-c.html</loc>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
';
        }

        $dataNews = News::find()->select(['link'])->where(['status'=>true])->all();
        foreach ($dataNews as $new) {
        $string .= '        <url>
            <loc>'.Yii::$app->request->hostInfo.'/'.$new->link.'.html</loc>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
';
        }
        $siteMap = $begin.$string.$end;
        $fp = fopen(\Yii::getAlias('@frontend')."/web/sitemap.xml","w");

        fwrite($fp, $siteMap);

        fclose($fp);
    }
}
