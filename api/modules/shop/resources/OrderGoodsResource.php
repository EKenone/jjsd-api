<?php


namespace api\modules\shop\resources;


use api\modules\shop\models\OrderGoods;

class OrderGoodsResource extends OrderGoods
{
    public function fieldIndex()
    {
        return [
            'id' => function () {
                return $this->id;
            },
            'name' => function () {
                return $this->name;
            },
            'unit' => function () {
                return $this->unit;
            },
            'price' => function () {
                return $this->price;
            },
            'total' => function () {
                return $this->totalPriceYuan();
            },
            'book_num' => function () {
                return $this->book_num;
            }
        ];
    }
}