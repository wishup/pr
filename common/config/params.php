<?php
return [
    'unsubscribe_secret_key' => 'hJ81Hjkwlower77a',
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'trak1_subscriber_code' => '773331CB-E774-4039-B099-A3C81D33B1E0',
    'trak1_customer_number' => '23001',
    'user_status' => [
        "" => "",
        "incoming" => "Incoming",
        "biblebee_approved" => "BB APV",
        "bg_check" => "BG checking",
        "approved" => "APV",
        "need_assistance" => "NA",
        "rejected" => "Rejected",
    ],
    'users_status' => [
        '' => '',
        0 => 'Uncomfirmed',
        1 => 'Active',
        2 => 'Archive',
    ],
    'us_states' => [
        '' => 'State',
        'AL'=>'ALABAMA',
        'AK'=>'ALASKA',
        'AS'=>'AMERICAN SAMOA',
        'AZ'=>'ARIZONA',
        'AR'=>'ARKANSAS',
        'CA'=>'CALIFORNIA',
        'CO'=>'COLORADO',
        'CT'=>'CONNECTICUT',
        'DE'=>'DELAWARE',
        'DC'=>'DISTRICT OF COLUMBIA',
        'FM'=>'FEDERATED STATES OF MICRONESIA',
        'FL'=>'FLORIDA',
        'GA'=>'GEORGIA',
        'GU'=>'GUAM GU',
        'HI'=>'HAWAII',
        'ID'=>'IDAHO',
        'IL'=>'ILLINOIS',
        'IN'=>'INDIANA',
        'IA'=>'IOWA',
        'KS'=>'KANSAS',
        'KY'=>'KENTUCKY',
        'LA'=>'LOUISIANA',
        'ME'=>'MAINE',
        'MH'=>'MARSHALL ISLANDS',
        'MD'=>'MARYLAND',
        'MA'=>'MASSACHUSETTS',
        'MI'=>'MICHIGAN',
        'MN'=>'MINNESOTA',
        'MS'=>'MISSISSIPPI',
        'MO'=>'MISSOURI',
        'MT'=>'MONTANA',
        'NE'=>'NEBRASKA',
        'NV'=>'NEVADA',
        'NH'=>'NEW HAMPSHIRE',
        'NJ'=>'NEW JERSEY',
        'NM'=>'NEW MEXICO',
        'NY'=>'NEW YORK',
        'NC'=>'NORTH CAROLINA',
        'ND'=>'NORTH DAKOTA',
        'MP'=>'NORTHERN MARIANA ISLANDS',
        'OH'=>'OHIO',
        'OK'=>'OKLAHOMA',
        'OR'=>'OREGON',
        'PW'=>'PALAU',
        'PA'=>'PENNSYLVANIA',
        'PR'=>'PUERTO RICO',
        'RI'=>'RHODE ISLAND',
        'SC'=>'SOUTH CAROLINA',
        'SD'=>'SOUTH DAKOTA',
        'TN'=>'TENNESSEE',
        'TX'=>'TEXAS',
        'UT'=>'UTAH',
        'VT'=>'VERMONT',
        'VI'=>'VIRGIN ISLANDS',
        'VA'=>'VIRGINIA',
        'WA'=>'WASHINGTON',
        'WV'=>'WEST VIRGINIA',
        'WI'=>'WISCONSIN',
        'WY'=>'WYOMING',
        'AE'=>'ARMED FORCES AFRICA \ CANADA \ EUROPE \ MIDDLE EAST',
        'AA'=>'ARMED FORCES AMERICA (EXCEPT CANADA)',
        'AP'=>'ARMED FORCES PACIFIC'
    ],
//    "hosts_status" => [
//        "3" => "Completed",
//        "4" => "Full",
//        "8" => "Private",
//        "5" => "Follow-up Required",
//        "13" => "Terminated",
//        "14" => "Lead",
//        "all" => "All Hosts",
//    ],
    "hosts_status" => [
        "0" => "Inactive",
        "1" => "Active",
        "2" => "Paused",
    ],
    "family_status" => [
        "0" => "Inactive",
        "1" => "Active",
    ],
    "willing_to_host" => [
        -1 => 'Unlimited',
        10 => 10,
        25 => 25,
        50 => 50,
        100 => 100,
    ],
    "gender" => ['' => 'Gender', '1' => 'Male', '2' => 'Female'],
    "t_shirt_size" => ['' => 'T-shirt size', '1' => 'XS', '2' => 'S', '3' => 'M', '4' => 'L', '5' => 'XL'],
    "versions" => ['' => 'Version', '1' => 'KJV', '2' => 'NKJV', '3' => 'NASB', '4' => 'ESV'],
    "versions2" => [ '1' => 'KJV', '2' => 'NKJV', '3' => 'NASB', '4' => 'ESV'],
    'google_community_url' => 'https://plus.google.com/u/0/communities/107645641301522450881',
    'instruction_url' => 'https://vimeo.com/160120974',
    'cs_statuses' => ['0' => 'White',  '1' => 'Yellow',  '2' => 'Orange',  '3' => 'Green', '4' => 'Red'],
    'discount_per_types' => ['0'=>'Per Order', '1' => 'Per Contestant'],
    'donation_amounts' => ['1'=>'$1', '5' => '$5', '10'=>'$10', '25'=>'$25', '50'=>'$50', '100'=>'$100', '999999'=>'Other'],
    'history_types' => ['info' => 'User Info', 'registration' => 'Registration', 'donation'=>'Donation'],
    'resource_button_colors' => [
        'Beginner' => '#84c359',
        'Junior' => '#496fc1',
        'Senior' => '#00574e',
        'Primary' => '#77557a',
    ],
    "project_name" => "Sample Project"
];