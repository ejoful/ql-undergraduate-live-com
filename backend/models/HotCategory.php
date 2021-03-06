<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%hot_category}}".
 *
 * @property integer $id
 * @property integer $categoryid
 * @property string $backgroundcolor
 * @property string $icon
 * @property string $title
 * @property integer $position
 *
 * @property CourseCategory $category
 */
class HotCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%hot_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryid'], 'required'],
            [['categoryid', 'position'], 'integer'],
            [['backgroundcolor', 'icon', 'title'], 'string', 'max' => 255],
            [['categoryid'], 'exist', 'skipOnError' => true, 'targetClass' => CourseCategory::className(), 'targetAttribute' => ['categoryid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'categoryid' => Yii::t('app', '热门分类'),
            'backgroundcolor' => Yii::t('app', '背景色'),
            'icon' => Yii::t('app', '图标'),
            'title' => Yii::t('app', '标题'),
            'position' => Yii::t('app', '显示顺序'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CourseCategory::className(), ['id' => 'categoryid']);
    }

    /**
     * @inheritdoc
     * @return HotCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HotCategoryQuery(get_called_class());
    }
}
