<?php

namespace api\modules\shop\models;

use api\components\ActiveRecord;
use api\modules\shop\models\query\OrderQuery;
use common\helpers\BaseHelper;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "sd_order".
 *
 * @property int $id
 * @property string $order_no 订单号
 * @property int $customer_id 客户ID
 * @property int $address_id 收货地址ID
 * @property string $consignee 收货人（快照）
 * @property string $contact_tel 联系方式（快照）
 * @property string $address 收货地址（快照）
 * @property float $amount 订单总金额
 * @property float $real_amount 实收总金额
 * @property int $status 订单状态(0-待配送，1-配送中，2-配送成功，3-已结算，4-赊账，5-退货)
 * @property string $remark 备注
 * @property int $is_del 是否删除（0-否，1-是）
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Customer $customer
 *
 */
class Order extends ActiveRecord
{
    const STATUS_WAIT_GIVE = 0;
    const STATUS_GIVING = 1;
    const STATUS_GONE = 2;
    const STATUS_SETTLED = 3;
    const STATUS_WAIT_SETTLE = 4;
    const STATUS_REFUSE = 5;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sd_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'address_id', 'status', 'is_del', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['consignee', 'order_no'], 'string', 'max' => 16],
            [['amount', 'real_amount'], 'number'],
            [['contact_tel'], 'string', 'max' => 15],
            [['address', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_no' => '订单号',
            'customer_id' => '客户ID',
            'address_id' => '收货地址ID',
            'consignee' => '收货人（快照）',
            'contact_tel' => '联系方式（快照）',
            'address' => '收货地址（快照）',
            'amount' => '订单总金额',
            'real_amount' => '实收总金额',
            'status' => '订单状态(0-待配送，1-配送中，2-配送成功，3-已结算，4-赊账，5-退货)',
            'remark' => '备注',
            'is_del' => '是否删除（0-否，1-是）',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }

    /**
     * @return ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }

    public static function statusMap()
    {
        return [
            self::STATUS_WAIT_GIVE => '待配送',
            self::STATUS_GIVING => '配送中',
            self::STATUS_GONE => '配送成功',
            self::STATUS_SETTLED => '已结算',
            self::STATUS_WAIT_SETTLE => '赊账',
            self::STATUS_REFUSE => '退货',
        ];
    }
}
