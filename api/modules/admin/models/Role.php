<?php

namespace api\modules\admin\models;

use api\components\ActiveRecord;
use api\modules\admin\models\query\RoleQuery;
use Yii;

/**
 * This is the model class for table "sd_admin_role".
 *
 * @property int $id
 * @property string $title 角色名
 * @property string $tag 角色标识
 * @property int $status 状态（1-正常，2-停用）
 * @property int $is_del 是否删除（0-否，1-是）
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 */
class Role extends ActiveRecord
{
    const STATUS_OK = 1;
    const STATUS_FREEZE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sd_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'is_del', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title'], 'string', 'max' => 16],
            [['tag'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '角色名',
            'tag' => '角色标识',
            'status' => '状态（1-正常，2-停用）',
            'is_del' => '是否删除（0-否，1-是）',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return RoleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RoleQuery(get_called_class());
    }

    /**
     * @return string[]
     */
    public static function statusMap()
    {
        return [
            self::STATUS_OK => '正常',
            self::STATUS_FREEZE => '冻结',
        ];
    }
}
