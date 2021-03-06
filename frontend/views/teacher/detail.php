<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use frontend\assets\AppAsset;
use backend\models\Course;
use backend\models\User;

AppAsset::addCss($this,'@web/css/teacher.css');

$this->title = 'My Yii Application';
?>
<div class="container-course teacher-detail container-inner">
    <div class="left-introduce">
        <p class="teacher-img"><img src="<?= $teacher->picture ?>"/></p>
        <div class="teacher-name">
            <span class="name"><?= $teacher->username ?></span>
            <span class="school"><?= $teacher->description ?></span>
        </div>
        <div class="star">
            <img src="/img/star-on.png"/>
            <img src="/img/star-on.png"/>
            <img src="/img/star-on.png"/>
            <img src="/img/star-on.png"/>
            <img src="/img/star-off.png"/>
        </div>
        <p class="teacher-class">
            <span class="tag">约课次数：</span>
            <span class="tag-count">0 次</span>
        </p>
        <p class="teacher-class">
            <span class="tag">课酬标准：</span>
            <span class="tag-count">面议</span>
        </p>
    </div>
    <div class="right-introduce">
        <h4><?= $teacher->username ?>  <?= $teacher->description ?></h4>
        <div class="txt">
            <h5>资历介绍</h5>
            <p></p><p><?= $teacher->intro ?></p>
            <h5>主讲课程</h5>
            <p>
            <?php
                $coursename = '';
                foreach ($courses as $key => $course) {
                    $coursename.= "《".$course->course_name."》&nbsp;";
                }
                echo $coursename;
            ?>
            </p>
        </div>
    </div>
</div>
<div class="container-course course-tab container-inner">
    <div class="course-tab-title">主讲课程</div>
</div>
<div class="container-course course-content container-inner">
    <ul class="container-inner list active">
    <?php foreach ($courses as $course) { ?>
        <li>
            <a href="<?= Url::to(['course/detail', 'courseid' => $course->id]) ?>">
                <div class="course-img">
                    <img class="course-pic" src="<?= $course->list_pic; ?>"/>
                </div>
                <p class="content-title"><?= $course->course_name; ?></p>
            </a>
            <div class="course-statistic">
                <i class="icon ion-android-person"></i>
                <span class="people"><?= $course->online; ?>人在学</span>
                <i class="icon ion-heart"></i>
                <span class="people"><?= $course->collection; ?>人</span>
            </div>
        </li>
    <?php } ?>
    </ul>
</div>
<script src="<?php echo Url::to('@web/js/lib/jquery.min.js');?>"></script>
<script src="<?php echo Url::to('@web/js/detail.js');?>"></script>