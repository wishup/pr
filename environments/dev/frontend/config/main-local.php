<?php
return [
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
                    'clientId' => '561893433988274',
                    'clientSecret' => 'c93f5851bdda03a59a19dafdc223fd71',
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