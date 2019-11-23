<?php
namespace frontend\controllers;

use Yii;
use \mrssoft\sitemap\Sitemap;
// use common\models\Slug;
// use function Symfony\Component\Debug\header;
// use frontend\modules\quantri\models\Categories;
use yii\helpers\Url;
class SitemapController extends \mrssoft\sitemap\SitemapController
{

   /**
     * @var int Cache duration, set null to disabled
     */
    protected $cacheDuration = 43200; // default 12 hour

    /**
     * @var string Cache filename
     */
    protected $cacheFilename = 'sitemap.xml';

    public function models()
    {
        return [
            [
                'class' => \frontend\modules\quantri\models\Categories::className(),
                'change' => Sitemap::MONTHLY,
                'priority' => 0.8
            ]
        ];
    }

    public function urls()
    {
        return [
            [
                'url' => 'about/index',
                'change' => Sitemap::MONTHLY,
                'priority' => 0.8
            ]
        ];
    }
}