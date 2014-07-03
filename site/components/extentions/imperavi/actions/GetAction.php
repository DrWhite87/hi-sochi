<?php

namespace app\components\extentions\imperavi\actions;

use Yii;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\web\Response;
use app\components\extentions\imperavi\helpers\FileHelper;

/**
 * GetAction returns a JSON array of the files found under the specified directory and subdirectories.
 * This array can be used in Imperavi Redactor to insert some files that have already been uploaded.
 */
class GetAction extends Action
{
    /**
     * @var string Files directory
     */
    public $path;

    /**
     * @var string Files directory URL
     */
    public $url;

    /**
     * [\yii\helpers\FileHelper::findFiles()|FileHelper::findFiles()] options argument.
     * @var array Options
     */
    public $options = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->url === null) {
            throw new InvalidConfigException('The "url" attribute must be set.');
        } else {
            $this->options['url'] = $this->url;
        }
        if ($this->path === null) {
            throw new InvalidConfigException('The "path" attribute must be set.');
        } else {
            $this->path = FileHelper::normalizePath($this->path);
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return FileHelper::findFiles($this->path, $this->options);
    }
}
