<?php

namespace api\modules\shop\models;

use api\components\ActiveRecord;
use api\modules\shop\models\query\CustomerQuery;
use Yii;

/**
 * This is the model class for table "sd_customer".
 *
 * @property int $id
 * @property string $name 客户姓名
 * @property string $phone 客户手机号
 * @property string $loc_number 客户固话
 * @property string $wx 客户微信号
 * @property int $is_del 是否删除（0-否，1-是）
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Customer extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sd_customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_del', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'wx'], 'string', 'max' => 64],
            [['phone', 'loc_number'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '客户姓名',
            'phone' => '客户手机号',
            'loc_number' => '客户固话',
            'wx' => '客户微信号',
            'is_del' => '是否删除（0-否，1-是）',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerQuery(get_called_class());
    }
}
