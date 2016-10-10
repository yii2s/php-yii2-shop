<?php

require(__DIR__ . '/vendor/yiisoft/yii2/BaseYii.php');

/**
 * Yii bootstrap file.
 * Used for enhanced IDE code autocompletion.
 */
class Yii extends \yii\BaseYii
{
    /**
     * @var WebApplication the application instance
     */
    public static $app;
}


/**
 * Class WebApplication
 * Include only Web application related components here
 *
 * @property \common\components\CMongo $mongo The mongo component
 * @property \common\components\CMember $member The member component
 * @property \common\components\CSphinx $sphinx The sphinx component
 */
class WebApplication extends \yii\web\Application
{

}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = require(__DIR__ . '/vendor/yiisoft/yii2/classes.php');
Yii::$container = new yii\di\Container();
