<?php


namespace api\modules\admin\search;


use api\modules\admin\resources\MenuResource;
use common\traits\FormModelValidate;
use common\traits\SearchModelScenesTrait;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class MenuSearch extends MenuResource
{
    use SearchModelScenesTrait;

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     * @return ActiveQuery
     */
    public function baseQuery(): ActiveQuery
    {
        return self::find()->notDelete();
    }

    /**
     * @param ActiveQuery $query
     * @return ActiveDataProvider
     */
    public function commonSearch(ActiveQuery $query): ActiveDataProvider
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        if ($this->no_page) {
            $dataProvider->pagination = false;
        }

        $query->addOrderBy(['id'=>SORT_DESC]);

        return $dataProvider;
    }
}