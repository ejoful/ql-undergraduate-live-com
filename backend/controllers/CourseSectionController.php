<?php

namespace backend\controllers;

use Yii;
use backend\models\Course;
use backend\models\CourseSection;
use backend\models\CourseSectionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseSectionController implements the CRUD actions for CourseSection model.
 */
class CourseSectionController extends Controller
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
                    'delete' => ['POST','GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all CourseSection models.
     * @return mixed
     */
    public function actionIndex()
    {
        $request = Yii::$app->request->queryParams;
        $course_id = $request['course_id'];
        $courseSections = CourseSection::find()
        ->where(['course_id' => $course_id])
        ->orderBy('position ASC')
        ->all();
        $sectionsData = array();
        foreach ($courseSections as $key => $value) {
            $sectionsData[$key] = array();
            $sectionsData[$key]['name'] = $value->name;
            $sectionsData[$key]['id'] = $value->id;
            $sectionsData[$key]['parent_id'] = '0';
            $sectionsData[$key]['section_type'] = 'file';
        }
        $course = Course::find()
        ->where(['id' => $course_id])
        ->one();
        return $this->render('index', [
            'courseSections' => $sectionsData,
            'course' => $course,
        ]);
    }

    /**
     * Displays a single CourseSection model.
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
     * Creates a new CourseSection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CourseSection();
        $request = Yii::$app->request->queryParams;
        $course_id = $request['course_id'];
        $model->course_id = $course_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CourseSection model.
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
     * Deletes an existing CourseSection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return 'success';
    }

    /**
     * Finds the CourseSection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CourseSection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CourseSection::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
