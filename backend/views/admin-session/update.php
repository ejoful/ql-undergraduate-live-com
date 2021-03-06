<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminSession */

$this->title = Yii::t('app', 'Update Admin Session: {nameAttribute}', [
    'nameAttribute' => $model->session_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admin Sessions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->session_id, 'url' => ['view', 'id' => $model->session_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="admin-session-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
