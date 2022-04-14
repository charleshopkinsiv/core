<?php

namespace CharlesHopkinsIV\Core\Email;


class Email
{

    private $sender_address;
    private $sender_name;
    private $email_type;

    private $EMAILS = [
        'vendor signup' => [
            'template' => '',
        ],
        'listing reply' => [
            'template' => '',
        ]
    ];

    public function __construct(string $sender_address, string $sender_name)
    {

        $this->sender_address = $sender_address;
        $this->sender_name = $sender_name;
    }


    public function loadEmail(string $email_type) {


        if(!empty($this->EMAILS[$email_type])) {

            $this->email_type = $email_type;

            return true;
        }
            
        return false;
    }


    public function send(string $to_address, string $message, string $subject, string $from_address) {

        $headers = 'From: "' . $this->sender_name . '" <' . $from_address . ">\r\n";

        mail($to_address, $subject, $message, $headers);
    }
}
