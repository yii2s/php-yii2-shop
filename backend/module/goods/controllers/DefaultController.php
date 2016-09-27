<?php

namespace backend\module\goods\controllers;

use common\components\CController;
use common\hybrid\AbstractHybrid;
use common\models\Spec;
use common\service\CategoryService;
use common\service\GoodsService;
use common\utils\DebugUtil;
use common\utils\FileUtil;
use common\utils\ResponseUtil;
use common\utils\WebUtil;
use Yii;
use common\models\Goods;
use backend\module\goods\models\GoodsSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for Goods model.
 */
class DefaultController extends CController
{
    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goods model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        return $this->render('create', [
            'model' => new Goods(),
        ]);
    }

    /**
     * 保存或修改
     * @return \yii\web\Response
     */
    public function actionSave()
    {
        $model = new Goods();
        if ($data = Yii::$app->request->post()) {
            $id = GoodsService::factory()->save($data[$this->getShortName($model)]);
            echo $id;exit;
            return $this->redirect(['view',
                'id' => GoodsService::factory()->save($data[$this->getShortName($model)])
            ]);
        }
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        return $this->render('update', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddSpec()
    {
        $data = Yii::$app->request->post();

        if ($data['type'] == 1) {
            $data['value'] = serialize(explode(',', str_replace('，', ',', $data['value'])));
        } else {
            //$data['value'] = serialize($data['value']);
        }

        $data['seller_id'] = Yii::$app->user->id;
        $id = CategoryService::factory()->saveSpec($data);
        if ($spec = Spec::findOne($id)) {
            ResponseUtil::json(['data' => $this->_specContentText($spec)]);
        } else {
            ResponseUtil::json(null, 1, 'fail');
        }
    }

    private function _specContentText($spec)
    {
        $html = '<div class="panel panel-default">';
        $html .= '<div class="panel-heading">';
        $html .= '<h3 class="panel-title spec_name">'. $spec->name .'</h3>';
        $html .= '</div><div class="panel-body">';

        $values = unserialize($spec->value);
        if ($spec->type == 1) {
            foreach ((array)$values as $value) {
                $html .= '<label class="checkbox-inline">';
                $html .= '<input type="checkbox" name="spec-select" value="'. $value .'">' . $value;
                $html .= '</label>';
            }
        } else {
            foreach ((array)$values as $value) {
                $html .= '<label class="checkbox-inline">';
                $html .= '<input type="checkbox" name="spec-select" value="'. $value .'">';
                $html .= '<img src="'. $value .'" width="40" height="40"/>';
                $html .= '</label>';
            }
        }

        $html .= '</div></div>';

        return $html;
    }

    /**
     * 上传文件
     * @since 2016-09-27
     */
    public function actionUploadImg()
    {
        $field = Yii::$app->request->get('field', 'Filedata');
        $url = FileUtil::upload($field,'',['png','jpg']);
        ResponseUtil::json(['url' => $url]);
    }

    /**
     * 上传图集
     * @since 2016-09-27
     */
    /*public function actionUpload()
    {
        $data = Yii::$app->request->post();
        GoodsService::factory()->saveImages($data['gid'],$data['images'], new AbstractHybrid());
    }

    public function actionSaveSysAttr()
    {
        $data = Yii::$app->request->post();
        GoodsService::factory()->saveSysAttr($data['gid'],$data['sysAttr'], new AbstractHybrid());
    }

    public function actionSaveExtAttr()
    {
        $data = Yii::$app->request->post();
        GoodsService::factory()->saveExtAttr($data['gid'],$data['extAttr'], new AbstractHybrid());
    }

    public function actionSaveSpec()
    {
        $data = Yii::$app->request->post();
        GoodsService::factory()->saveSpec($data['gid'],$data['spec'], new AbstractHybrid());
    }*/

    public function actionTest()
    {
        $data = WebUtil::postData('http://web.cm/admin.php?r=goods/default/upload-images', array('id'=>2), 0);
        print_r($data);
    }

    /**
     * 保存商品数据 异步请求
     * @since 2016-09-27
     */
    public function actionSaveGoodsData()
    {
        $hybrid = new AbstractHybrid();
        $data = Yii::$app->request->post();
        if ($data['spec']) {
            GoodsService::factory()->saveSpec($data['goodID'],$data['spec'], $hybrid);
        }
        if ($data['extAttr']) {
            GoodsService::factory()->saveExtAttr($data['goodID'],$data['extAttr'], $hybrid);
        }
        if ($data['images']) {
            GoodsService::factory()->saveImages($data['goodID'],$data['images'], $hybrid);
        }
        if ($data['sysAttr']) {
            GoodsService::factory()->saveSysAttr($data['goodID'],$data['sysAttr'], $hybrid);
        }
        if ($data['recommend']) {
            GoodsService::factory()->saveRecommend($data['goodID'],$data['recommend'], $hybrid);
        }
    }

}
