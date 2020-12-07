<?php


namespace api\modules\shop\services;


use api\modules\shop\forms\GoodsShelfLifeForm;
use api\modules\shop\resources\GoodsShelfLifeResource;
use api\modules\shop\search\GoodsShelfLifeSearch;
use yii\base\UserException;

class GoodsShelfLifeService extends Service
{
    /**
     * @var string
     */
    public $formClass = GoodsShelfLifeForm::class;

    /**
     * @var string
     */
    public $resourceClass = GoodsShelfLifeResource::class;

    /**
     * @var string
     */
    public $searchClass = GoodsShelfLifeSearch::class;

    /**
     * @param array $params
     * @return mixed
     * @throws UserException
     */
    public function index($params = [])
    {
        return parent::index($params);
    }

    /**
     * @param int $id
     * @return GoodsShelfLifeResource
     * @throws UserException
     */
    public function show($id)
    {
        return parent::show($id);
    }

    /**
     * @param array $data
     * @return GoodsShelfLifeForm
     * @throws UserException
     */
    public function store($data = [])
    {
        return parent::store($data);
    }

    /**
     * @param array $data
     * @return GoodsShelfLifeForm
     * @throws UserException
     */
    public function update($data = [])
    {
        return parent::update($data);
    }

    /**
     * @param array $data
     * @return GoodsShelfLifeForm
     * @throws UserException
     */
    public function destroy($data = [])
    {
        return parent::destroy($data);
    }
}