<?php
/**
 *
 * 上传成功之后将生成一个隐藏域用于存放文件地址
 * 如果页面使用表单模型，隐藏域名称由$attribute决定
 * 或者你可以直接指定隐藏域名称$hiddenField
 * 调用方式：
 * \common\widgets\UploadWidget::widget([
 *      'maxFileNum' => 1,
 *      'maxSize' => 1024,
 *      'multiple' => true,
 *      'requestUrl' => 'http://upload.php',
 *      'allowType' => '["jpg", "png","gif"]',
 * ]);
 *
 * @since 2016-08-26
 */

namespace common\widgets;


use yii\base\Widget;
use yii\helpers\Html;
use yii\web\JqueryAsset;


class UploadWidget extends Widget
{
    /** @var string 上传控件ID,用于区分同个页面多个上传控件 */
    public $id = 'file-1';

    /** @var string 隐藏域输入框name属性名 */
    public $hiddenField;

    /** @var int 最大上传文件数量 */
    public $maxFileCount = 1;

    /** @var int 最小上传文件数量 */
    public $minFileCount = 1;

    /** @var bool 是否允许同时上传多个 */
    public $multiple = false;

    /** @var int 最大上传文件大小 */
    public $maxSize = 1024;

    /** @var string 上传请求地址 */
    public $requestUrl = '';

    /** @var string 允许上传类型 */
    public $allowType = '["jpg", "png","gif"]';

    public $dropZoneEnabled = 1;

    /**
     * 初始化
     */
    public function init()
    {
        parent::init();
        $view = $this->getView();
        $view->registerCssFile('@web/public/common/fileinput/css/fileinput.css');
        $view->registerJsFile('@web/public/common/fileinput/js/fileinput.js',['depends' => [JqueryAsset::className()]]);
        $view->registerJsFile('@web/public/common/fileinput/js/fileinput_locale_zh.js',['depends' => [JqueryAsset::className()]]);

        $this->getRequestUrl();
        $this->getHiddenField();
    }

    /**
     * 上传文件请求地址
     */
    public function getRequestUrl()
    {
        if (!$this->requestUrl) {
            $this->requestUrl = \Yii::$app->urlManager->createUrl(['/attr/upload']);
        }
    }

    /**
     * 隐藏域名称
     */
    public function getHiddenField()
    {
        if (!$this->hiddenField) {
            $this->hiddenField = 'upload_file';
        }
    }

    public function run()
    {
        $this->view->registerJs(
        '$("document").ready(function(){
            $("#'.$this->id.'").fileinput({
                language: "zh",
                dropZoneEnabled:'.$this->dropZoneEnabled.',
                uploadUrl: "'.$this->requestUrl.'",
                allowedFileExtensions : '.$this->allowType.',
                overwriteInitial: false,
                maxFileSize: '.$this->maxSize.',
                minFileCount: '.$this->minFileCount.',
                maxFileCount: '.$this->maxFileCount.',
                //allowedFileTypes: ["image", "video", "flash"],
                slugCallback: function(filename) {
                    return filename.replace("(", "_").replace("]", "_");
                }
            }).on("fileuploaded", function(event, data, previewId, index) {
                if(data.response) {
                    var hiddenField = "<input class="+previewId+" name=\"'.$this->hiddenField.'\" type=\"hidden\">";
                    $("#'.$this->id.'").after(hiddenField);
                    $("."+previewId).val(data.response.url); //使用val()赋值，防止文件名出现空格引发bug
                }
            }).on("fileclear", function(event, data) {
                $("input[name=\"'.$this->hiddenField.'\"]").each(function(){
                    $(this).remove();
                });
            }).on("filesuccessremove", function(event, data) {
                var cap = $("#"+data).children().find(".file-footer-caption");
                var file_title = cap.attr("title");
                $("input[name=\"'.$this->hiddenField.'\"]").filter(function(index){
                    return this.value.indexOf(file_title) > -1;
                }).remove();
            });
		})'
		);

        return Html::FileInput('Filedata', null, ['id' => $this->id, 'multiple' => $this->multiple]);
    }
}