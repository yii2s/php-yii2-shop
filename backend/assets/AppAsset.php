<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/backend/css/H-ui.min.css',
        'public/backend/css/H-ui.admin.css',
        //'public/backend/skin/default/skin.css',
        'public/backend/lib/Hui-iconfont/1.0.1/iconfont.css',
        'public/backend/css/style.css',
    ];
    public $js = [
        //'public/backend/lib/jquery/1.9.1/jquery.min.js',
        //'public/backend/lib/layer/1.9.3/layer.js',
        //'public/backend/js/H-ui.js',
        //'public/backend/js/H-ui.admin.js',
    ];
    public $jsOptions = [
        //'position' => \yii\web\View::POS_BEGIN
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];

}
