<?php

namespace api\modules\shop\models;

use api\caches\traits\RefreshModelsCacheTrait;
use api\components\ActiveRecord;
use api\modules\shop\models\query\GoodsQuery;
use common\helpers\BaseHelper;
use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "sd_goods".
 *
 * @property int $id
 * @property string $name 商品全称
 * @property string $short_name 商品简称
 * @property string $number 商品编号
 * @property string $unit 单位
 * @property string $format 规格
 * @property float $stock 库存
 * @property float $purchase_price 进货价
 * @property float $retail_price 零售价
 * @property float $wholesale_price 批发价
 * @property string $img_source 商品展示资源
 * @property string $product_date 生产日期
 * @property string $shelf_life 保质日期
 * @property int $is_del 是否删除（0-否，1-是）
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 */
class Goods extends ActiveRecord
{
    use RefreshModelsCacheTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sd_goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_del', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['short_name'], 'string', 'max' => 64],
            [['number'], 'string', 'max' => 255],
            [['unit', 'format', 'shelf_life', 'product_date'], 'string', 'max' => 15],
            [['img_source'], 'string', 'max' => 1000],
            [['purchase_price', 'retail_price', 'wholesale_price', 'stock'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品全称',
            'short_name' => '商品简称',
            'number' => '商品编号',
            'unit' => '单位',
            'format' => '规格',
            'stock' => '库存',
            'purchase_price' => '进货价',
            'retail_price' => '零售价',
            'wholesale_price' => '批发价',
            'img_source' => '商品展示资源',
            'product_date' => '生产日期',
            'shelf_life' => '保质日期',
            'is_del' => '是否删除（0-否，1-是）',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return GoodsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GoodsQuery(get_called_class());
    }

    /**
     * 图片资源
     * @return array|mixed|null
     */
    public function imgSource()
    {
        $source = [];

        $imgPath = $this->img_source ? Json::decode($this->img_source) : [];
        foreach ($imgPath as $item) {
            $source[] = Yii::$app->params['img']['url'] . $item;
        }

        return $source;
    }

    /**
     * 显示的时候，值整数单位
     * @return int
     */
    public function stockShow()
    {
        return intval($this->stock);
    }
}
