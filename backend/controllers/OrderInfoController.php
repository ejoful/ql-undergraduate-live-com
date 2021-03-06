<?php

namespace backend\controllers;

use Yii;
use backend\models\OrderInfo;
use backend\models\OrderInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Course;
use backend\models\User;

/**
 * OrderInfoController implements the CRUD actions for OrderInfo model.
 */
class OrderInfoController extends Controller
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
     * Lists all OrderInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->pay_status == 0) {
            $model->pay_status = '未付款';
        } elseif ($model->pay_status == 1) {
            $model->pay_status = '付款中';
        }  elseif ($model->pay_status == 2) {
            $model->pay_status = '已付款';
        }
        if ($model->course_ids == 'all') {
            $courses = 'all';
        } else {
            $courses = Course::find()
            ->where(['id' => explode(',', $model->course_ids)])
            ->all();
        }
        return $this->render('view', [
            'model' => $model,
            'courses' => $courses,
        ]);
    }

    /**
     * Creates a new OrderInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrderInfo();

        $model->order_sn = 'school_'.time();
        $model->order_status = 1;
        $model->pay_status = 2;
        $model->add_time = time();
        $model->confirm_time = time();
        $model->course_ids = 'all';
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            $user_id = $data['OrderInfo']['user_id'];
            $user = User::getUserModel($user_id);
            $model->mobile = $user->phone;
            $model->email =  $user->email;
            $model->consignee =  $user->username;
            $model->pay_time = strtotime($data['OrderInfo']['pay_time']);
            $model->invalid_time = strtotime($data['OrderInfo']['invalid_time']);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->order_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OrderInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            $user_id = $data['OrderInfo']['user_id'];
            $user = User::getUserModel($user_id);
            $model->mobile = $user->phone;
            $model->email =  $user->email;
            $model->consignee =  $user->username;
            $model->pay_time = strtotime($data['OrderInfo']['pay_time']);
            $model->invalid_time = strtotime($data['OrderInfo']['invalid_time']);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->order_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OrderInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrderInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
