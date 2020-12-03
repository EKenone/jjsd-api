<?php


namespace api\components;


use yii\base\BaseObject;
use yii\data\ActiveDataProvider;

class ListProvider extends BaseObject
{
    /**
     * @var ActiveDataProvider
     */
    public ActiveDataProvider $list;

    /**
     * @var array
     */
    public array $expend;
}