<?php

namespace api\modules\shop\models;

use api\modules\shop\models\query\GoodsCategoryQuery;
use Yii;

/**
 * This is the model class for table "sd_goods_category".
 *
 * @property int $id
 * @property int $shop_id 商家ID
 * @property string $title 分类名称
 * @property int $is_del 是否删除（0-否，1-是）
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class GoodsCategory extends \api\components\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sd_goods_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shop_id', 'is_del', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_id' => '商家ID',
            'title' => '分类名称',
            'is_del' => '是否删除（0-否，1-是）',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return GoodsCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GoodsCategoryQuery(get_called_class());
    }
}
