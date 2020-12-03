<?php


namespace api\modules\shop\resources;


use api\modules\shop\models\Customer;

class CustomerResource extends Customer
{
    /**
     * @return \Closure[]
     */
    public function fieldIndex()
    {
        return [
            'id' => function () {
                return $this->id;
            },
            'name' => function () {
                return $this->name;
            },
            'phone' => function () {
                return $this->phone;
            },
            'loc_number' => function () {
                return $this->loc_number;
            },
            'wx' => function () {
                return $this->wx;
            },
            'created_date' => function () {
                return date('Y-m-d H:i', $this->created_at);
            }
        ];
    }
}