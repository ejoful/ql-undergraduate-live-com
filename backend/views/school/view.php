<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use backend\models\Provinces;
use backend\models\Cities;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '集体账户详情';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            'email:email',
            'phone',
            [
                'attribute' => 'picture',
                'label' => '照片',
                'format' => 'raw',
                'value' => Html::img($model->picture, ['width' => 40]),
            ],
            [
                'attribute' => 'provinceid',
                'value' => Provinces::item($model->provinceid),
            ],
            [
                'attribute' => 'cityid',
                'value' => Cities::item($model->cityid),
            ],
        ],
    ]) ?>

</div>
