<?php


namespace api\modules\shop\resources;


use api\modules\shop\models\CustomerAddress;
use yii\helpers\ArrayHelper;

class CustomerAddressResource extends CustomerAddress
{
    /**
     * @return \Closure[]
     */
    public function fieldIndex()
    {
        return [
            'customer_id' => function () {
                return $this->customer_id;
            },
            'customer_name' => function () {
                return ArrayHelper::getValue($this->customer, 'name', '');
            },
            'address' => function () {
                return $this->address;
            },
            'created_date' => function () {
                return date('Y-m-d H:i', $this->created_at);
            }
        ];
    }

    /**
     * @return \Closure[]
     */
    public function fieldShow()
    {
        return [
            'address' => function () {
                return $this->address;
            },
        ];
    }

    /**
     * @return array|\Closure[]
     */
    public function base()
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
            }
        ];
    }
}