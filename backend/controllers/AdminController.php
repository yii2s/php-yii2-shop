<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\form\LoginForm;

class AdminController extends Controller
{

    public function actionIndex()
    {
        echo 'hello world';
    }

    /**
     * 管理员登录
     */
    public function actionLogin()
    {

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['main/index']);
        }
        return $this->renderPartial('login',[
            'model' => $model
        ]);
    }

    /**
     * 管理员退出
     *
     * @since 2016-02-29
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        $this->goHome();
    }

    /**
     * 添加管理员
     */
    public function actionAdd()
    {
        return $this->render('add');
    }

    /**
     * 删除管理员
     */
    public function actionDelete()
    {
        return $this->render('delete');
    }

    /**
     * 角色管理
     *
     */
    public function actionRole()
    {
        return $this->render('role');
    }

    /**
     * 添加角色
     */
    public function actionAddRole()
    {
        return $this->render('addRole');
    }

    /**
     * 权限管理
     */
    public function actionPermission()
    {
        return $this->render('permission');
    }

    /**
     * 管理员列表
     */
    public function actionList()
    {
        return $this->render('list');
    }
}