<?php


namespace api\modules\shop\forms;


use api\modules\shop\models\Goods;
use common\traits\FormModelValidate;
use yii\helpers\Json;

class GoodsForm extends Goods
{
    use FormModelValidate;

    const DEDUCT_STOCK = 'deduct_stock';
    const ADD_STOCK = 'add_stock';

    /**
     * 分类数组
     * @var array
     */
    public $category;

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [['id', 'name', 'unit', 'short_name', 'format', 'shop_id'], 'required'],
            [['purchase_price', 'retail_price', 'wholesale_price'], 'number'],
            [['stock'], 'number', 'min' => -1],
            [['product_date', 'shelf_life', 'number'], 'string'],
            [['img_source'], $this->validateMethod(), 'skipOnEmpty' => false],
            [['category'], 'default', 'value' => []],
        ];
    }

    /**
     * @return array|array[]|\string[][]
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_STORE => ['shop_id', 'name', 'number', 'unit', 'short_name', 'purchase_price', 'retail_price', 'wholesale_price', 'img_source', 'stock', 'format', 'product_date', 'shelf_life', 'category'],
            self::SCENARIO_UPDATE => ['id', 'name', 'number', 'unit', 'short_name', 'purchase_price', 'retail_price', 'wholesale_price', 'img_source', 'stock', 'format', 'product_date', 'shelf_life', 'category'],
            self::SCENARIO_DESTROY => ['id'],
            self::DEDUCT_STOCK => ['id', 'stock'],
            self::ADD_STOCK => ['id', 'stock'],
        ];
    }

    /**
     *
     */
    public function validateImgSource()
    {
        if ($this->img_source && is_array($this->img_source)) {
            $source = [];
            foreach ($this->img_source as $item) {
                $source[] = ltrim(parse_url($item, PHP_URL_PATH), '/');
            }
            $this->img_source = Json::encode($source);
        } else {
            $this->img_source = '';
        }

    }

    /**
     * 删除
     * @return bool
     */
    public function destroy()
    {
        $this->is_del = self::IS_DEL_YES;
        return $this->save();
    }
}