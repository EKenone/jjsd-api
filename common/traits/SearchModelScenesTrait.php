<?php


namespace common\traits;


use common\helpers\BaseHelper;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

trait SearchModelScenesTrait
{
    public $scenes; // 场景值

    /**
     * 场景值字符
     * @return string
     */
    public function scenesProperty(): string
    {
        return 'scenes';
    }

    /**
     * 基础查询
     * @return ActiveQuery
     */
    protected function baseQuery(): ActiveQuery
    {
        return self::find();
    }

    /**
     * 通用查询
     * @param ActiveQuery $query
     * @return ActiveDataProvider
     */
   abstract protected function commonSearch(ActiveQuery $query): ActiveDataProvider;

    /**
     * 场景特有的sql组装
     * @param ActiveQuery $query
     */
    final protected function scenesQuery(ActiveQuery $query): void
    {
        $method = 'scenes'.BaseHelper::convertUnderline($this->scenes, true);
        if ( method_exists($this, $method) ) {
            call_user_func_array([$this, $method], [$query]);
        }
    }

    /**
     * 通用查询方法
     * @return ActiveDataProvider
     */
    final public function search()
    {
         $query = $this->baseQuery();
         $this->scenesQuery($query);
         return $this->commonSearch($query);
    }
}