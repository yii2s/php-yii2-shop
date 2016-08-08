<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

class GoodsController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionAdd()
    {
        if ($_POST) {
            print_r($_POST);exit;
        }
        return $this->render('add');
    }

    public function actionList()
    {
        return $this->render('list');
    }
}