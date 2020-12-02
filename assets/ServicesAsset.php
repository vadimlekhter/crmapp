<?php


namespace app\assets;

use yii\web\AssetBundle;

class ServicesAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/services';
    public $depends = [
        'app\assets\MyMainAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'yii\web\YiiAsset'
    ];
    public $css = [
    ];
    public $js = [
        'js/index.js'
    ];
//    public $jsOptions = ['position' => \yii\web\View::POS_READY];
    public $publishOptions = [
        'forceCopy' => true
    ];
}