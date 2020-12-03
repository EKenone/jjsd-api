<?php


namespace api\components;


class Pagination extends \yii\data\Pagination
{
    /**
     * @var string name of the parameter storing the page size.
     * @see params
     */
    public $pageSizeParam = 'per_page';

    public $pageSizeLimit = [1, 200];
}