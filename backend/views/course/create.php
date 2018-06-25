<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Course */

$this->title = Yii::t('app', 'Create Course');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Courses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section course-create">

    <?= $this->render('_form', [
        'model' => $model,
        'teachers' => $teachers,
        'head_teachers' => $head_teachers,
        'categorys' => $categorys
    ]) ?>

</div>
