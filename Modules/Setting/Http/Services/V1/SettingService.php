<?php

namespace Modules\Setting\Http\Services\V1;

use Modules\Setting\Entities\V1\Setting;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Storage;

class SettingService
{
    public function edit()
    {
        DB::beginTransaction();
        try{
            $datas = [];
            $datas['data'] = Setting::first();
            DB::commit();
            return $datas;
        }catch(\Exception $err){
            DB::rollback();
            return $err;
        }        
    }

    public function update($data)
    {
        DB::beginTransaction();
        try{
            $icon = [];
            $logo = [];
            $login_image = [];

            $new_array = [];
            foreach($data as $key => $val){
                if($key == 'icon'){
                    $icon = $val;
                }elseif($key == 'logo'){
                    $logo = $val;
                }elseif($key == 'login_image'){
                    $login_image = $val;
                }else{
                    $new_array[$key] = $val;
                }
            }
   
            $result = Setting::first();
            if(is_object($result) && (get_class($result) == 'Exception' || get_class($result) == 'Illuminate\Database\QueryException')){
                throw new Exception($result->getMessage(),$result->getCode());
            }else{

                if($icon){
                    $file_1 = $icon;
                    $file_name_1 = date('Y-m-d_hia').rand(1,10000).'.'.$file_1->getClientOriginalExtension();
                    $file_1->storeAs(config('setting.public'),$file_name_1);
                    $new_array = array_merge($new_array,['icon' => $file_name_1]);
                }
    
                if($logo){
                    $file_1 = $logo;
                    $file_name_1 = date('Y-m-d_hia').rand(1,10000).'.'.$file_1->getClientOriginalExtension();
                    $file_1->storeAs(config('setting.public'),$file_name_1);
                    $new_array = array_merge($new_array,['logo' => $file_name_1]);
                }

                if($login_image){
                    $file_1 = $login_image;
                    $file_name_1 = date('Y-m-d_hia').rand(1,10000).'.'.$file_1->getClientOriginalExtension();
                    $file_1->storeAs(config('setting.public'),$file_name_1);
                    $new_array = array_merge($new_array,['login_image' => $file_name_1]);
                }

                $result1 = $result->update($new_array);
                if(is_object($result1) && (get_class($result1) == 'Exception' || get_class($result1) == 'Illuminate\Database\QueryException')){
                    throw new Exception($result1->getMessage(),$result1->getCode());
                }else{
                    DB::commit();
                    return $result1;
                }
            }
        }catch(\Exception $err){
            DB::rollback();
            return $err;
        }            
    }
}