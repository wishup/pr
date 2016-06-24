<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'image' => array(
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',  //GD or Imagick
        ),
        'siteApi' => [
            'class' => 'mongosoft\soapclient\Client',
            'url' => 'https://www.new.trak-1.com/Webservices/BibleBee.asmx?wsdl',
            'options' => [
                'cache_wsdl' => WSDL_CACHE_NONE,
                'cache_ttl'     => 86400,
                'trace'         => true,
                'exceptions'    => true,
            ],
        ],
    ],
    'aliases' => [
        '@log' => realpath(__DIR__.'/../../log/'),
        '@texts' => '@frontend/config/texts',
        '@theme' => '@frontend/themes/basic',
    ],
];
