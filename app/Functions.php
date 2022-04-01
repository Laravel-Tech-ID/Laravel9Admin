<?php

namespace App;

use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Functions{
    static function toRupiah($value,$decimal = 0){
        return (is_numeric($value)) ? "Rp. " . number_format($value,$decimal,',','.') : 0;
    }

    static function toInteger($value){
        return (int)$value;
    }

    static function sendEmail($name, $email, $subject, $data, $template){
        Mail::send($template, $data, function($message) use ($name, $email, $subject) {
            $message->to($email, $name)->subject($subject);
            $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'));
        });
    }
}
