<?php


namespace api\modules\shop\search;


use api\modules\shop\resources\OrderGoodsResource;
use common\traits\SearchModelScenesTrait;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class OrderGoodsSearch extends OrderGoodsResource
{
    use SearchModelScenesTrait;

    public $no_page;

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [['order_id'], 'integer'],
            [['no_page'], 'in', 'range' => [0, 1]],
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

        $query->andFilterWhere([
            self::withDatabaseName('order_id') => $this->order_id
        ]);

        if ($this->no_page) {
            $dataProvider->pagination = false;
        }

        $query->addOrderBy([self::withDatabaseName('id') => SORT_DESC]);

        return $dataProvider;
    }
}