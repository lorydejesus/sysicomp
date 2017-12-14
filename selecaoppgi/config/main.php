<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-selecaoppgi',
    'basePath' => dirname(__DIR__),
    'sourceLanguage' => 'pt-Br',
    'language' => 'pt-Br',
    //'timeZone' => 'America/Manaus',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'selecaoppgi\controllers',
    'components' => [
        'session' => [
            'name' => 'PHPFRONTENDSESSID',
            'savePath' => sys_get_temp_dir(),
        ],
		'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
			'identityCookie' => [
                'name' => '_frontendUser', // unique for backend
            ]
        ],

        'view' => [
             'theme' => [
                 'pathMap' => [
                    //'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app/'
                    '@app/views' => '@selecaoppgi/views/adminLTE/yiisoft/yii2-app/'
                 ],
             ],
        ],


        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
