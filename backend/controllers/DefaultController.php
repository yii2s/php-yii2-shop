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
     * @brief ºóÌ¨Ê×Ò³
     * @return string
     * @author wuzhc
     * @since 2016-07-25
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionWelcome()
    {
        return $this->renderPartial('welcome');
    }



}