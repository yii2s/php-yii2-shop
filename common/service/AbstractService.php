<?php

namespace common\service;

use Exception;

class AbstractService{

	private static $_models = array ();

	public function __construct()
	{
		if (YII_DEBUG) {
			$createFromFactory =false;
			$trace = debug_backtrace ();
			foreach ($trace as $item ) {
				if($item['function'] == 'factory'){
					$createFromFactory = true;
					break;
				}
			}
			if (!$createFromFactory) {
				throw new Exception('��ش�factory����Service����,��Ҫֱ��');
				Yii::$app->end();
			}
		}

	}

	public static function factory($className = __CLASS__) {
		if (isset(self::$_models[$className])) {
			return self::$_models[$className];
		} else {
			$model = self::$_models [$className] = new $className ( null );
			return $model;
		}
	}
}