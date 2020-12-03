<?php


namespace api\components;


use api\caches\interfaces\CacheInterface;
use yii\data\DataProviderInterface;

class Serializer extends \yii\rest\Serializer
{
    /**
     * @param mixed $data
     * @return array|mixed
     */
    public function serialize($data)
    {
        if ($data instanceof DataProviderInterface) {
            return $this->serializeList($data);
        }

        if ($data instanceof ListProvider) {
            $list = $this->serializeList($data->list);
            return parent::serialize(array_merge($list, $data->expend));
        }

        if ($data instanceof CacheInterface) {
            $cacheData = $data->getData();
            if ($cacheData instanceof DataProviderInterface) {
                $cacheData = $data->setData($this->serializeList($cacheData));
            }
            return parent::serialize($cacheData);
        }

        return parent::serialize($data);
    }

    /**
     * @param DataProviderInterface $data
     * @return array
     */
    protected function serializeList($data)
    {
        $listData['list'] = parent::serialize($data);
        if ($data->getPagination()) {
            $listData['page'] = [
                'total_count' => $data->getPagination()->totalCount,
                'total_page' => $data->getPagination()->getPageCount(),
                'current_page' => $data->getPagination()->getPage() + 1,
                'page_size' => $data->getPagination()->getPageSize(),
            ];
        }
        return $listData;
    }
}