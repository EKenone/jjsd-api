<?php

namespace api\modules\shop\models;

use api\modules\shop\models\query\CustomerAddressQuery;
use Yii;

/**
 * This is the model class for table "sd_customer_address".
 *
 * @property int $id
 * @property int $shop_id 商家ID
 * @property int $customer_id 关联的客户
 * @property string $consignee 收货人
 * @property string $contact_tel 联系手机号
 * @property string $address 收货地址
 * @property int $is_del 是否删除（0-否，1-是）
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Customer $customer
 *
 */
class CustomerAddress extends \api\components\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sd_customer_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shop_id', 'customer_id', 'is_del', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['consignee'], 'string', 'max' => 16],
            [['contact_tel'], 'string', 'max' => 15],
            [['address'], 'string', 'max' => 255],
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
            'customer_id' => '关联的客户',
            'consignee' => '收货人',
            'contact_tel' => '联系手机号',
            'address' => '收货地址',
            'is_del' => '是否删除（0-否，1-是）',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CustomerAddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerAddressQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }
}
