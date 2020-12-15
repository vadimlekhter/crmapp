<?php

use \app\modules\formatters\FormattersModule;
use \app\services\EmailService;
use \app\services\ServiceService;
use \app\services\NotificationService;
use \app\modules\api\ApiModule;
use \yii\log\FileTarget;
use \yii\log\DbTarget;

$params = require('params.php');

$config = [
    'id' => 'crmapp',
    'bootstrap' => ['log'],
    'basePath' => realpath(__DIR__ . '/../'),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@cept' => '@vendor/bin/codecept',
        '@layout_path' => __DIR__ . '/../' . 'views/layouts',
    ],
    'vendorPath' => dirname('/../' . __DIR__) . '/vendor',
//    'layout' => '@layout_path/main_new.php',
    'components' => [
//        'assetManager' => [
//            'bundles' => [
//                'yii\web\JqueryAsset' => [
//                    'sourcePath' => null,   // do not publish the bundle
//                    'js' => [
//                        'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js',
//                    ]
//                ],
//            ],
//        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest']
        ],
        'request' => [
            'cookieValidationKey' => 'hdk4ks8jvmng7slkl5bndskj',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
//            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/service'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/customer'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/full-customer'],
//                '<controller:[\w-]+>s' => '<controller>/index',
//                '<controller:[\w-]+>/<id:\d+>' => '<controller>/view',
//                '<controller:[\w-]+>/update/<id:\d+>' => '<controller>/update',
//                '<controller:[\w-]+>/delete/<id:\d+>' => '<controller>/delete',
            ],
        ],
        'view' => [
            'renderers' => [
                'md' => [
                    'class' => 'app\utilities\MarkdownRenderer'
                ]
            ],
//            'theme' => [
//                'class' => yii\base\Theme::class,
//                'basePath' => '@app/themes/snow'
//            ]
        ],
        'response' => [
            'formatters' => [
                'yaml' => 'app\utilities\YamlResponseFormatter'
            ]
        ],
        'user' => [
            'identityClass' => 'app\models\user\UserRecord'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
//                [
//                    'class' => \yii\log\EmailTarget::class,
//                    'categories' => ['login'],
////                    'levels' => ['info', 'trace', 'warning', 'error'],
//                    'message' => [
//                        'to' => 'v_lehter@mail.ru'
//                    ]
//                ],
                [
                    'class' => FileTarget::class,
                    'levels' => ['error'],
                    'logVars' => []
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['create_user'],
                    'logFile' => '@runtime/logs/create_user.log',
                    'logVars' => []
                ],
                [
                    'class' => DbTarget::class,
                    'categories' => ['login'],
                    'logVars' => []
                ],
            ],
        ],
        'mailer' => [
            'class' => yii\swiftmailer\Mailer::class,
            'messageConfig' => [
                'from' => $params ['senderEmail'],
            ],
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'vadimlekhter@yandex.ru',
                'password' => 'k6y7v2q8',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
        'emailService' => [
            'class' => EmailService::class
        ],
        'notificationService' => [
            'class' => NotificationService::class,
        ],
        'serviceService' => [
            'class' => ServiceService::class,
//            'on ' . ServiceService::EVENT_NEW_SERVICE => function (NewServiceEvent $e) {
//                Yii::$app->notificationService->sendNewAddServiceEmail($e);
//            }
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
        'formatters' => [
            'class' => FormattersModule::class,
            'basePath' => '@app',
            'viewPath' => '@app/modules/formatters/views'
        ],
        'api' => [
            'class' => ApiModule::class,
            'basePath' => '@app',
            'viewPath' => '@app/modules/api/views'
        ]
    ],
    'params' => $params,
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['*']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['*']
    ];
}

return $config;