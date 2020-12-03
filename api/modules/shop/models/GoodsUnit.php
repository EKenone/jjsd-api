<?php

namespace api\modules\shop\models;

use api\components\ActiveRecord;
use api\modules\shop\models\query\GoodsUnitQuery;
use Yii;

/**
 * This is the model class for table "sd_goods_unit".
 *
 * @property int $id
 * @property string $title 单位名称
 * @property int $is_del 是否删除（1-是，0-否）
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class GoodsUnit extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sd_goods_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_del', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
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
            'title' => '单位名称',
            'is_del' => '是否删除（1-是，0-否）',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return GoodsUnitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GoodsUnitQuery(get_called_class());
    }
}
