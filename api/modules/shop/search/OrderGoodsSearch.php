<?php


namespace api\modules\shop\search;


use api\modules\shop\resources\OrderGoodsResource;
use common\traits\FormModelValidate;
use common\traits\SearchModelScenesTrait;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class OrderGoodsSearch extends OrderGoodsResource
{
    use SearchModelScenesTrait;

    public $no_page;
    public $sort_val;

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [['order_id'], 'integer'],
            [['no_page'], 'in', 'range' => [0, 1]],
            [['sort_val'], 'sortValToArr'],
            [['shop_id'], 'strCommaArr'],
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
            self::withDatabaseName('shop_id') => $this->shop_id,
            self::withDatabaseName('order_id') => $this->order_id,
        ]);

        if ($this->no_page) {
            $dataProvider->pagination = false;
        }

        if ($this->sort_val) {
            $query->orderBy($this->sort_val);
        }

        $query->addOrderBy([self::withDatabaseName('id') => SORT_DESC]);

        return $dataProvider;
    }
}