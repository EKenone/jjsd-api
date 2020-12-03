<?php


namespace api\esmodels;


use api\components\EsActiveRecord;

/**
 * Class OperateLog
 * @package api\esmodels
 *
 * @property mixed $operation_id
 * @property mixed $operation_name
 * @property mixed $request_data
 * @property mixed $request_time
 * @property mixed $response_data
 * @property mixed $response_time
 * @property mixed $uri
 * @property mixed $token
 * @property mixed $ip
 * @property mixed $user_ip
 *
 */
class OperateLog extends EsActiveRecord
{

    public function attributes()
    {
        return ['operation_id', 'operation_name', 'request_data', 'response_data', 'uri', 'request_time', 'response_time', 'token', 'ip', 'user_ip'];
    }

    public static function mapping()
    {
        return [
            'properties' => [
                'operation_id' => ['type' => 'integer'],
                'operation_name' => ['type' => 'keyword'],
                'request_data' => ['type' => 'text', 'analyzer' => "ik_max_word"],
                'request_time' => ['type' => 'date', 'format' => "yyyy-MM-dd"],
                'response_data' => ['type' => 'text', 'analyzer' => "ik_max_word"],
                'response_time' => ['type' => 'date', 'format' => "yyyy-MM-dd"],
                'uri' => ['type' => 'keyword'],
                'token' => ['type' => 'keyword'],
                'ip' => ['type' => 'keyword'],
            ]
        ];
    }

    /**
     * Set (update) mappings for this model
     */
    public static function updateMapping()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->setMapping(static::index(), static::type(), static::mapping());
    }

    /**
     * Create this model's index
     */
    public static function createIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->createIndex(static::index(), [
            //'aliases' => [ /* ... */ ],
            'mappings' => static::mapping(),
            //'settings' => [ /* ... */ ],
        ]);
    }

    /**
     * Delete this model's index
     */
    public static function deleteIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->deleteIndex(static::index());
    }
}