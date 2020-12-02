<?php

$config = [
    'id' => 'crmapp-console',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'app\console\controllers',
    'aliases' => [
        '@webroot' => __DIR__ . '/../web',
        '@web' => '/'
    ],
    'components' =>
        [
            'db' => require(__DIR__ . '/db.php'),
            'authManager' => [
                'class' => 'yii\rbac\DbManager',
            ]
        ],
];

return $config;