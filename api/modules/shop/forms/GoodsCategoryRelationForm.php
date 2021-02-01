<?php


namespace api\modules\shop\forms;


use api\modules\shop\models\GoodsCategoryRelation;
use common\traits\FormModelValidate;

class GoodsCategoryRelationForm extends GoodsCategoryRelation
{
    use FormModelValidate;

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [['id', 'goods_id', 'category_id'], 'required'],
        ];
    }

    /**
     * @return array|array[]
     */
    public function scenarios()
    {
        return array_merge(parent::scenarios(), [
            self::SCENARIO_STORE => ['goods_id', 'category_id'],
            self::SCENARIO_UPDATE => ['id', 'goods_id', 'category_id'],
            self::SCENARIO_DESTROY => ['id'],
        ]); // TODO: Change the autogenerated stub
    }
}