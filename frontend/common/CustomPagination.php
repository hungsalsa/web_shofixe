<?php
namespace app\common;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\base\Widget;
use yii\data\Pagination;

class CustomPagination extends \yii\widgets\LinkPager
{
    public $pager_layout = '{pageButtons} {pageSizeList} {goToPage}';
    
    public $sizeListHtmlOptions = [];
    protected $_page_size_param = 'per-page';
    
    private $pageSizeList = [5, 10, 20, 30];
    
    public function init()
    {
        parent::init();

        $currentPageSize = $this->pagination->getPageSize();
        $this->_page_size_param = $this->pagination->pageSizeParam;

        // Push current pageSize to $this->pageSizeList,
        // unique to avoid duplicating
        if ( !in_array($currentPageSize, $this->pageSizeList) ) {
            array_unshift($this->pageSizeList, $currentPageSize);
            $this->pageSizeList = array_unique($this->pageSizeList);

            // Sort
            sort($this->pageSizeList, SORT_NUMERIC);
        }
    }
    
    private function renderPageSizeList()
    {
        return Html::dropDownList($this->_page_size_param,
            $this->pagination->getPageSize(),
            array_combine($this->pageSizeList, $this->pageSizeList),
            $this->sizeListHtmlOptions
        );
    }
}
?>