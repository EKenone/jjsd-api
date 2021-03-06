<?php


namespace api\modules\shop\forms;


use api\modules\shop\models\Order;
use common\traits\FormModelValidate;

class OrderForm extends Order
{
    use FormModelValidate;

    const BOOK_GOODS = 'book_goods';
    const BOOK_CLEAR = 'book_clear';
    const BOOK_UPDATE = 'book_update';
    const CREATE = 'CREATE';
    const CHANGE_STATUS = 'change_status';

    public $goods_id;
    public $price;
    public $book_num;
    public $book_id;
    public $order_id;

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [['id', 'shop_id', 'order_no', 'customer_id', 'address_id', 'goods_id', 'price', 'book_num', 'consignee', 'address', 'amount'], 'required'],
            [['remark', 'contact_tel'], 'default', 'value' => ''],
            [['status'], 'integer'],
            [['real_amount', 'order_id'], 'default', 'value' => 0],
        ];
    }

    /**
     * @return array|array[]
     */
    public function scenarios()
    {
        return array_merge(parent::scenarios(), [
            self::SCENARIO_STORE => ['shop_id', 'order_no', 'customer_id', 'address_id', 'consignee', 'contact_tel', 'address', 'amount', 'remark', 'status'],
            self::SCENARIO_UPDATE => ['order_no', 'customer_id', 'address_id', 'consignee', 'contact_tel', 'address', 'amount', 'remark', 'status'],
            self::SCENARIO_DESTROY => ['id'],
            self::BOOK_GOODS => ['customer_id', 'address_id', 'goods_id', 'price', 'book_num', 'order_id'],
            self::BOOK_CLEAR => ['address_id', 'book_id', 'order_id'],
            self::BOOK_UPDATE => ['address_id', 'book_id', 'price', 'book_num', 'order_id'],
            self::CREATE => ['address_id', 'order_id'],
            self::CHANGE_STATUS => ['id', 'status', 'remark', 'real_amount']
        ]); // TODO: Change the autogenerated stub
    }
}