<?php


namespace api\services;


use api\components\ActiveRecord;
use api\services\interfaces\CurdInterface;
use yii\base\BaseObject;
use yii\base\UserException;
use yii\data\ActiveDataProvider;

abstract class ServiceAbstract extends BaseObject implements CurdInterface
{
    /**
     * @var string 表单类
     */
    public $formClass;

    /**
     * @var string 资源类
     */
    public $resourceClass;

    /**
     * @var string 查询类
     */
    public $searchClass;

    /**
     * 默认所有数组参数带上的基础参数
     * @return array
     */
    protected function baseParams()
    {
        return [];
    }

    /**
     * 合并其他默认数据
     * @param $data
     * @return array
     */
    protected function mergeData($data)
    {
        return array_merge($this->baseParams(), $data);
    }

    /**
     * 通用列表
     * @param array $params
     * @return array|ActiveDataProvider
     * @throws UserException
     */
    public function index($params = [])
    {
        $params = $params ?: \Yii::$app->request->get();
        $search = $this->newSearch();
        $search->scenes = $params['scenes'] ?? ActiveRecord::FIELD_INDEX;
        $search->load($this->mergeData($params), '');
        if (!$search->validate()) {
            \Yii::error($search->getFirstErrors());
            return [];
        }
        return $search->setFieldType($search->scenes)->search();
    }

    /**
     * 通用添加
     * @param array $data
     * @return array|mixed|object|string
     * @throws UserException
     */
    public function store($data = [])
    {
        $data = $data ?: \Yii::$app->request->post();
        /** @var ActiveRecord $form */
        $form = $this->newForm();
        $form->setScenario($form::SCENARIO_STORE);
        $form->load($this->mergeData($data), '');
        if (!$form->save()) {
            \Yii::error($form->getFirstErrors());
        }

        return $form;
    }

    /**
     * 通用的修改
     * @param array $data
     * @return array|mixed
     * @throws UserException
     */
    public function update($data = [])
    {
        $data = $data ?: \Yii::$app->request->post();
        /** @var ActiveRecord $form */
        $form = $this->idForm($data['id']);
        $form->setScenario($form::SCENARIO_UPDATE);
        $form->load($this->mergeData($data), '');
        if (!$form->save()) {
            \Yii::error($form->getFirstErrors());
        }

        return $form;
    }

    /**
     * 通用删除方法
     * @param array $data
     * @return array|mixed
     * @throws UserException
     */
    public function destroy($data = [])
    {
        $data = $data ?: \Yii::$app->request->post();
        $id = $data['id'];
        /** @var ActiveRecord $form */
        if (is_array($id)) {
            $form = $this->newForm();
        } else {
            $form = $this->idForm($id);
        }

        $form->setScenario($form::SCENARIO_DESTROY);
        $form->load($this->mergeData($data), '');
        if (!$form->destroy()) {
            \Yii::error($form->getFirstErrors());
        }

        return $form;
    }

    /**
     * 单体数据
     * @param int $id
     * @return mixed
     * @throws UserException
     */
    public function show($id)
    {
        $id = $id ?: \Yii::$app->request->get('id');
        $info = ($this->newResource())::find()
            ->andWhere(['id' => $id])
            ->one();
        if (!$info) {
            throw new UserException('数据不存在');
        }

        return $info->setFieldType(ActiveRecord::FIELD_SHOW);
    }

    /**
     * 统一的数据验证
     * @param array $data
     * @param null $scenes
     * @return mixed
     * @throws UserException
     */
    public function formValidate($data = [], $scenes = null)
    {
        /** @var ActiveRecord $form */
        $form = $this->newForm();
        $form->setScenario($scenes ?: $form::SCENARIO_DEFAULT);
        $form->load($this->mergeData($data), '');// 这里也可以替换成setAttributes()方法的, 只是觉得load的字母比较少
        if (!$form->validate()) {
            \Yii::error($form->getFirstErrors());
        }

        return $form;
    }

    /**
     * 实例化表单类
     * @return mixed
     * @throws UserException
     */
    public function newForm()
    {
        return self::newClass($this->formClass);
    }

    /**
     * 实例化资源类
     * @return mixed
     * @throws UserException
     */
    public function newResource()
    {
        return self::newClass($this->resourceClass);
    }

    /**
     * 实例化搜索类
     * @return mixed
     * @throws UserException
     */
    public function newSearch()
    {
        return self::newClass($this->searchClass);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws UserException
     */
    public function idForm($id = 0)
    {
        $form = $this->newForm();
        $info = $form::findOne($id ?: $form->id);
        if (!$info) {
            throw new UserException('数据不存在');
        }
        return $info;
    }

    /**
     * @param $class
     * @return mixed
     * @throws UserException
     */
    final private static function newClass($class)
    {
        if (!class_exists($class)) {
            throw new UserException('表单类不存在');
        }

        return new $class;// 这里可以替换成\Yii::createObject这样多次使用的时候性能应该有一丢丢提升，如果只有单次使用的话就浪费了
    }
}