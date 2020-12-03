<?php


namespace api\modules\shop\resources;


use api\modules\shop\models\Order;
use yii\helpers\ArrayHelper;

class OrderResource extends Order
{
    /**
     * @return array
     */
    public function fieldIndex()
    {
        return [
            'id' => function () {
                return $this->id;
            },
            'order_no' => function () {
                return $this->order_no;
            },
            'consignee' => function () {
                return $this->consignee;
            },
            'contact_tel' => function () {
                return $this->contact_tel;
            },
            'address' => function () {
                return $this->address;
            },
            'status' => function () {
                return $this->status;
            },
            'amount' => function () {
                return $this->amount;
            },
            'real_amount' => function () {
                return $this->real_amount;
            },
            'remark' => function () {
                return $this->remark;
            },
            'customer_name' => function () {
                return ArrayHelper::getValue($this->customer, 'name', '');
            },
            'created_date' => function () {
                return date('Y-m-d H:i', $this->created_at);
            },
        ];
    }
}