<?php

namespace Modules\Access\Http\Services\V1;

use Modules\Access\Entities\V1\Access;
use Modules\Access\Entities\V1\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;


class AccessRoleAccessService
{
    public function index(
        $id = null,
        $q_paging = null,
        $q_name = null,
        $q_guard_name = null,
        $q_status = null,
    )
    {
        DB::beginTransaction();
        try{
            $datas['datas'] = Access::
            when($q_name,function($query) use($q_name){
                $query->whereNotNull('name')
                ->where('name','like','%'.$q_name.'%');
            })
            ->when($q_guard_name,function($query) use($q_guard_name){
                $query->whereNotNull('guard_name')
                ->where('guard_name','like','%'.$q_guard_name.'%');
            })
            ->when($q_status, function($query) use($q_status){
                $query->when($q_status == 'Active', function($query){
                    $query->whereHas('roles');
                })
                ->when($q_status == 'Inactive', function($query){
                    $query->whereDoesntHave('roles');
                });
            })
            ->paginate($q_paging);
            $datas['guards'] = Access::distinct()->get(['guard_name']);
            $datas['role'] = Role::find($id);
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
    
    public function assign($role, $access)
    {
        DB::beginTransaction();
        try{
            $roleres = Role::find($role);
            $accessres = Access::where('id',$access)->value('name');
            if($roleres->hasAccess($accessres)){
                $result = $roleres->revokeAccess($accessres);
            }else{
                $result = $roleres->assignAccess($accessres);
            }

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

    public function assign_selected($accesses, $role)
    {
        DB::beginTransaction();
        try{
            $roles = Role::find($role);
            foreach($accesses as $access){
                $accessres = Access::where('id',$access)->value('name');
                if(!$roles->hasAccess($accessres)){
                    $roles->assignAccess($accessres);
                }    
            }
            DB::commit();
            return true;            
        }catch(\Exception $err){
            DB::rollback();
            return $err;
        }            
    }

    public function revoke_selected($accesses, $role)
    {
        DB::beginTransaction();
        try{
            $roles = Role::find($role);
            foreach($accesses as $access){
                $accessres = Access::where('id',$access)->value('name');
                if($roles->hasAccess($accessres)){
                    $roles->revokeAccess($accessres);
                }    
            }
            DB::commit();
            return true;            
        }catch(\Exception $err){
            DB::rollback();
            return $err;
        }            
    }
}