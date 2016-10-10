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
    ],
    'aliases' => [
        '@log' => realpath(__DIR__.'/../../log/'),
        '@texts' => '@frontend/config/texts',
        '@theme' => '@frontend/themes/basic',
    ],
];
