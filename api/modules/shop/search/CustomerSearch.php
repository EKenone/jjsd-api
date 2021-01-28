<?php


namespace api\modules\shop\search;


use api\modules\shop\resources\CustomerResource;
use common\traits\SearchModelScenesTrait;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class CustomerSearch extends CustomerResource
{
    use SearchModelScenesTrait;

    public $keyword;
    public $created_start;
    public $created_end;
    public $no_page;

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [['keyword'], 'trim'],
            [['no_page'], 'in', 'range' => [0, 1]],
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
            self::withDatabaseName('shop_id') => $this->shop_id
        ]);

        if ($this->keyword) {
            $query->andWhere([
                'OR',
                ['like', self::withDatabaseName('name'), $this->keyword],
                ['like', self::withDatabaseName('phone'), $this->keyword],
                ['like', self::withDatabaseName('loc_number'), $this->keyword],
            ]);
        }

        if ($this->created_start) {
            $query->andWhere(['>=', self::withDatabaseName('created_at'), strtotime($this->created_start)]);
        }

        if ($this->created_end) {
            $query->andWhere(['<=', self::withDatabaseName('created_at'), strtotime($this->created_end)]);
        }

        if ($this->no_page) {
            $dataProvider->pagination = false;
        }

        $query->addOrderBy([self::withDatabaseName('id')=>SORT_DESC]);

        return $dataProvider;
    }
}