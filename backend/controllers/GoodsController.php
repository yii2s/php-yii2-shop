<?php
namespace backend\controllers;

use yii\web\Controller;

class GoodsController extends Controller
{
    /**
     * 添加商品
     *
     * @return string
     */
    public function actionAdd()
    {
        return $this->render('add');
    }

    /**
     * 商品列表
     *
     * @return string
     */
    public function actionList()
    {
        return $this->render('list');
    }
    
}