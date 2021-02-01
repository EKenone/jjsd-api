<?php


namespace api\modules\shop\services;


use api\modules\shop\forms\GoodsCategoryForm;
use api\modules\shop\resources\GoodsCategoryResource;
use api\modules\shop\search\GoodsCategorySearch;
use yii\base\UserException;

class GoodsCategoryService extends Service
{
    /**
     * @var string
     */
    public $formClass = GoodsCategoryForm::class;

    /**
     * @var string
     */
    public $resourceClass = GoodsCategoryResource::class;

    /**
     * @var string
     */
    public $searchClass = GoodsCategorySearch::class;

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
     * 商品单位详情
     * @param int $id
     * @return GoodsCategoryResource
     * @throws UserException
     */
    public function show($id)
    {
        return parent::show($id);
    }

    /**
     * @param array $data
     * @return GoodsCategoryForm
     * @throws UserException
     */
    public function store($data = [])
    {
        return parent::store($data);
    }

    /**
     * @param array $data
     * @return GoodsCategoryForm
     * @throws UserException
     */
    public function update($data = [])
    {
        return parent::update($data);
    }

    /**
     * @param array $data
     * @return GoodsCategoryForm
     * @throws UserException
     */
    public function destroy($data = [])
    {
        return parent::destroy($data);
    }
}