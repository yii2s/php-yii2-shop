<?php
namespace frontend\controllers;

use common\models\Member;
use common\service\MemberService;
use frontend\form\LoginForm;
use frontend\form\ModifyPwdForm;
use frontend\form\SignupForm;
use Yii;
use yii\web\Response;
use yii\bootstrap\ActiveForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class MemberController extends Controller
{

    public $layout = 'main_member';

    /**
     * 会员中心
     * @return string|Response
     * @since 2016-02-27
     */
    public function actionIndex()
    {
        if (\Yii::$app->member->isGuest) {
            return $this->goHome();
        }

        return $this->render('index',[
            'member' => MemberService::factory()->detail(Yii::$app->member->id),
        ]);
    }

    /**
     * 会员登录
     *
     * @return string|Response
     * @since 2016-02-27
     */
    public function actionLogin()
    {
        $this->layout = 'main_login';
        if (!\Yii::$app->member->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['member/index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Signs user up.
     * 注册会员
     *
     * @return mixed
     * @since 2016-02-27
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($member = $model->signup()) {
                if (Yii::$app->member->login($member)) {
                    return $this->redirect(['member/index']);
                }
            }
        }

        $this->layout = 'main_login';
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * 注册会员表单ajax验证
     *
     * @return array
     * @since 2016-02-28
     */
    public function actionValidate()
    {
        $model = new SignupForm();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * 修改密码
     *
     * @return Response
     * @since 2016-02-27
     */
    public function actionModifyPwd()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goBack();
        }

        $model = new ModifyPwdForm();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            if ($model->modifyPwd()) {
                Yii::$app->getSession()->setFlash('success', '修改成功');
            } else {
                \Yii::$app->getSession()->setFlash('error', '修改失败');
            }
            return $this->refresh();
        } else {
            return $this->render('modifyPwd',[
                'model' => $model
            ]);
        }
    }

    /**
     * 修改密码ajax验证
     *
     * @return array
     * @since 2016-02-28
     */
    public function actionValidatePwd()
    {
        $model = new ModifyPwdForm();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionFindPwd()
    {

    }

    /**
     * Logs out the current member.
     *
     * @return mixed
     * @since 2016-02-28
     */
    public function actionLogout()
    {
        Yii::$app->member->logout();

        //return $this->goHome();
        return $this->redirect(['member/login']);
    }

    public function actionTest()
    {
        //Yii::getLogger()->log("开始写自定义日志",Logger::LEVEL_ERROR);

        Yii::trace("trace,开发调试时候记录");

        Yii::error("error,错误日志");

        Yii::warning("warning,警告信息");

        Yii::info("info,记录操作提示");
    }

}