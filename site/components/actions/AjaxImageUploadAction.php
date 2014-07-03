<?php

namespace app\components\actions;

use Yii,
    yii\base\Action,
    yii\web\UploadedFile,
    app\models\TmpImage;

class AjaxImageUploadAction extends Action {

    protected $fileLink = null;
    protected $fileName = null;
    protected $uploadedFile = null;
    public $uploadPath = null;
    protected $rename = true;
    public $webPath;

    public function run() {   
        
        if (!empty($_FILES['file'])) {
            $controller = $this->controller;
            //$this->rename = (bool) Yii::$app->getRequest()->getQuery('rename', true);
            if(empty($this->uploadPath)){
                $this->webPath = '/' . Yii::$app->params['tmpImageUploadPath'] . '/' . date('dmY') . '/';
                $this->uploadPath = Yii::getAlias('@webroot') . $this->webPath;
            }
            //print_r($this->uploadPath); die;
            if (!is_dir($this->uploadPath)) {
                if (!@mkdir($this->uploadPath)) {
                    Yii::$app->ajax->rawText(Yii::t('app', 'Can\'t create catalog "{dir}" for files!', array('{dir}' => $this->uploadPath)));
                }
            }

            $this->uploadedFile = UploadedFile::getInstanceByName('file');
            
            $this->uploadFile();
             
            if ($this->fileLink !== null && $this->fileName !== null) {
                 Yii::$app->ajax->rawText(
                        json_encode(array('filelink' => $this->fileLink, 'filename' => $this->fileName))
                );
            }
        }

         Yii::$app->ajax->rawText(Yii::t('app', 'There is an error when downloading!'));
    }

    protected function uploadFile() {
        if ($this->uploadedFile) {
            //сгенерировать имя файла и сохранить его
            $newFileName = $this->rename ? md5(time() . uniqid() . $this->uploadedFile->name) . '.' . $this->uploadedFile->extension : $this->uploadedFile->name;

            if (!$this->uploadedFile->saveAs($this->uploadPath . $newFileName)) {
                 Yii::$app->ajax->rawText(Yii::t('app', 'There is an error when downloading!'));
            }

            $this->fileLink = Yii::getAlias('@web') . $this->webPath . $newFileName;
            $this->fileName = $newFileName;

            return true;
        }
        return false;
    }

}
