<?php


namespace api\modules\shop\resources;


class GoodsCategoryResource extends \api\modules\shop\models\GoodsCategory
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
            },
            'created_date' => function () {
                return date('Y-m-d H:i', $this->created_at);
            }
        ];
    }
}