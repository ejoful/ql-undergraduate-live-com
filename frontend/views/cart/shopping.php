<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\AppAsset;

AppAsset::addCss($this,'@web/css/order.css');

$this->title = '订单详情';
AppAsset::addScript($this,'@web/js/shopping.js');
?> 
<div class="order-wrapper order-detail-section">
    <div class="step-wrapper">
        <ul class="order-step">
            <li class="step1 finished">
                <i class="icon ion-ios-checkmark-empty"></i>
                <span>我的购物车</span>
            </li>
            <li class="step2 current">
                <i class="icon ion-document-text"></i>
                <span>确认订单信息</span>
            </li>
            <li class="step3">
                <i class="icon ion-pricetag"></i>
                <span>支付订单</span>
            </li>
        </ul>
    </div>
    <div class="order-detail-wrapper">
        <div class="order-top">
            <div class="inner-order">
                <h3>订单详情</h3>
<!--                 <p class="order-txt">订单编号：&nbsp;&nbsp;&nbsp;&nbsp;XHSOP90234</p> -->
                <p class="order-txt">订单内容：</p>
                <ul class="order-list">
                <?php 
                    $total_price = 0.00;
                    foreach($models as $model) { 
                        $total_price += $model->discount;
                ?>
                    <li>
                        <div class="cart-course-detail">
                            <div class="cart-img">
                                <img src="<?= $model->list_pic; ?>"/>
                            </div>
                            <div class="cart-txt">
                                <span class="name"><?= $model->course_name ?></span>
                                <span class="price">价格：￥<?= $model->discount ?></span>
                            </div>
                        </div>
                    </li>
                 <?php }?>
                </ul>
                <p class="total-summary">订单总额：<span class="price-high">￥<?= $total_price ?></span></p>
            </div>
        </div>
        <div class="order-payment-method">
            <div class="inner-order">
                <h3>订单支付方式</h3>
                <div class="payment-method">
                    <input type="radio" name="payment-method"/>
                    <span>在线支付</span>
                    <span class="payment-desc"> 选择在线支付订单，可使用学习券、优惠券或奖学金抵消部分订单总额；在线支付成功后，系统自动为您开通课程权限。</span>
                </div>
            </div>
        </div>
        <div class="order-payment-method discount">
            <div class="inner-order">
                <h3>可使用优惠券</h3>
                <?php if (empty($coupons)) {?>
                <div class="no-discount" style="display: none">暂无可使用优惠券</div>
                <?php } else {?>
                <ul class="discount-list">
                	<?php foreach ($coupons as $coupon) {?>
                    <li>
                        <input type="radio" data-couponid="<?= $coupon->coupon_id ?>" name="discount"/>
                        <span class="discount-img"><img src="/img/discount_<?= $coupon->fee ?>.jpg"/></span>
                        <span class="discount-desc"><?= $coupon->name ?></span>
                    </li>
                    <?php }?>
                </ul>
                <?php }?>
            </div>
        </div>
        <div class="order-payment-method order-total">
            <div class="inner-order">
                <div class="left">
                    <span>订单总额： ￥<?= $total_price ?></span>
                    <span>已优惠：<i>￥0.0011</i></span>
                </div>
                <div class="right">
                    <?php $form = ActiveForm::begin(['id' => 'order-confirm-form', 'action' => Url::to(['order-info/confirm_order'])]); ?>
                    应付总额：<span class="price-high">￥<?= $total_price ?></span>
                    <?= Html::HiddenInput('course_type', $course_type, ['id' => 'course_type']) ?>
                    <?= Html::HiddenInput('course_infos', $course_ids, ['id' => 'course_ids']) ?>
                    <?= Html::HiddenInput('coupon_ids', '', ['id' => 'coupon_ids']) ?>
                    <?= Html::submitButton('提交订单', ['class' => 'btn btn-confirm']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>