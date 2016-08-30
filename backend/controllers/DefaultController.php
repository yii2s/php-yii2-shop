<?php
namespace backend\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class DefaultController extends Controller
{

    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index','left','zhu','top','footer'],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','index','left','zhu','top','footer'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }*/

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @brief 后台
     * @return string
     * @since
     * @since 2016-07-25
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @brief 欢饮页
     * @return string
     * @since 2016-07-31
     */
    public function actionWelcome()
    {
        return $this->render('welcome');
    }

    /**
     * @brief 后台首页
     * @return string
     * @since 2016-07-31
     */
    public function actionMain()
    {
        return $this->render('main');
    }


}