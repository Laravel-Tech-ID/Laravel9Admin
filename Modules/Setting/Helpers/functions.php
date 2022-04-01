<?php
use Modules\Setting\Entities\V1\Setting;

if(!function_exists('setting')){
    function setting($param){
        $setting = cache()->remember('setting',config('app.cache_setting'),function(){
            return Setting::first();
        });
        if($setting){
            return $setting->$param;
        }else{
            return "";
        }
    }
}

if(!function_exists('isDate')){
    function isDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}

if(!function_exists('isDateTime')){
    function isDateTime($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}
