<?php

namespace common\widgets;


use yii\base\Widget;
use yii\web\JqueryAsset;

class WangEditorWidget extends Widget
{

    public function init()
    {
        parent::init();
        $view = $this->getView();
        $view->registerCssFile('@web/public/common/wangEditor/css/wangEditor.min.css');
        //$view->registerJsFile('@web/public/common/wangEditor/js/lib/jquery-1.10.2.min.js');
        $view->registerJsFile('@web/public/common/wangEditor/js/wangEditor.min.js', ['depends' => [JqueryAsset::className()]]);
    }

    public function run()
    {
        $this->view->registerJs(
            '$("document").ready(function(){
                var editor = new wangEditor("editor-trigger");
                editor.create();
            });'
        );

        return $this->render('wangEditor');
    }

}