<?php


namespace api\modules\admin\resources;


use api\modules\admin\models\Menu;
use yii\helpers\ArrayHelper;

class MenuResource extends Menu
{
    public function fieldIndex()
    {
        return [
            'id' => function () {
                return $this->id;
            },
            'title' => function () {
                return $this->title;
            },
            'path' => function () {
                return $this->path;
            },
            'sort' => function () {
                return $this->sort;
            },
            'icon' => function () {
                return $this->icon;
            },
            'pid' => function () {
                return $this->pid;
            },
            'parent_title' => function () {
                return ArrayHelper::getValue($this->parentMenu, 'title', '根节点');
            },
        ];
    }
}