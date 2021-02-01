<?php

namespace api\modules\shop\models;

use api\modules\shop\models\query\GoodsCategoryRelationQuery;
use Yii;

/**
 * This is the model class for table "sd_goods_category_relation".
 *
 * @property int $id
 * @property int $goods_id 商品ID
 * @property int $category_id 品类ID
 * @property int $is_del 是否删除（0-否，1-是）
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class GoodsCategoryRelation extends \api\components\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sd_goods_category_relation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['goods_id', 'category_id', 'is_del', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => '商品ID',
            'category_id' => '品类ID',
            'is_del' => '是否删除（0-否，1-是）',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return GoodsCategoryRelationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GoodsCategoryRelationQuery(get_called_class());
    }
}
