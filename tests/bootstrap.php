<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

Yii::setAlias('@tests', __DIR__);

new \yii\console\Application([
    'id' => 'unit',
    'basePath' => __DIR__,
    'vendorPath' => __DIR__ . '/../vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;port=3306;dbname=test',
            'username' => 'root',
            'password' => '123',
            'charset' => 'utf8',
        ],
        'db2' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;port=3306;dbname=test2',
            'username' => 'root',
            'password' => '123',
            'charset' => 'utf8',
        ],
        'repository' => [
            'class' => 'ericmaicon\repository\Gateway',
            'repositories' => [
                'test' => [
                    'db' => 'db',
                ],
                'test2' => [
                    'db' => 'db2',
                    'tables' => [
                        'comment'
                    ]
                ]
            ]
        ]
    ],
]);
