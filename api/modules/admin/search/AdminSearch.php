<?php


namespace api\modules\admin\search;


use api\modules\admin\resources\AdminResource;
use common\traits\FormModelValidate;
use common\traits\SearchModelScenesTrait;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class AdminSearch extends AdminResource
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
            [['created_start', 'created_end'], 'dateToTime'],
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
                'or',
                ['like', self::withDatabaseName('username'), $this->keyword],
                ['like', self::withDatabaseName('name'), $this->keyword],
            ]);
        }

        if ($this->created_start) {
            $query->andWhere(['>=', self::withDatabaseName('created_at'), $this->created_start]);
        }

        if ($this->created_end) {
            $query->andWhere(['<=', self::withDatabaseName('created_at'), $this->created_end]);
        }

        $query->addOrderBy(['id'=>SORT_DESC]);

        return $dataProvider;
    }

    /**
     * @param ActiveQuery $query
     */
    public function scenceIndex(ActiveQuery $query)
    {
        $query->with(['role']);
    }
}