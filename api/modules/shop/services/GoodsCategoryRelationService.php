<?php


namespace api\modules\shop\services;


use api\modules\shop\forms\GoodsCategoryRelationForm;
use api\modules\shop\models\GoodsCategoryRelation;
use yii\base\UserException;

class GoodsCategoryRelationService extends Service
{
    /**
     * @var string
     */
    public $formClass = GoodsCategoryRelationForm::class;

    /**
     * @param array $data
     * @return GoodsCategoryRelationForm
     * @throws UserException
     */
    public function store($data = [])
    {
        return parent::store($data);
    }

    /**
     * @param array $data
     * @return GoodsCategoryRelationForm
     * @throws UserException
     */
    public function update($data = [])
    {
        return parent::update($data);
    }

    /**
     * @param array $data
     * @return GoodsCategoryRelationForm
     * @throws UserException
     */
    public function destroy($data = [])
    {
        return parent::destroy($data);
    }

    /**
     * 设置商品类别关系
     * @param $goodsId
     * @param $cateGory
     * @return array
     * @throws UserException
     */
    public function setRelation($goodsId, $cateGory)
    {
        $cateGoryIds = GoodsCategoryRelation::find()
            ->select('category_id')
            ->notDelete()
            ->andWhere(['goods_id' => $goodsId])
            ->column();

        $add = array_diff($cateGory, $cateGoryIds);
        $del = array_diff($cateGoryIds, $cateGory);

        if ($add) {
            foreach ($add as $item) {
                $this->store([
                    'goods_id' =>$goodsId,
                    'category_id' => $item,
                ]);
            }
        }

        if ($del) {
            GoodsCategoryRelation::deleteAll(['goods_id' => $goodsId, 'category_id' => $del]);
        }

        return [];
    }
}