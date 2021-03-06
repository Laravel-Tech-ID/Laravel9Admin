<?php

namespace Modules\Profile\Http\Services\V1;

use Modules\Access\Entities\V1\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Storage;
use Illuminate\Support\Facades\Hash;
use App\Functions;
use Exception;

class ProfileService
{
    public function edit($id)
    {
        DB::beginTransaction();
        try{
            $datas = [];
            $datas['data'] = User::find($id);
            DB::commit();
            return $datas;
        }catch(\Exception $err){
            DB::rollback();
            return $err;
        }        
    }

    public function update($data, $id)
    {
        DB::beginTransaction();
        try{
            $picture = [];
            $password;
            $new_array = [];
            foreach($data as $key => $val){
                if($key == 'picture'){
                    $picture = $val;
                }elseif($key == 'password'){
                    $password = $val;
                }elseif($key == 'password_confirmation'){
                    continue;
                }else{
                    $new_array[$key] = $val;
                }
            }
   
            $result = User::find($id);
            if(Functions::exception($result)){
                throw new Exception($result->getMessage(),is_string($result->getCode()) ? (int)$result->getCode() : $result->getCode());
            }else{

                if($picture){
                    $file_1 = $picture;
                    $file_name_1 = $result->id.'.'.$file_1->getClientOriginalExtension();
                    $file_1->storeAs(config('access.private').'user',$file_name_1);
                    $new_array = array_merge($new_array,['picture' => $file_name_1]);
                }
                if($password){
                    $new_array = array_merge($new_array,['password' => Hash::make($password)]);
                }
    
                $result1 = $result->update($new_array);
                if(Functions::exception($result1)){
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