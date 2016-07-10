<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '123456',
    'charset' => 'utf8',
    'on afterOpen' => function($event){
        $event->sender->createCommand("SET time_zone = '+00:00'")->execute();
    }
];
