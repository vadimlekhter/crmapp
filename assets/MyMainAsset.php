<?php


namespace app\assets;


use yii\web\AssetBundle;

class MyMainAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/main';
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\web\YiiAsset'
    ];
    public $css = [
        'css/main.css'
    ];
    public $js = [
    ];
//    public $jsOptions = ['position' => \yii\web\View::POS_READY];
    public $publishOptions = [
        'forceCopy' => true
    ];
}