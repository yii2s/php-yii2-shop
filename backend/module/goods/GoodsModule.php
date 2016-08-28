<?php

namespace backend\module\goods;


use Yii;
use yii\helpers\Inflector;

/**
 * goods module definition class
 */
class GoodsModule extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\module\goods\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * @var array
     */
    private $_normalizeMenus = null;

    /**
     * @var array
     * @see [[menus]]
     */
    private $_coreItems = [
        'default/index' => '商品列表',
        'default/create' => '新建商品',
        'category/index' => '分类列表',
        'category/create' => '新建分类',
    ];

    private $_menus = [];

    /**
     * @param $menus
     */
    public function setMenus($menus)
    {
        if (is_array($menus)) {
            $this->_menus = array_merge($menus, $this->_menus);
        }
    }

    /**
     * Get avalible menu.
     * @return array
     */
    public function getMenus()
    {
        if ($this->_normalizeMenus === null) {
            $mid = '/' . $this->getUniqueId() . '/';
            // resolve core menus
            $this->_normalizeMenus = [];

            foreach ($this->_coreItems as $id => $lable) {
                if (!isset($conditions[$id]) || $conditions[$id]) {
                    $this->_normalizeMenus[$id] = ['label' =>$lable, 'url' => [$mid . $id]];
                }
            }
            //print_r('sdf');exit;
            foreach (array_keys($this->controllerMap) as $id) {
                $this->_normalizeMenus[$id] = ['label' => Inflector::humanize($id), 'url' => [$mid . $id]];
            }

            // user configure menus
            foreach ($this->_menus as $id => $value) {
                if (empty($value)) {
                    unset($this->_normalizeMenus[$id]);
                    continue;
                }
                if (is_string($value)) {
                    $value = ['label' => $value];
                }
                $this->_normalizeMenus[$id] = isset($this->_normalizeMenus[$id]) ? array_merge($this->_normalizeMenus[$id], $value)
                    : $value;
                if (!isset($this->_normalizeMenus[$id]['url'])) {
                    $this->_normalizeMenus[$id]['url'] = [$mid . $id];
                }
            }
        }
        //print_r($this->_normalizeMenus);exit;
        return $this->_normalizeMenus;
    }
}
