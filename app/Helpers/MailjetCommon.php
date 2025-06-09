<?php

namespace App\Helpers;

use Mailjet\LaravelMailjet\Facades\Mailjet;
use Mailjet\Resources;

class MailjetCommon{

    public static function send_email($recipients = [], $subject, $html_part = '', $attachments = []){
        $body = [
            'FromEmail' => ConstantUtility::SENDER_EMAIL,
            'FromName' => ConstantUtility::SENDER_NAME,
            'Recipients' => $recipients,
            'Subject' => $subject,
            'Html-part' => $html_part,
        ];

        if(count($attachments) > 0){
            $body['Attachments'] = $attachments;
        }
        Mailjet::post(Resources::$Email, ['body' => $body]);

    }
}
