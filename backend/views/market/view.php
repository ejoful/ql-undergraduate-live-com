<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use backend\models\Provinces;
use backend\models\Cities;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '市场专员详情页';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '市场专员列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$invite_url = 'http://www.kaoben.top'.Url::to(['site/signup','invite' => $model->id]);
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
//             'auth_key',
//             'password_hash',
//             'password_reset_token',
            'email:email',
            'phone',
            [
                'attribute' => 'provinceid',
                'value' => Provinces::item($model->provinceid),
            ],
            [
                'attribute' => 'cityid',
                'value' => Cities::item($model->cityid),
            ],
            'description',
            [
                'attribute' => 'gender',
                'value'=> $model->gender ? '女' : '男',
            ],
            [
                'attribute' => 'picture',
                'label' => '照片',
                'format' => 'raw',
                'value' => Html::img($model->picture, ['width' => 40]),
            ],
//             'unit',
//             'office',
//             'goodat',
//             'intro:ntext',
//             'invite',
//             'status',
            'bank',
            'bank_username',
            'bankc_card',
            [
                'attribute' => 'created_at',
                'value'=> date('Y-m-d H:i:s', $model->created_at),
            ],
            [
                'attribute' => 'updated_at',
                'value'=> date('Y-m-d H:i:s', $model->updated_at),
            ],
        ],
    ]) ?>
<div>
<div class="order-table">
    <p class="title">推广详情</p>
    <ul>
        <li>
            <label class="tr-title">专员相关链接</label>
            <span class="tr-content">
                <a href="<?= Url::to(['market/order', 'id' => $model->id]) ?>">订单记录</a>
                <a href="<?= Url::to(['withdraw/withdraw', 'id' => $model->id]) ?>">提现历史</a>
            </span>
        </li>
        <li>
            <label class="tr-title">钱包</label>
            <span class="tr-content"><?= $fee ?></span>
        </li>
        <li>
            <label class="tr-title">推广注册链接</label>
            <span class="tr-content"><?= $invite_url ?></span>
        </li>
        <li class="tr-img">
            <label class="tr-title">推广注册二维码图片</label>
            <span class="tr-content"><img src="<?= Url::to(['market/qrcode','url' => $invite_url, 'name' => $model->id.'.png'])?>" /></span>
        </li>
    </ul>
</div>
