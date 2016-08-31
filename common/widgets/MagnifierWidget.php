<?php
/**
 * Magnifier
 */

namespace common\widgets;


use yii\base\Widget;
use yii\web\JqueryAsset;

class MagnifierWidget extends Widget
{
    public $imgUrls;

    public function init()
    {
        parent::init();
        $view = $this->getView();
        $view->registerCssFile('@web/public/common/magnifier/css/smoothproducts.css');
        $view->registerJsFile('@web/public/common/magnifier/js/smoothproducts.min.js', ['depends' => [JqueryAsset::className()]]);
    }

    public function run()
    {
        $this->view->registerJs(
            '$(window).load(function() {
                $(".sp-wrap").smoothproducts();
            });'
        );
        return $this->render('magnifier', ['imgUrls' => $this->imgUrls]);
    }

}