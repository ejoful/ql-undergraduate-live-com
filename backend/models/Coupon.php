<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%coupon}}".
 *
 * @property integer $coupon_id
 * @property integer $user_id
 * @property string $name
 * @property integer $fee
 * @property integer $isuse
 * @property string $start_time
 * @property string $end_time
 */
class Coupon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%coupon}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'fee', 'start_time', 'end_time'], 'required'],
            [['user_id', 'fee', 'isuse'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'coupon_id' => Yii::t('app', 'Coupon ID'),
            'user_id' => Yii::t('app', '用户'),
            'name' => Yii::t('app', '优惠券名字'),
            'fee' => Yii::t('app', '金额'),
            'isuse' => Yii::t('app', '是否使用'),
            'start_time' => Yii::t('app', '开始时间'),
            'end_time' => Yii::t('app', '结束时间'),
        ];
    }

    /**
     * @inheritdoc
     * @return CouponQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CouponQuery(get_called_class());
    }

    private static $_items = array();
    public static function item($status)
    {
        if(!isset(self::$_items[$status]))
            self::loadItems();
            return isset(self::$_items[$status]) ? self::$_items[$status] : false;
    }
    public static function loadItems() {
        self::$_items[0] = '未使用';
        self::$_items[1] = '使用中';
        self::$_items[2] = '已使用';
    }
}
