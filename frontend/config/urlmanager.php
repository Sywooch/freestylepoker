<?php

return [
    'rules' => [
        '' => 'site/default/index',
        '<_a:(about|contacts|captcha)>' => 'site/default/<_a>',
        '<_m:video>' => '<_m>/video/index',
        '<_m:video>/<id:\d+>-<alias:[a-zA-Z0-9_-]{1,100}+>' => '<_m>/video/view',
    ]
];
