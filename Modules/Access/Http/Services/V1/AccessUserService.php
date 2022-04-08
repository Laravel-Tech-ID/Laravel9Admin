<?php

namespace Modules\Access\Http\Services\V1;

use Modules\Access\Entities\V1\User;
use Modules\Access\Entities\V1\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Storage;
use Illuminate\Support\Facades\Hash;

class AccessUserService
{
    public function index(
        $q_paging,
        $q_code,
        $q_name,
        $q_phone,
        $q_email,
        $q_role,
        $q_status
    )
    {
        DB::beginTransaction();
        try{

            $datas['datas'] = User::
            when($q_code,function($query) use($q_code){
                $query->whereNotNull('code')
                ->where('code','like','%'.$q_code.'%');
            })
            ->when($q_name,function($query) use($q_name){
                $query->whereNotNull('name')
                ->where('name','like','%'.$q_name.'%');
            })
            ->when($q_phone,function($query) use($q_phone){
                $query->whereNotNull('phone')
                ->where('phone','like','%'.$q_phone.'%');
            })
            ->when($q_email,function($query) use($q_email){
                $query->whereNotNull('email')
                ->where('email','like','%'.$q_email.'%');
            })
            ->when($q_role,function($query) use($q_role){
                $query->whereHas('roles',function($query) use($q_role){
                    $query->where('id',$q_role);
                });
            })
            ->when($q_status,function($query) use($q_status){
                $query->whereNotNull('status')
                ->where('status','like','%'.$q_status.'%');
            })
            ->paginate($q_paging);
            $datas['roles'] = Role::all();
            DB::commit();
            return $datas;
        }catch(\Exception $err){
            DB::rollback();
            return $err;
        }        
    }

    public function create()
    {
        DB::beginTransaction();
        try{
            $result = Role::all();
            if(is_object($result) && (get_class($result) == 'Exception' || get_class($result) == 'Illuminate\Database\QueryException')){
                throw new Exception($result->getMessage(),$result->getCode());
            }else{
                DB::commit();
                return $result;
            }
        }catch(\Exception $err){
            DB::rollback();
            return $err;
        }
    }
    
    public function store($data)
    {
        DB::beginTransaction();
        try{
            $uuid = Uuid::uuid6();
            $arrs = [
                'id' => $uuid
            ];

            $role = [];
            $picture = [];
            $new_array = [];
            $new_array = array_merge($new_array,$arrs);
            foreach($data as $key => $val){
                if($key == 'role'){
                    $role = $val;
                }elseif($key == 'picture'){
                    $picture = $val;
                }elseif($key == 'password'){
                    $new_array[$key] = Hash::make($val);
                }elseif($key == 'password_confirmation'){
                    continue;
                }else{
                    $new_array[$key] = $val;
                }
            }

            if($picture){
                $file_1 = $picture;
                $file_name_1 = $uuid.'.'.$file_1->getClientOriginalExtension();
                $file_1->storeAs(config('access.private').'user',$file_name_1);
                $new_array = array_merge($new_array,['picture' => $file_name_1]);
            }
    
            $result = User::create($new_array);
            $result_assign = $result->assignRole($role);
            if((is_object($result)) && (get_class($result) == 'Exception' || get_class($result) == 'Illuminate\Database\QueryException')){
                throw new Exception($result->getMessage(),$result->getCode());
            }else{
                DB::commit();
                return $result;
            }
        }catch(\Exception $err){
            DB::rollback();
            return $err;
        }            
    }

    public function edit($id)
    {
        DB::beginTransaction();
        try{
            $datas = [];
            $datas['data'] = User::find($id);
            $datas['roles'] = Role::all();
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
            $uuid = Uuid::uuid6();

            $role = [];
            $picture = [];
            $password;
            $new_array = [];
            foreach($data as $key => $val){
                if($key == 'role'){
                    $role = $val;
                }elseif($key == 'picture'){
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
            if(is_object($result) && (get_class($result) == 'Exception' || get_class($result) == 'Illuminate\Database\QueryException')){
                throw new Exception($result->getMessage(),$result->getCode());
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
                $result_assign = $result->refreshRole($role);
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

    public function status($id)
    {
        DB::beginTransaction();
        try{
            $access = User::find($id);
            $arrs = [
                'status' => ($access->status == 'Active') ? 'Inactive' : 'Active',
            ];
            DB::commit();
            return $this->update($arrs,$id);
        }catch(\Exception $err){
            DB::rollback();
            return $err;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $result = User::find($id);
            if(is_object($result) && (get_class($result) == 'Exception' || get_class($result) == 'Illuminate\Database\QueryException')){
                throw new Exception($result->getMessage(),$result->getCode());
            }else{
                $result1 = $result->delete();
                if(is_object($result1) && (get_class($result1) == 'Exception' || get_class($result1) == 'Illuminate\Database\QueryException')){
                    throw new Exception($result1->getMessage(),$result1->getCode());
                }else{
                    Storage::delete(config('access.private').'user/'.$result->picture);
                    DB::commit();
                    return $result1;
                }
            }
        }catch(\Exception $err){
            DB::rollback();
            return $err;
        }        
    }

    public function file($filename)
    {
        if(Storage::exists(config('access.private').'user/'.$filename)){
            return file_show(config('access.private').'user/'.$filename);
        }
        return abort(404);
    }
}