<?php


namespace api\modules\shop\search;


use api\modules\shop\resources\CustomerAddressResource;
use common\traits\SearchModelScenesTrait;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class CustomerAddressSearch extends CustomerAddressResource
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
            [['keyword'], 'trim'],
            [['created_start', 'created_end'], 'safe'],
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
                ['like', self::withDatabaseName('consignee'), $this->keyword],
                ['like', self::withDatabaseName('contact_tel'), $this->keyword],
                ['like', self::withDatabaseName('address'), $this->keyword],
            ]);
        }

        if ($this->created_start) {
            $query->andWhere(['>=', self::withDatabaseName('created_at'), strtotime($this->created_start)]);
        }

        if ($this->created_end) {
            $query->andWhere(['<=', self::withDatabaseName('created_at'), strtotime($this->created_end)]);
        }

        $query->addOrderBy([self::withDatabaseName('id')=>SORT_DESC]);

        return $dataProvider;
    }
}