<?php
/**
 * Параметры приложения.
 *
 * @version 1.0
 */

return [
    'adminEmail' => 'admin@example.com',
    'serverName' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://" . $_SERVER['HTTP_HOST'],
    'NewOrderSubject' => 'newOrderSubject',
    'NewsLetterSubscriberSubject' => 'NewsLetterSubscriberSubject',
    'RecoverSubject' => 'RecoverSubject',
    'NewRegistrationSubject' => 'NewRegistrationSubject',
    'phone' => '+380 (93) 716–54–65',
    'seo' => [
        'title' => '',
        'keywords' => '',
        'description' => '',
    ],
    'social' => [
        'youtube' => [
            'link' => 'https://www.youtube.com/',
        ],
        'in' => [
            'link' => 'https://www.instagram.com',
        ],
        'twitter' => [
            'twitterKey' => '',
            'twitterSecret' => '',
            'link' => 'https://twitter.com',
        ],
        'vk' => [
            'id' => '5502193',
            'secret' => 'sdtJaR3vwe2YHdTedIA4',
            'link' => 'https://vk.com',
        ],
        'google' => [
            'apiKey' => 'HvWQGOnpB7xDPPOjlYITLt41',
            'id' => '958948178208-ggv307dn1r0c3v3u0ublrnsma0p5chat.apps.googleusercontent.com',
        ],
        'weibo' => [
            'ClientID' => '35147913',
            'ClientSecret' => '33154ec4b10e31dcc841c294823e44f9',
        ],
        'facebook' => [
            'id' => '527659790751462',
            'secret' => 'f27475e7bf861149ff8a8a2e567cd207',
            'link' => 'https://www.facebook.com',
        ],
        'yahoo' => [
            'applicationId' => 'vleaNF7a',
            'consumerKey' => 'dj0yJmk9NVg2b1dhN2NYWHRUJmQ9WVdrOWRteGxZVTVHTjJFbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD01Yw--',
            'consumerSecret' => '302ff04299fa3fc3a886f32ae89c87b5cd1b8756',
        ],
    ],
];
