<?php


namespace console\components\crudtmp;


use yii\base\BaseObject;
use yii\helpers\FileHelper;

class InitCrudTmp extends BaseObject
{
    public $moduleName;

    public $basePath;

    public function done()
    {
        $path = $this->basePath. 'api/modules/';
        $moduleDir = $path.$this->moduleName;

        $componentsDir = $moduleDir .'/components';

        $formsDir = $moduleDir .'/forms';


        $controllersDir = $moduleDir .'/controllers';
        $searchDir = $moduleDir .'/search';
        $resourcesDir = $moduleDir .'/resources';
        $servicesDir = $moduleDir .'/services';

        $modelsDir = $moduleDir .'/models';

        $dirs = [
            $moduleDir,
            $componentsDir,
            $formsDir,
            $controllersDir,
            $searchDir,
            $resourcesDir,
            $servicesDir,
            $modelsDir
        ];

        foreach ($dirs as $dir){
            self::createDir($dir);
        }

        $moduleFile = $moduleDir.'/Module.php';
        $servicesFile = $servicesDir .'/Service.php';
        $componentsFile = $componentsDir.'/Controller.php';

        if (!is_file($moduleFile)) {
            $content = file_get_contents(__DIR__ . '/tmp/module.tmp');
            $content = str_replace('{{MODULE_NAME}}', $this->moduleName, $content);
            file_put_contents($moduleFile, $content);
        }

        if (!is_file($servicesFile)){
            $content = file_get_contents(__DIR__ . '/tmp/baseService.tmp');
            $content = str_replace('{{MODULE_NAME}}', $this->moduleName, $content);
            file_put_contents($servicesFile, $content);
        }

        if (!is_file($componentsFile)){
            $content = file_get_contents(__DIR__ . '/tmp/baseController.tmp');
            $content = str_replace('{{MODULE_NAME}}', $this->moduleName, $content);
            file_put_contents($componentsFile, $content);
        }

        return 'ok';
    }

    private static function createDir($dir)
    {
        if (!is_dir($dir)) {
            FileHelper::createDirectory($dir);
        }
    }

}