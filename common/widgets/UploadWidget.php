<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2016/8/26
 * Time: 16:05
 */

namespace common\widgets;


use yii\base\Widget;
use yii\helpers\Html;
use yii\web\JqueryAsset;

class UploadWidget extends Widget
{
    public $model;
    public $field = 'ad_img';
    public $maxFileNum = 1;
    public $maxSize = 1024;
    public $requestUrl = '';
    public $allowType = '["jpg", "png","gif"]';

    public function init()
    {
        parent::init();
        $view = $this->getView();
        $view->registerCssFile('@web/public/common/fileinput/css/fileinput.css');
        $view->registerJsFile('@web/public/common/fileinput/js/fileinput.js',['depends' => [JqueryAsset::className()]]);
        $view->registerJsFile('@web/public/common/fileinput/js/fileinput_locale_zh.js',['depends' => [JqueryAsset::className()]]);

        //请求地址
        if (!$this->requestUrl) {
            $this->requestUrl = \Yii::$app->urlManager->createUrl('/attr/uploads');
        }
    }

    public function run()
    {
        $this->view->registerJs(
        '$("document").ready(function(){
            $("#file-1").fileinput({
                uploadUrl: "#", // you must set a valid URL here else you will get an error
                allowedFileExtensions : '.$this->allowType.',
                overwriteInitial: false,
                maxFileSize: '.$this->maxSize.',
                maxFilesNum: '.$this->maxFileNum.',
                //allowedFileTypes: ["image", "video", "flash"],
                slugCallback: function(filename) {
                    return filename.replace("(", "_").replace("]", "_");
                }
            });
		})'
		);

        return Html::activeFileInput($this->model, $this->field, ['id' => 'file-1', 'multiple' => true]);
    }
}