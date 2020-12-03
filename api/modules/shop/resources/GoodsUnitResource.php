<?php


namespace api\modules\shop\resources;


use api\modules\shop\models\GoodsUnit;

class GoodsUnitResource extends GoodsUnit
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
            'title' => function () {
                return $this->title;
            },
            'created_date' => function () {
                return date('Y-m-d H:i', $this->created_at);
            }
        ];
    }
}