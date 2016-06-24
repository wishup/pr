<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '1033244023420868',
                    'clientSecret' => '4d3ca74ed90a5c80a026dbf3106a0f1a',
                    'scope' => ["public_profile"],
                    'attributeNames' => ['name', 'first_name', 'last_name', 'email', 'picture']
                ],
                'google' => [
                    'class' => 'yii\authclient\clients\GoogleOAuth',
                    'clientId' => '635154890518-f6jiirddejhduj7is6ua82fqnilvadoa.apps.googleusercontent.com',
                    'clientSecret' => '71d2lO4H87wO-Ri-2KgvPAN-',
                ],
            ],
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
