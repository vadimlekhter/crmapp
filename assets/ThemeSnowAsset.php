<?php


namespace app\assets;


use yii\web\AssetBundle;

class ThemeSnowAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/snow';

    public $depends = [
        'app\assets\MyMainAsset'
    ];

    public $css = [
        'css/snow.css'
    ];
    public $publishOptions = [
        'forceCopy' => true
    ];
}