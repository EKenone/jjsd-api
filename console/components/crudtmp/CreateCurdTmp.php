<?php


namespace console\components\crudtmp;


use yii\base\BaseObject;
use yii\db\ActiveRecord;

class CreateCurdTmp extends BaseObject
{
    /**
     * 模块命名空间 例：api\modules\broker
     * @var string
     */
    public $space;

    /**
     * 模型名字  例：BrokerClass
     * @var string
     */
    public $modelName;

    /**
     * 继承的控制器  例：\api\components\Controller
     * @var string
     */
    public $baseController;

    /**
     * 模型类 例：\api\modules\broker\models\BrokerClass
     * @var string
     */
    public $modelClass;

    /**
     * 项目路径   例：/app/cst-group
     * @var string
     */
    public $basePath;

    public function done()
    {

        $model = trim($this->modelClass, '\\');
        $controller = trim($this->baseController, '\\');
        if (!class_exists($model)) {
            return '模型类不存在';
        }

        if (!class_exists($controller)) {
            return '基础控制器类不存在';
        }

        $space = strtr($this->space, '\\', '/');

        $space2 = trim($this->space, '\\');

        $serviceName = $this->modelName . 'Service';
        $serviceClass = $space2 . '\\services\\' . $serviceName;

        $resourceName = $this->modelName . 'Resource';
        $resourceClass = $space2 . '\\resources\\' . $resourceName;

        $formName = $this->modelName . 'Form';
        $formClass = $space2 . '\\forms\\' . $formName;

        $searchName = $this->modelName . 'Search';
        $searchClass = $space2 . '\\search\\' . $searchName;

        $basePath = $this->basePath;

        $controllerPath = $basePath . $space . 'controllers/' . $this->modelName . 'Controller.php';
        $resourcePath = $basePath . $space . 'resources/' . $this->modelName . 'Resource.php';
        $formPath = $basePath . $space . 'forms/' . $this->modelName . 'Form.php';
        $searchPath = $basePath . $space . 'search/' . $this->modelName . 'Search.php';
        $servicePath = $basePath . $space . 'services/' . $serviceName . '.php';

        $createData = [
            [
                'path' => $controllerPath,
                'content' => file_get_contents(__DIR__ . '/tmp/controller.tmp')
            ],
            [
                'path' => $resourcePath,
                'content' => file_get_contents(__DIR__ . '/tmp/resource.tmp')
            ],
            [
                'path' => $formPath,
                'content' => file_get_contents(__DIR__ . '/tmp/form.tmp')
            ],
            [
                'path' => $searchPath,
                'content' => file_get_contents(__DIR__ . '/tmp/search.tmp')
            ],
            [
                'path' => $servicePath,
                'content' => file_get_contents(__DIR__ . '/tmp/service.tmp')
            ],
        ];

        /** @var ActiveRecord $model */
        $model = new $this->modelClass();
        $fields = $model->getAttributes(null, ['id', 'is_del', 'created_at', 'updated_at', 'created_by', 'updated_by']);
        $fieldStr = '';
        foreach ($fields as $field => $val) {
            $fieldStr .= "'$field', ";
        }
        $fieldStr = rtrim($fieldStr, ', ');

        foreach ($createData as $item) {
            $formContent = str_replace('{{BASE_NAMESPACE}}', trim($this->space, '\\'), $item['content']);

            if (strpos($formContent, '{{FIELDS}}') !== false) {
                $formContent = str_replace('{{FIELDS}}', $fieldStr, $formContent);
            }

            if (strpos($formContent, '{{MODEL}}') !== false) {
                $formContent = str_replace('{{MODEL}}', $this->modelClass, $formContent);
            }

            if (strpos($formContent, '{{MODEL_NAME}}') !== false) {
                $formContent = str_replace('{{MODEL_NAME}}', $this->modelName, $formContent);
            }

            if (strpos($formContent, '{{CONTROLLER}}') !== false) {
                $formContent = str_replace('{{CONTROLLER}}', $this->baseController, $formContent);
            }

            if (strpos($formContent, '{{SERVICE}}') !== false) {
                $formContent = str_replace('{{SERVICE}}', $serviceClass, $formContent);
            }

            if (strpos($formContent, '{{SERVICE_NAME}}') !== false) {
                $formContent = str_replace('{{SERVICE_NAME}}', $serviceName, $formContent);
            }

            if (strpos($formContent, '{{RESOURCE}}') !== false) {
                $formContent = str_replace('{{RESOURCE}}', $resourceClass, $formContent);
            }

            if (strpos($formContent, '{{RESOURCE_NAME}}') !== false) {
                $formContent = str_replace('{{RESOURCE_NAME}}', $resourceName, $formContent);
            }

            if (strpos($formContent, '{{FORM}}') !== false) {
                $formContent = str_replace('{{FORM}}', $formClass, $formContent);
            }

            if (strpos($formContent, '{{FORM_NAME}}') !== false) {
                $formContent = str_replace('{{FORM_NAME}}', $formName, $formContent);
            }

            if (strpos($formContent, '{{SEARCH}}') !== false) {
                $formContent = str_replace('{{SEARCH}}', $searchClass, $formContent);
            }

            if (strpos($formContent, '{{SEARCH_NAME}}') !== false) {
                $formContent = str_replace('{{SEARCH_NAME}}', $searchName, $formContent);
            }
            file_put_contents($item['path'], $formContent);
        }
        return 'ok';
    }

}