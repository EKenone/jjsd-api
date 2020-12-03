<?php


namespace api\modules\admin\search;


use api\modules\admin\resources\RoleResource;
use common\traits\FormModelValidate;
use common\traits\SearchModelScenesTrait;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class RoleSearch extends RoleResource
{
    use SearchModelScenesTrait, FormModelValidate;

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
            [['created_start', 'created_end'], 'dateToTime'],
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
            $query->andWhere(['like', self::withDatabaseName('title'), $this->keyword],);
        }

        if ($this->created_start) {
            $query->andWhere(['>=', self::withDatabaseName('created_at'), $this->created_start]);
        }

        if ($this->created_end) {
            $query->andWhere(['<=', self::withDatabaseName('created_at'), $this->created_end]);
        }

        if ($this->no_page) {
            $dataProvider->pagination = false;
        }

        $query->addOrderBy(['id'=>SORT_DESC]);

        return $dataProvider;
    }
}