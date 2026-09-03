<?php

namespace App\Enums;

enum NotificationLogsType: string
{
    //
    case EMAIL      ='email'; 
    case SMS        ='sms';
    case WHATSAPP   ='whatsapp';
}
