<?php

namespace App\API;

class ApiMsg
{
    public static function message($message)
    {
        return [
            'msg' => $message
        ];
    }
}
