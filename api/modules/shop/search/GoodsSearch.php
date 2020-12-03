<?php


namespace api\modules\shop\search;


use api\modules\shop\resources\GoodsResource;
use common\traits\SearchModelScenesTrait;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class GoodsSearch extends GoodsResource
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

        if ($this->keyword) {
            $query->andWhere([
                'OR',
                ['like', self::withDatabaseName('name'), $this->keyword],
                ['like', self::withDatabaseName('short_name'), $this->keyword],
                ['like', self::withDatabaseName('number'), $this->keyword],
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

    /**
     * @param ActiveQuery $query
     */
    protected function scenesSelect(ActiveQuery $query)
    {
        $this->no_page = 1;
        $query->limit(200);
    }
}