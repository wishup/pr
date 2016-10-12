<?php

return [
    "is_backend" => false,
    'adminEmail' => 'admin@example.com',
    'defaultLayout' => 'main',
    'seo_title_separator' => '-',
    'seo_default_title' => 'Project',
    'seo_default_meta_description' => '',
    'seo_default_meta_keywords' => '',
    'publicActions' => [
        'user' => [
            'connecthostaftereg',
            'login',
            'confirm',
            'registration',
            'renewhost',
            'familydirectregistration',
            'familyconfirmation',
            'donationconfirmation',
            'loadchildbyajax',
            'updatecartbyajax',
            'forgot',
            'fbauth',
            'hfbauth',
            'gauth',
            'hgauth',
            'familypayment',
            'gethostsmap',
            'changepassword',
            'donationpayment'
        ],
        'blog' => ['*'],
        'site' => ['*'],
        'liveedit' => ['*'],
    ]

];
