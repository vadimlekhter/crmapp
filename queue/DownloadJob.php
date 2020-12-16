<?php


namespace app\queue;


use yii\queue\Queue;

class DownloadJob extends \yii\base\BaseObject implements \yii\queue\JobInterface
{
    public $url;
    public $file;


    public function execute($queue)
    {
        file_put_contents($this->file, file_get_contents($this->url));
    }
}