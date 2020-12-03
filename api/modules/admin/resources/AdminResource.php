<?php


namespace api\modules\admin\resources;


use api\modules\admin\models\Admin;
use yii\helpers\ArrayHelper;

class AdminResource extends Admin
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
            'username' => function () {
                return $this->username;
            },
            'name' => function () {
                return $this->name;
            },
            'status' => function () {
                return $this->status;
            },
            'created_date' => function () {
                return date('Y-m-d H:i', $this->created_at);
            },
            'role_id' => function () {
                return ArrayHelper::getColumn($this->adminRole ? : [], 'role_id', []);
            },
            'role_name' => function () {
                return ArrayHelper::getColumn($this->role ? : [], 'title', []);
            }
        ];
    }

    /**
     * @return \Closure[]
     */
    public function fieldShow()
    {
        return [
            'id' => function () {
                return $this->id;
            },
            'username' => function () {
                return $this->username;
            },
            'name' => function () {
                return $this->name;
            },
            'created_date' => function () {
                return date('Y-m-d H:i', $this->created_at);
            }
        ];
    }
}