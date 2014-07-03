<?php

namespace app\components\behaviors;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use \app\components\image\Image;


class UploadImagesBehavior extends Behavior {

    public $bigImage = [
        'maxWidth'  => '800',
        'maxHeight' => null,
    ];
    public $mediumImage = [
        'employ'    => true,
        'maxWidth'  => '400',
        'maxHeight' => null,
    ];
    public $smallImage = [
        'employ'    => true,
        'maxWidth'  => '200',
        'maxHeight' => null,
    ];

    public $attributes = [
        'image'
    ];

    public $path;

    public $imageModel;
    public $imageModelRelationKey;
    
    private $imageArr = array();

    public function events() {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'upload',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'upload',
            ActiveRecord::EVENT_AFTER_INSERT => 'addID',
        ];
    }

    public function upload($event) {

        foreach ($this->attributes as $key => $item) {
            if (isset($_FILES[ucfirst(Yii::$app->controller->module->id)]['name'][$item]) && !empty($_FILES[ucfirst(Yii::$app->controller->module->id)]['name'][$item])) {
                $error = false;

                //создаем дериктории
                if (!is_dir($this->path)) {
                    if (!@mkdir($this->path)) {
                        throw new Exception('Невозможно создать дерикторию!');
                    }
                }
                if (!is_dir($this->path . '/medium/')) {
                    if (!@mkdir($this->path . '/medium/')) {
                        throw new Exception('Невозможно создать дерикторию!');
                    }
                }
                if (!is_dir($this->path . '/small/')) {
                    if (!@mkdir($this->path . '/small/')) {
                        throw new Exception('Невозможно создать дерикторию!');
                    }
                }

                $uploadImage = null;
                $uploadImage = UploadedFile::getInstance($this->owner, $item);

                if($oldImg = call_user_func($this->imageModel . "::findOne" , $this->owner->{$key})){
                    unlink($this->path . '/' . $oldImg->name);
                    unlink($this->path . '/medium/' . $oldImg->name);
                    unlink($this->path . '/small/' . $oldImg->name);
                    if($oldImg->delete()){
                        $this->owner->{$key} = 0;
                    }
                }

                $model          = new $this->imageModel;
                $model->name    = md5(time() . uniqid() . $uploadImage->name) . '.' . $uploadImage->extension;
                $model->size    = $uploadImage->size;
                $model->type    = $uploadImage->type;
                $model->{$this->imageModelRelationKey} = $this->owner->id;
                $model->module = Yii::$app->controller->module->id;
                // big image
                $image = Image::make($uploadImage->tempName);
                $image->resize($this->bigImage['maxWidth'], $this->bigImage['maxWidth'], true);
                if (!$image->save($this->path . $model->name))
                    $error = true;
                // medium image
                if ($this->mediumImage['employ']) {
                    $image = Image::make($uploadImage->tempName);
                    $image->resize($this->mediumImage['maxWidth'], $this->mediumImage['maxWidth'], true);
                    if (!$image->save($this->path . '/medium/' . $model->name))
                        $error = true;
                }
                // small image
                if ($this->smallImage['employ']) {
                    $image = Image::make($uploadImage->tempName);
                    $image->resize($this->smallImage['maxWidth'], $this->smallImage['maxWidth'], true);
                    if (!$image->save($this->path . '/small/' . $model->name))
                        $error = true;
                }

                if (!$error) {
                    try{
                        $model->save();
                        $this->owner->{$key} = $this->imageArr[] = $model->id;
                    } catch (yii\base\ErrorException $ex) {
                        print_r($ex);
                    }
                    
                    //print_r($model->errors); die;
                }

            }
        }
    }
    
    public function addID($event){
        foreach ($this->imageArr as $id){
            $model = call_user_func($this->imageModel . "::findOne" , $id);
            $model->{$this->imageModelRelationKey} = $this->owner->id;
            $model->save();
        }
        
    }
}
