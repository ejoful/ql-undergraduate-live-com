<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OrderInfo */

$this->title = Yii::t('app', 'Create Order Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-info-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
