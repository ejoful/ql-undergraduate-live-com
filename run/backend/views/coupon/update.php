<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Coupon */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Coupon',
]) . $model->coupon_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Coupons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->coupon_id, 'url' => ['view', 'id' => $model->coupon_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="coupon-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
