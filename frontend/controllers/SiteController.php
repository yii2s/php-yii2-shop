<?php
namespace frontend\controllers;

use common\service\CategoryService;
use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'categories' => CategoryService::factory()->getCategoriesMap()
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionTest()
    {
        echo header('location:http://xuetang.cnweike.cn/dl/xuetang.php');
    }

    public function actionTest2()
    {

        $urls=array(
            'http://qnm.cnweike.cn/content/0/1/70/83606/392348.m.mp4?download/%E4%BF%AE%E8%BE%9E%E5%AD%A6%E4%B9%A0%E6%BC%AB%E8%B0%88%E7%B3%BB%E5%88%97%E5%BE%AE%E8%AF%BE%E4%BA%8C%EF%BC%9A%E3%80%8A%E7%8E%B0%E4%BB%A3%E6%B5%81%E8%A1%8C%E8%AF%AD%E4%B8%8E%E4%BF%AE%E8%BE%9E%E6%A0%BC%E3%80%8B.m.mp4',
        );
        foreach ($urls as $url) {
            self::request($url,false,array());
            //header("location:".$url);
        }
    }

    /**
     * @param $url
     * @param $data
     * @param int $asynch  �Ƿ��첽����  Ĭ�� 1ͬ��   0�첽
     * @param int $format 0:ԭʼ��ʽ; 1:,; 2:����
     * @return mixed
     */
    public static function postData($url,$data ,$asynch = 1,$format=2){
        return self::request($url,true,$data,$asynch,$format);
    }

    /**
     * ʹ��curl��������.
     *
     * @use ʹ��ʾ��:
     * get����:         WebUtils::request('http://www.cnweike.cn/',false,array('weikeID'=>2323));
     *
     * @param $url �����url
     * @param $isPost ����ʽ, trueʹ��post
     * @param $data post������
     * @param int $asynch �Ƿ��첽����  Ĭ�� 1ͬ��   0�첽
     * @param int $format �����ʽ  0:ԭʼ��ʽ; 1:json; 2:����
     * @return mixed
     * @author brook
     * @since 2016��01��15�� ֧��get��ʽ
     */
    protected static function request($url,$isPost,$data,$asynch=1,$format=2){
        $curl = curl_init();
        $postData=array();
        if($data && !empty($data)){
            foreach($data as $key=>$value){
                $postData[$key]=$value;
            }
        }
        $post = http_build_query($postData);  //��ά����ʱʹ�����
        if($isPost){
            curl_setopt($curl, CURLOPT_POST, true); // ����һ�������Post����
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        }else{
            if(is_array($data) && !empty($data)){
                $url .='?'.http_build_query($data);
            }
        }
        curl_setopt($curl, CURLOPT_URL, $url);

        if(!$asynch){
            curl_setopt ( $curl,  CURLOPT_NOSIGNAL, true);// �ǿ���֧�ֺ��뼶��ʱ���õ�
            curl_setopt($curl,CURLOPT_TIMEOUT_MS,200);//���ù�ʱʱ�䣬��СΪ1�� by John

        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, $asynch);//����Ϊ1ʱ����Ĭ�����������Ϣ�������ڱ�����return �������������
        $result = curl_exec($curl); //modify by chenzsh ����ֵ
        //$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        //$data = curl_getinfo($curl);
        //return $data;
        curl_close($curl);
        return $result ;//modify by chenzsh
    }

    public function actionTest1()
    {
        $msg = 'Hello , this is a closure <br>';
        $fun = function () use ($msg) {
            echo $msg;
        };
        $fun();
        //$this->callBack($fun);
    }

    private function callBack($fun)
    {
        $fun();
    }

    public $callBack = array();


}
