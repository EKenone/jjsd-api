<?php


namespace api\modules\admin\resources;


use api\modules\admin\models\Role;
use yii\helpers\ArrayHelper;

class RoleResource extends Role
{
    /**
     * @return \Closure[]
     */
    public function fieldIndex()
    {
        return [
            'id' => function () {
                return $this->id;
            },
            'title' => function () {
                return $this->title;
            },
            'tag' => function () {
                return $this->tag;
            },
            'status' => function () {
                return $this->status;
            },
            'status_title' => function () {
                return ArrayHelper::getValue(self::statusMap(), $this->status, '');
            },
            'created_date' => function () {
                return date('Y-m-d H:i', $this->created_at);
            }
        ];
    }
}