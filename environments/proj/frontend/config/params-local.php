<?php
$connection = new \yii\db\Connection([
    'dsn' => 'mysql:host=localhost;dbname=project',
    'username' => 'root',
    'password' => '',
]);
$connection->open();
$options = $connection->createCommand('SELECT * FROM settings')->queryAll();
$connection->close();


return [
    'settings' => $options ? $options[0] : [],
];
