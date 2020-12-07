<?php


namespace api\modules\shop\resources;


use api\modules\shop\models\Goods;

class GoodsResource extends Goods
{
    /**
     * @return \Closure[]
     */
    public function fieldShow()
    {
        return [
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

    /**
     * @return \Closure[]
     */
    public function fieldSelect()
    {
        return [
            'unit' => function () {
                return $this->unit;
            },
        ];
    }

    /**
     * @return \Closure[]
     */
    public function fieldIndex()
    {
        return [
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
            'product_date' => function () {
                return $this->product_date;
            },
            'shelf_life' => function () {
                return $this->shelf_life;
            },
            'created_date' => function () {
                return date('Y-m-d H:i:s', $this->created_at);
            }
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
            'name' => function () {
                return $this->name;
            },
        ];
    }
}