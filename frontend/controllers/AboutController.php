<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\Data;


class AboutController extends Controller
{
    /**
     * @inheritdoc
     */

    // 渲染如何学习静态页
    public function actionHowToStudy() {
        return $this->render('how-to-study');
    }

    // 渲染关于我们静态页
    public function actionIndex() {
        return $this->render('index');
    }

    // 加入我们静态页渲染
    public function actionJoin() {
        return $this->render('join');
    }

    // 常见问题FAQ静态页渲染
    public function actionFaq() {
        return $this->render('faq');
    }

    // 学员手册
    public function actionStudentBook() {
        return $this->render('student-book');
    }

    // 开学指导
    public function actionStartGuid() {
        return $this->render('start-guid');
    }

    // 我的课表
    public function actionTimetable() {
        return $this->render('timetable');
    }
}
