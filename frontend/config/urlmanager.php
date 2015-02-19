<?php

return [
    'rules' => [
        '' => 'site/default/index',
        '<_a:(about|contacts|captcha)>' => 'site/default/<_a>',
        '<_m:video>' => '<_m>/video/index',
        '<_m:trainings>' => '<_m>/trainings/index',
        '<_m:rooms>' => '<_m>/rooms/index',
        '<_m:rooms>/promotions' => '<_m>/roomspromo/index',
        'videousr' => 'video/videousr/index',
        'gold-fund' => 'video/video_goldfund/index',
//        '<_m:video>/<id:\d+>-<alias:[a-zA-Z0-9_-]{1,100}+>' => '<_m>/video/view',
        '<_m:video>/<alias:[a-zA-Z0-9_-]{1,100}+>' => '<_m>/video/view',
        '<_m:rooms>/<alias:[a-zA-Z0-9_-]{1,100}+>' => '<_m>/rooms/view',
        '<_m:rooms>/promotions/<alias:[a-zA-Z0-9_-]{1,100}+>' => '<_m>/roomspromo/view',
        '<_m:trainings>/<alias:[a-zA-Z0-9_-]{1,100}+>' => '<_m>/trainings/view',
        'video/<_a:(create|contacts|captcha|view)>' => 'video/video/<_a>'
    ]
];
