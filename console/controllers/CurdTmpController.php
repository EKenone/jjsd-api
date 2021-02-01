<?php


namespace console\controllers;


use console\components\crudtmp\CreateCurdTmp;
use console\components\crudtmp\InitCrudTmp;
use yii\console\Controller;

class CurdTmpController extends Controller
{
    /**
     * 初始化模块
     * @param string $moduleName 模块名称  例子：broker
     */
    public function actionInitCrud($moduleName)
    {
        $res = (new InitCrudTmp([
            'moduleName' => $moduleName,
            'basePath' => __DIR__ . '/../../'
        ]))->done();
        echo $res . "\r\n";
    }

    /**
     * 创建crud资源模板
     * @param string $modelClass 例子: \api\modules\broker\models\BrokerTest
     * @param string $baseControllerClass 例子: \api\modules\broker\components\Controller
     */
    public function actionCreate($modelClass, $baseControllerClass)
    {
        $modelClass = '\\' . ltrim($modelClass, '\\') ;
        $baseControllerClass = '\\' . ltrim($baseControllerClass, '\\') ;
        $basePath = __DIR__ . '/../../';
        $lastBackslash = strrpos($modelClass, '\\');
        $namespace = rtrim(substr($modelClass, 0, $lastBackslash), 'models');
        $modelName = trim(substr($modelClass, $lastBackslash), '\\');
        $res = (new CreateCurdTmp([
            'space' => $namespace,
            'modelName' => $modelName,
            'modelClass' => $modelClass,
            'baseController' => $baseControllerClass,
            'basePath' => $basePath
        ]))->done();
        echo $res . "\r\n";
    }
}