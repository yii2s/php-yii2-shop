<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

class GoodController extends Controller
{
    public function actionAdd()
    {
        return $this->render('add');
    }

    public function actionList()
    {
        return $this->render('list');
    }
}