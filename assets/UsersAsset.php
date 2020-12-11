<?php


namespace app\assets;

use yii\web\AssetBundle;

class UsersAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/users';
    public $depends = [
        'app\assets\MyMainAsset'
    ];
    public $css = [
        'css/index.css'
    ];
    public $js = [
        'js/index.js'
    ];
    public $publishOptions = [
        'forceCopy' => true
    ];
}