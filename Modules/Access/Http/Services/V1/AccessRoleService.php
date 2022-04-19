<?php

namespace Modules\Access\Http\Services\V1;

use Modules\Access\Entities\V1\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use App\Functions;
use Exception;

class AccessRoleService
{
    public function index(
        $q_paging = null,
        $q_name = null,
        $q_status = null,
        $q_desc = null,
    )
    {
        DB::beginTransaction();
        try{

            $datas['datas'] = Role::
            when($q_name,function($query) use($q_name){
                $query->whereNotNull('name')
                ->where('name','like','%'.$q_name.'%');
            })
            ->when($q_status,function($query) use($q_status){
                $query->whereNotNull('status')
                ->where('status','like','%'.$q_status.'%');
            })
            ->when($q_desc,function($query) use($q_desc){
                $query->whereNotNull('desc')
                ->where('desc','like','%'.$q_desc.'%');
            })
            ->paginate($q_paging);
            DB::commit();
            return $datas;
        }catch(\Exception $err){
            DB::rollback();
            return $err;
        }        
    }

    public function create()
    {

    }
    
    public function store($data)
    {
        DB::beginTransaction();
        try{
            $uuid = Uuid::uuid6();
            $arrs = [
                'id' => $uuid
            ];

            $data = array_merge($data,$arrs);

            $result = Role::create($data);
            if(Functions::exception($result)){
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
            $data = Role::find($id);
            DB::commit();
            return $data;
        }catch(\Exception $err){
            DB::rollback();
            return $err;
        }        
    }

    public function update($data,$id)
    {
        DB::beginTransaction();
        try{
            $result = Role::find($id);
            if(Functions::exception($result)){
                throw new Exception($result->getMessage(),$result->getCode());
            }else{
                $result = $result->update($data);
                if(Functions::exception($result)){
                    throw new Exception($result->getMessage(),$result->getCode());
                }else{
                    DB::commit();
                    return $result;
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
            $access = Role::find($id);
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
            $result = Role::find($id);
            if(Functions::exception($result)){
                throw new Exception($result->getMessage(),$result->getCode());
            }else{
                $result = $result->delete();
                if(Functions::exception($result)){
                    throw new Exception($result->getMessage(),$result->getCode());
                }else{
                    DB::commit();
                    return $result;
                }
            }
        }catch(\Exception $err){
            DB::rollback();
            return $err;
        }        
    }
}