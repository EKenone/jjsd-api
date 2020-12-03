<?php


namespace api\modules\shop\resources;


use api\modules\shop\models\CustomerAddress;
use yii\helpers\ArrayHelper;

class CustomerAddressResource extends CustomerAddress
{
    public function fieldIndex()
    {
        return [
            'id' => function () {
                return $this->id;
            },
            'customer_id' => function () {
                return $this->customer_id;
            },
            'customer_name' => function () {
                return ArrayHelper::getValue($this->customer, 'name', '');
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
            'created_date' => function () {
                return date('Y-m-d H:i', $this->created_at);
            }
        ];
    }

    public function fieldShow()
    {
        return [
            'id' => function () {
                return $this->id;
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
        ];
    }
}