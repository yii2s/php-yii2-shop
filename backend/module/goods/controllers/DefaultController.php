<?php

namespace backend\module\goods\controllers;

use common\components\CController;
use common\models\Spec;
use common\service\CategoryService;
use common\service\GoodsService;
use common\utils\DebugUtil;
use common\utils\ResponseUtil;
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
        $model = new Goods();
        if ($data = Yii::$app->request->post()) {
            return $this->redirect(['view',
                'id' => GoodsService::factory()->save($data[$this->getShortName($model)])
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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

}
