<?php


namespace api\modules\shop\resources;


use api\modules\shop\models\GoodsShelfLife;

class GoodsShelfLifeResource extends GoodsShelfLife
{
    /**
     * 这里是index场景返回给前端的字段
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
            }
        ];
    }
}