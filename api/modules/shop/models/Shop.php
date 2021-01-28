<?php

namespace api\modules\shop\models;

use api\components\ActiveRecord;
use api\modules\shop\models\query\ShopQuery;
use Yii;

/**
 * This is the model class for table "sd_shop".
 *
 * @property int $id
 * @property string $name 商家名称
 * @property string $print_name 订单打印的名称
 * @property string $address 商家地址
 * @property string $tel 商家联系方式
 * @property int $is_del 是否删除（0-否，1-是）
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Shop extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sd_shop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_del', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'print_name'], 'string', 'max' => 64],
            [['address', 'tel'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商家名称',
            'print_name' => '订单打印的名称',
            'address' => '商家地址',
            'tel' => '商家联系方式',
            'is_del' => '是否删除（0-否，1-是）',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ShopQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShopQuery(get_called_class());
    }
}
