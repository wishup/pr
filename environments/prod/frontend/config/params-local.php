<?php
$connection = new \yii\db\Connection([
    'dsn' => 'mysql:host=localhost;dbname=biblebeeorg',
    'username' => 'biblebeeorg',
    'password' => 'jbNr4Bwd35IbJbDc90MiJ2GptE',
]);
$connection->open();
$options = $connection->createCommand('SELECT * FROM settings')->queryAll();
$connection->close();

return [
    'settings' => $options ? $options[0] : [],
];
