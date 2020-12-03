<?php


namespace api\modules\shop\resources;


use api\modules\shop\models\Goods;

class GoodsResource extends Goods
{
    public function fieldShow()
    {
        return [
            'id' => function () {
                return $this->id;
            },
            'name' => function () {
                return $this->name;
            },
            'short_name' => function () {
                return $this->short_name;
            },
            'number' => function () {
                return $this->number;
            },
            'unit' => function () {
                return $this->unit;
            },
            'stock' => function () {
                return $this->stockShow();
            },
            'purchase_price' => function () {
                return $this->purchase_price;
            },
            'wholesale_price' => function () {
                return $this->wholesale_price;
            },
            'retail_price' => function () {
                return $this->retail_price;
            },
            'img_source' => function () {
                return $this->imgSource();
            },
        ];
    }

    public function fieldSelect()
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
        ];
    }

    public function fieldIndex()
    {
        return [
            'id' => function () {
                return $this->id;
            },
            'name' => function () {
                return $this->name;
            },
            'short_name' => function () {
                return $this->short_name;
            },
            'number' => function () {
                return $this->number;
            },
            'stock' => function () {
                return $this->stockShow();
            },
            'unit' => function () {
                return $this->unit;
            },
            'format' => function () {
                return $this->format;
            },
            'purchase_price' => function () {
                return $this->purchase_price;
            },
            'wholesale_price' => function () {
                return $this->wholesale_price;
            },
            'retail_price' => function () {
                return $this->retail_price;
            },
            'img_source' => function () {
                return $this->imgSource();
            },
            'created_date' => function () {
                return date('Y-m-d H:i:s', $this->created_at);
            }
        ];
    }
}