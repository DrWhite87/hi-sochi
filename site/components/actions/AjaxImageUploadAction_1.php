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
    protected $uploadPath;
    protected $rename = true;
    protected $webPath;

    public function run() {        
        if (!empty($_FILES['file']['name'])) {
            $controller = $this->controller;
            //$this->rename = (bool) Yii::$app->getRequest()->getQuery('rename', true);
            $this->webPath = '/' . Yii::$app->params['tmpImageUploadPath'] . '/' . date('dmY') . '/';
            $this->uploadPath = Yii::getAlias('@webroot') . $this->webPath;

            if (!is_dir($this->uploadPath)) {
                if (!@mkdir($this->uploadPath)) {
                    Yii::$app->ajax->rawText(Yii::t('app', 'Can\'t create catalog "{dir}" for files!', array('{dir}' => $this->uploadPath)));
                }
            }

            //$controller->disableProfilers();

            $this->uploadedFile = UploadedFile::getInstanceByName('file');
            $this->fileLink = $this->fileName = null;

            if($this->uploadFile()){
                $image = new TmpImage();
                $image->name = $this->fileName;
                $image->type = $this->uploadedFile->type;
                $image->ext = $this->uploadedFile->extension;
                $image->size = $this->uploadedFile->size;              
                $image->module = $controller->module->id;
                
                try{
                    $image->save();
                } catch (Exception $ex) {
                    print_r($ex);
                }
            }           

            if ($this->fileLink !== null && $this->fileName !== null) {
                 Yii::$app->ajax->rawText(
                        json_encode(array('filelink' => $this->fileLink, 'filename' => $this->fileName, 'id' => $image->id))
                );
            }
        }

         Yii::$app->ajax->rawText(Yii::t('app', 'There is an error when downloading!'));
    }

    protected function uploadFile() {
        if ($this->uploadedFile) {
            //сгенерировать имя файла и сохранить его
            $newFileName = $this->rename ? md5(time() . uniqid() . $this->uploadedFile->name) . '.' . $this->uploadedFile->extension : $this->uploadedFile->name;
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
