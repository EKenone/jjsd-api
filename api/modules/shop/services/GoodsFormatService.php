<?php


namespace api\modules\shop\services;


use api\modules\shop\forms\GoodsFormatForm;
use api\modules\shop\resources\GoodsFormatResource;
use api\modules\shop\search\GoodsFormatSearch;
use yii\base\UserException;

class GoodsFormatService extends Service
{
    /**
     * @var string
     */
    public $formClass = GoodsFormatForm::class;

    /**
     * @var string
     */
    public $resourceClass = GoodsFormatResource::class;

    /**
     * @var string
     */
    public $searchClass = GoodsFormatSearch::class;

    /**
     * @param array $params
     * @return mixed
     * @throws UserException
     */
    public function index($params = [])
    {
        return parent::index($params); // TODO: Change the autogenerated stub
    }

    /**
     * @param array $data
     * @return GoodsFormatForm
     * @throws UserException
     */
    public function store($data = [])
    {
        return parent::store($data); // TODO: Change the autogenerated stub
    }

    /**
     * @param array $data
     * @return GoodsFormatForm
     * @throws UserException
     */
    public function update($data = [])
    {
        return parent::update($data); // TODO: Change the autogenerated stub
    }

    /**
     * @param array $data
     * @return GoodsFormatForm
     * @throws UserException
     */
    public function destroy($data = [])
    {
        return parent::destroy($data); // TODO: Change the autogenerated stub
    }
}