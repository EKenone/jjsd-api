<?php


namespace api\services;


use yii\base\DynamicModel;
use yii\base\UserException;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadService extends ServiceAbstract
{
    /**
     * 上传图片
     * @param $data
     * @return string[]|DynamicModel
     * @throws UserException
     * @throws \yii\base\Exception
     */
    public function uploadImg($data)
    {
        $form = new DynamicModel(['file', 'box']);
        $form->addRule(['file'], 'file', ['skipOnEmpty' => false, 'maxSize' => 1024 * 1024 * 30])
            ->addRule(['file', 'box'], 'required')
            ->addRule(['box'], 'in', ['range' => ['goods']]);


        $form->file = UploadedFile::getInstanceByName('file');

        $form->load($data, '');
        if (!$form->validate()) {
            return $form;
        }

        $filename = date('YmdHis') . rand(1000, 9999) . '.jpg';
        $dir = \Yii::$app->params['img']['path'] . $form->box . '/';

        if (!FileHelper::createDirectory($dir)) {
            throw new UserException('上传失败');
        }

        $form->file->saveAs($dir . $filename);

        return ['url' => \Yii::$app->params['img']['url'] . $form->box. '/' .$filename];
    }
}