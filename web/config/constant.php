<?php 

return [
    // 'team_type' => [
    //     'team' => 'Team',
    //     'team_board' => 'Team Board',
    // ],

    'resources_type' => [
        'books_publishing' => 'Books / Publishing',
        'educational_resources_board' => 'Educational Resources Board',
        'academic_resources' => 'Academic Resources',
    ],

    'base_url' => [
        'live' => url('/'),
        'staging' => env('BASE_URL_STAGING', ''),
        'testing' => env('BASE_URL_TESTING', ''),
    ],
    
    'gallery_type' => [
        'image' => 'Image',
        'video' => 'Video',
    ],
    
    'team_type' => [
        'advisory_board' => 'Advisory Board',
        'our_team' => 'Our Team',
    ],
   
    'positions' => [
        'lesson_writer' => 'Lesson Writer',
        'blog_writer' => 'Blog Writer',
    ],

    // 'app_latest_version' => [
    //     "latest_version_android" => "1.1",
    //     "latest_version_ios" => "1.0"
    // ],

    'app_config_type' => [
        'ios' => 'IOS',
        'android' => 'Android ',
    ],
    
    'admin_notify_email' => env('ADMIN_NOTIFY_EMAIL', 'admin@example.com'),
];