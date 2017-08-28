<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\CoursePackage */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Course Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-package-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'category_name',
            'course',
            [
                'attribute' => 'list_pic',
                'label' => '列表图片',
                'format' => ['image',['width'=>'40']]
            ],
            [
                'attribute' => 'home_pic',
                'label' => '封面图片',
                'format' => ['image',['width'=>'40']]
            ],
            'price',
            'discount',
            'des:html',
            'view',
            'collection',
            'share',
            'online',
            [
                'attribute' => 'onuse',
                'value'=> $model->onuse == 1 ? '可用' : '不可用',
            ],
            'create_time:datetime',
            [
                'attribute' => 'head_teacher',
                'value' => User::item($model->head_teacher),
            ],
        ],
    ]) ?>

</div>