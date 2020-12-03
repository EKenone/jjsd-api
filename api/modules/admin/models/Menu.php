<?php

namespace api\modules\admin\models;

use api\components\ActiveRecord;
use api\modules\admin\models\query\MenuQuery;
use Yii;

/**
 * This is the model class for table "sd_menu".
 *
 * @property int $id
 * @property string $title 菜单名称
 * @property string $path 菜单路径
 * @property string $icon 菜单图标
 * @property int $lv 菜单等级
 * @property int $pid 上级ID
 * @property int $sort 排序（越大越前）
 * @property int $is_del 是否删除（0-否，1-是）
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Menu $parentMenu
 *
 */
class Menu extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sd_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lv', 'pid', 'sort', 'is_del', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title'], 'string', 'max' => 16],
            [['path', 'icon'], 'string', 'max' => 255],
            [['icon'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '菜单名称',
            'path' => '菜单路径',
            'icon' => '菜单图标',
            'lv' => '菜单等级',
            'pid' => '上级ID',
            'sort' => '排序（越大越前）',
            'is_del' => '是否删除（0-否，1-是）',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MenuQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentMenu()
    {
        return $this->hasOne(self::class, ['id' => 'pid']);
    }
}
