<?php

namespace api\modules\admin\models;

use api\components\ActiveRecord;
use api\modules\admin\models\query\AdminQuery;
use api\modules\shop\models\Shop;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sd_admin".
 *
 * @property int $id
 * @property int $shop_id 商家ID
 * @property string $name 姓名
 * @property string $username 账号
 * @property string $password 密码
 * @property int $status 状态（1-正常，2-冻结）
 * @property int $is_del 是否删除（1-是，0-否）
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Shop $shop
 * @property AdminRole $adminRole
 * @property Role $role
 *
 */
class Admin extends ActiveRecord
{
    const STATUS_OK = 1;        //正常
    const STATUS_FREEZE = 2;    //冻结

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sd_admin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shop_id', 'status', 'is_del', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['username'], 'string', 'max' => 16],
            [['password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_id' => '商家ID',
            'name' => '姓名',
            'username' => '账号',
            'password' => '密码',
            'status' => '状态（1-正常，2-冻结）',
            'is_del' => '是否删除（1-是，0-否）',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AdminQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AdminQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdminRole()
    {
        return $this->hasMany(AdminRole::class, ['admin_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasMany(Role::class, ['id' => 'role_id'])->via('adminRole');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::class, ['id' => 'shop_id']);
    }

    /**
     * @return array
     */
    public function adminRoleIds()
    {
        return ArrayHelper::getColumn((array)$this->adminRole, 'role_id') ?: [];
    }
}
