<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=60.205.214.51;dbname=kaoben',
            'username' => 'kaoben',
            'password' => 'kaoben@#$123',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
