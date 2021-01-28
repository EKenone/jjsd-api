<?php


namespace api\modules\shop\search;


use api\modules\shop\resources\OrderResource;
use common\traits\SearchModelScenesTrait;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class OrderSearch extends OrderResource
{
    use SearchModelScenesTrait;

    public $keyword;
    public $created_start;
    public $created_end;

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [['keyword', 'order_no'], 'trim'],
            [['status'], 'in', 'range' => array_keys(self::statusMap())],
            [['created_start', 'created_end', $this->scenesProperty()], 'safe'],
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
            self::withDatabaseName('status') => $this->status,
        ]);

        if ($this->keyword) {
            $query->andWhere([
                'OR',
                ['like', self::withDatabaseName('consignee'), $this->keyword],
                ['like', self::withDatabaseName('contact_tel'), $this->keyword],
            ]);
        }

        if ($this->order_no) {
            $query->andWhere(['order_no' => $this->order_no]);
        }

        if ($this->created_start) {
            $query->andWhere(['>=', self::withDatabaseName('created_at'), strtotime($this->created_start)]);
        }

        if ($this->created_end) {
            $query->andWhere(['<=', self::withDatabaseName('created_at'), strtotime($this->created_end)]);
        }

        $query->addOrderBy([self::withDatabaseName('id') => SORT_DESC]);

        return $dataProvider;
    }

    /**
     * @param ActiveQuery $query
     */
    protected function scenesIndex(ActiveQuery $query)
    {
        $query->with(['customer']);
    }
}