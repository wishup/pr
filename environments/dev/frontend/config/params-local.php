<?php
$connection = new \yii\db\Connection([
    'dsn' => 'mysql:host=localhost;dbname=dev2016',
    'username' => 'dev2016',
    'password' => 'vIYncC4I8tbkWyVUSLJ9x',
]);
$connection->open();
$options = $connection->createCommand('SELECT * FROM settings')->queryAll();
$connection->close();

return [
    'settings' => $options ? $options[0] : [],
];
