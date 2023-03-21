<?php

namespace App\Class;

use MailJet\Client;
use MailJet\Ressources;

class Mail
{
    private $api_key = '748968d1ac2ae74018499aeabbb2c0e6';
    private $api_key_secret = '7880daa9042a6b7a376cbb6c6b3c3334';

    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret, true,['version' => 'v3.1']);
       
$body = [
    'Messages' => [
        [
            'From' => [
                'Email' => "amaniecosmetic@gmail.com",
                'Name' => "Amanie Cosmetics"
            ],
            'To' => [
                [
                    'Email' => $to_email,
                    'Name' => $to_name
                ]
            ],
            'TemplateID' => 4664343,
            'TemplateLanguage' => true,
            'Subject' => $subject,
            'Variables' => [
                'content' => $content,
            ]
        ]
    ]
];
$response = $mj->post(Resources::$Email, ['body' => $body]);
$response->success();
    }
}
