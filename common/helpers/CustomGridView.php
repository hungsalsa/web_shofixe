<?php

namespace common\helpers;


use kartik\grid\GridView;
use Yii;
use yii\helpers\ArrayHelper;

class CustomGridView extends GridView
{

        /**
         * Initialize grid export
         */
        protected function initExport()
        {
            if ($this->export === FALSE) {
                return;
            }
            $this->exportConversions = ArrayHelper::merge([
                ['from' => self::ICON_ACTIVE, 'to' => Yii::t('kvgrid', 'Active')],
                ['from' => self::ICON_INACTIVE, 'to' => Yii::t('kvgrid', 'Inactive')]
            ], $this->exportConversions);

            $this->export = ArrayHelper::merge([
                'label'       => '',
                'icon'        => 'export',
                'messages'    => [
                    'allowPopups'      => Yii::t('kvgrid', 'Disable any popup blockers in your browser to ensure proper download.'),
                    'confirmDownload'  => Yii::t('kvgrid', 'Ok to proceed?'),
                    'downloadProgress' => Yii::t('kvgrid', 'Generating the export file. Please wait...'),
                    'downloadComplete' => Yii::t('kvgrid', 'Request submitted! You may safely close this dialog after saving your downloaded file.'),
                ],
                'options'     => ['class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Export')],
                'menuOptions' => ['class' => 'dropdown-menu dropdown-menu-right '],
            ], $this->export);
            if (!isset($this->export['header'])) {
                $this->export['header'] = '<li role="presentation" class="dropdown-header">' . Yii::t('kvgrid', 'Export Page Data') . '</li>';
            }
            if (!isset($this->export['headerAll'])) {
                $this->export['headerAll'] = '<li role="presentation" class="dropdown-header">' . Yii::t('kvgrid', 'Export All Data') . '</li>';
            }
            if (!isset($this->export['fontAwesome'])) {
                $this->export['fontAwesome'] = FALSE;
            }
            $title = empty($this->caption) ? Yii::t('kvgrid', 'Grid Export') : $this->caption;
            $pdfHeader = [
                'L' => [
                    'content'   => Yii::t('kvgrid', 'Yii2 Grid Export (PDF)'),
                    'font-size' => 8,
                    'color'     => '#333333'
                ],
                'C' => [
                    'content'   => $title,
                    'font-size' => 16,
                    'color'     => '#333333'
                ],
                'R' => [
                    'content'   => Yii::t('kvgrid', 'Generated') . ': ' . date("D, d-M-Y g:i a T"),
                    'font-size' => 8,
                    'color'     => '#333333'
                ]
            ];
            $pdfFooter = [
                'L'    => [
                    'content'    => Yii::t('kvgrid', "© Krajee Yii2 Extensions"),
                    'font-size'  => 8,
                    'font-style' => 'B',
                    'color'      => '#999999'
                ],
                'R'    => [
                    'content'     => '[ {PAGENO} ]',
                    'font-size'   => 10,
                    'font-style'  => 'B',
                    'font-family' => 'serif',
                    'color'       => '#333333'
                ],
                'line' => TRUE,
            ];
            $isFa = $this->export['fontAwesome'];
            $defaultExportConfig = [
                self::HTML  => [
                    'label'           => Yii::t('kvgrid', 'HTML'),
                    'icon'            => $isFa ? 'file-text' : 'floppy-saved',
                    'iconOptions'     => ['class' => 'text-info'],
                    'showHeader'      => TRUE,
                    'showPageSummary' => TRUE,
                    'showFooter'      => TRUE,
                    'showCaption'     => TRUE,
                    'filename'        => Yii::t('kvgrid', 'grid-export'),
                    'alertMsg'        => Yii::t('kvgrid', 'The HTML export file will be generated for download.'),
                    'options'         => ['title' => Yii::t('kvgrid', 'Hyper Text Markup Language')],
                    'mime'            => 'text/html',
                    'config'          => [
                        'cssFile' => 'http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css'
                    ]
                ],
                self::CSV   => [
                    'label'           => Yii::t('kvgrid', 'CSV'),
                    'icon'            => $isFa ? 'file-code-o' : 'floppy-open',
                    'iconOptions'     => ['class' => 'text-primary'],
                    'showHeader'      => TRUE,
                    'showPageSummary' => TRUE,
                    'showFooter'      => TRUE,
                    'showCaption'     => TRUE,
                    'filename'        => Yii::t('kvgrid', 'grid-export'),
                    'alertMsg'        => Yii::t('kvgrid', 'The CSV export file will be generated for download.'),
                    'options'         => ['title' => Yii::t('kvgrid', 'Comma Separated Values')],
                    'mime'            => 'application/csv',
                    'config'          => [
                        'colDelimiter' => ",",
                        'rowDelimiter' => "\r\n",
                    ]
                ],
                self::TEXT  => [
                    'label'           => Yii::t('kvgrid', 'Text'),
                    'icon'            => $isFa ? 'file-text-o' : 'floppy-save',
                    'iconOptions'     => ['class' => 'text-muted'],
                    'showHeader'      => TRUE,
                    'showPageSummary' => TRUE,
                    'showFooter'      => TRUE,
                    'showCaption'     => TRUE,
                    'filename'        => Yii::t('kvgrid', 'grid-export'),
                    'alertMsg'        => Yii::t('kvgrid', 'The TEXT export file will be generated for download.'),
                    'options'         => ['title' => Yii::t('kvgrid', 'Tab Delimited Text')],
                    'mime'            => 'text/plain',
                    'config'          => [
                        'colDelimiter' => "\t",
                        'rowDelimiter' => "\r\n",
                    ]
                ],
                self::EXCEL => [
                    'label'           => Yii::t('kvgrid', 'Excel'),
                    'icon'            => $isFa ? 'file-excel-o' : 'floppy-remove',
                    'iconOptions'     => ['class' => 'text-success'],
                    'showHeader'      => TRUE,
                    'showPageSummary' => TRUE,
                    'showFooter'      => TRUE,
                    'showCaption'     => TRUE,
                    'filename'        => Yii::t('kvgrid', 'grid-export'),
                    'alertMsg'        => Yii::t('kvgrid', 'The EXCEL export file will be generated for download.'),
                    'options'         => ['title' => Yii::t('kvgrid', 'Microsoft Excel 95+')],
                    'mime'            => 'application/vnd.ms-excel',
                    'config'          => [
                        'worksheet' => Yii::t('kvgrid', 'ExportWorksheet'),
                        'cssFile'   => ''
                    ]
                ],
                self::PDF   => [
                    'label'           => Yii::t('kvgrid', 'PDF'),
                    'icon'            => $isFa ? 'file-pdf-o' : 'floppy-disk',
                    'iconOptions'     => ['class' => 'text-danger'],
                    'showHeader'      => TRUE,
                    'showPageSummary' => TRUE,
                    'showFooter'      => TRUE,
                    'showCaption'     => TRUE,
                    'filename'        => Yii::t('kvgrid', 'grid-export'),
                    'alertMsg'        => Yii::t('kvgrid', 'The PDF export file will be generated for download.'),
                    'options'         => ['title' => Yii::t('kvgrid', 'Portable Document Format')],
                    'mime'            => 'application/pdf',
                    'config'          => [
                        'mode'          => 'c',
                        'format'        => 'A4-L',
                        'destination'   => 'D',
                        'marginTop'     => 20,
                        'marginBottom'  => 20,
                        'cssInline'     => '.kv-wrap{padding:20px;}' .
                        '.kv-align-center{text-align:center;}' .
                        '.kv-align-left{text-align:left;}' .
                        '.kv-align-right{text-align:right;}' .
                        '.kv-align-top{vertical-align:top!important;}' .
                        '.kv-align-bottom{vertical-align:bottom!important;}' .
                        '.kv-align-middle{vertical-align:middle!important;}' .
                        '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
                        '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
                        '.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',
                        'methods'       => [
                            'SetHeader' => [
                                ['odd' => $pdfHeader, 'even' => $pdfHeader]
                            ],
                            'SetFooter' => [
                                ['odd' => $pdfFooter, 'even' => $pdfFooter]
                            ],
                        ],
                        'options'       => [
                            'title'    => $title,
                            'subject'  => Yii::t('kvgrid', 'PDF export generated by kartik-v/yii2-grid extension'),
                            'keywords' => Yii::t('kvgrid', 'krajee, grid, export, yii2-grid, pdf')
                        ],
                        'contentBefore' => '',
                        'contentAfter'  => ''
                    ]
                ],
                self::JSON  => [
                    'label'           => Yii::t('kvgrid', 'JSON'),
                    'icon'            => $isFa ? 'file-code-o' : 'floppy-open',
                    'iconOptions'     => ['class' => 'text-warning'],
                    'showHeader'      => TRUE,
                    'showPageSummary' => TRUE,
                    'showFooter'      => TRUE,
                    'showCaption'     => TRUE,
                    'filename'        => Yii::t('kvgrid', 'grid-export'),
                    'alertMsg'        => Yii::t('kvgrid', 'The JSON export file will be generated for download.'),
                    'options'         => ['title' => Yii::t('kvgrid', 'JavaScript Object Notation')],
                    'mime'            => 'application/json',
                    'config'          => [
                        'colHeads'     => [],
                        'slugColHeads' => FALSE,
                        'jsonReplacer' => NULL,
                        'indentSpace'  => 4
                    ]
                ],
            ];
            $this->exportConfig = self::parseExportConfig($this->exportConfig, $defaultExportConfig);
        }


        /**
         * @inheritdoc
         * @param $exportConfig
         * @param $defaultExportConfig
         * @return array
         */
        protected static function parseExportConfig($exportConfig, $defaultExportConfig)
        {
            $config = $exportConfig;
            if (is_array($exportConfig) && !empty($exportConfig)) {
                foreach ($exportConfig as $format => $setting) {
                    $setup = is_array($exportConfig[$format]) ? $exportConfig[$format] : [];
                    $exportConfig[$format] = empty($setup) ? $defaultExportConfig[$format] :
                    array_merge($defaultExportConfig[$format], $setup);
                }
                $config = $exportConfig;
            }
            else {
                $config = $defaultExportConfig;
            }
            foreach ($config as $format => $setting) {
                $config[$format]['options']['data-pjax'] = FALSE;
            }

            return $config;
        }


    }