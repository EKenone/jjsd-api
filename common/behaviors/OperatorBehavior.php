<?php
/**
 * User: ShawnPanda
 * Date: 2018/03/24
 * Time: 11:00
 */

namespace common\behaviors;

use api\resources\User;
use common\models\center\AdminUser;
use yii\base\InvalidCallException;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;
use yii\helpers\ArrayHelper;

class OperatorBehavior extends AttributeBehavior
{
    /**
     * @var string the attribute that will receive operator value
     */
    public $createdAtAttribute = 'created_by';

    /**
     * @var string the attribute that will receive operator value.
     */
    public $updatedAtAttribute = 'updated_by';
    /**
     * @inheritdoc
     *
     * In case, when the value is `null`, the result of the PHP function [time()](http://php.net/manual/en/function.time.php)
     * will be used as value.
     */
    public $value;


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->createdAtAttribute, $this->updatedAtAttribute],
                BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->updatedAtAttribute,
            ];
        }
    }

    /**
     * @inheritdoc
     *
     * In case, when the [[value]] is `null`, the result of the PHP function [time()](http://php.net/manual/en/function.time.php)
     * will be used as value.
     */
    protected function getValue($event)
    {
        try {
            if ($this->value === null && \Yii::$app->hasProperty('user') && \Yii::$app->user->identity && \Yii::$app->user->getIdentity() instanceof User) {
                $admin = \Yii::$app->user->getIdentity();
                return ArrayHelper::getValue($admin, 'id', 0);
            }
        } catch (\Exception $e) {
            return 0;
        }
        return 0;
    }

    /**
     * Updates a operator attribute to the current operator.
     *
     * ```php
     * $model->touch('lastVisit');
     * ```
     * @param string $attribute the name of the attribute to update.
     * @throws InvalidCallException if owner is a new record (since version 2.0.6).
     */
    public function touch($attribute)
    {
        /* @var $owner BaseActiveRecord */
        $owner = $this->owner;
        if ($owner->getIsNewRecord()) {
            throw new InvalidCallException('Updating the operator is not possible on a new record.');
        }
        $owner->updateAttributes(array_fill_keys((array) $attribute, $this->getValue(null)));
    }
}
