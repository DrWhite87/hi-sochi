<?php

namespace app\components\extentions\imperavi\models;

use yii\base\Model;

/**
 * Class Upload
 * @package app\components\extentions\imperavi\models
 *
 * @property \yii\web\UploadedFile|null $file Uploaded file
 */
class Upload extends Model
{
    /**
     * @var \yii\web\UploadedFile|null $file Uploaded file
     */
    public $file;
}
