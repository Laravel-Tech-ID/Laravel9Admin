<?php

namespace Modules\Access\Http\Services\V1;

use Modules\Access\Entities\V1\Access;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;


class AccessAccessService
{
    public function index(
        $q_paging = null,
        $q_name = null,
        $q_guard_name = null,
        $q_status = null,
        $q_desc = null,
    )
    {
        DB::beginTransaction();
        try{

            // ======================================//
            //====== GET EVERY ROUTE FROM ROUTE =====//
            // ======================================//
            $routeCollection = Route::getRoutes();
            foreach ($routeCollection as $value){
                if($value->getName() !== null){
                    $middle = $value->getAction('middleware');
                    $check = Access::where('name',$value->getName())->where('guard_name',$middle[0])->first();
                    if(!$check && ($middle[0] == 'web' || $middle[0] == 'api')){
                        Access::create(
                            [
                                'id' => Uuid::uuid6(),
                                'name' => $value->getName(),
                                'guard_name' => $middle[0],
                                'status' => 'Active'
                            ]
                        );                        
                    }    
                }
            }
            //MASIH ADA PR MENGHAPUS ROUTE YG ADA DI DATABASE TAPI TIDAK ADA DI APLIKASI
            //TERMASUK KAITANNYA DENGAN USER ROLE
            // ======================================//
            //====== GET EVERY ROUTE FROM ROUTE =====//
            // ======================================//

            $datas['datas'] = Access::
            when($q_name,function($query) use($q_name){
                $query->whereNotNull('name')
                ->where('name','like','%'.$q_name.'%');
            })
            ->when($q_guard_name,function($query) use($q_guard_name){
                $query->whereNotNull('guard_name')
                ->where('guard_name','like','%'.$q_guard_name.'%');
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
            $datas['guards'] = Access::distinct()->get(['guard_name']);
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

            $result = Access::create($data);
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

    public function edit($id)
    {
        DB::beginTransaction();
        try{
            $data = Access::find($id);
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
            $result = Access::find($id);
            if(is_object($result) && (get_class($result) == 'Exception' || get_class($result) == 'Illuminate\Database\QueryException')){
                throw new Exception($result->getMessage(),$result->getCode());
            }else{
                $result = $result->update($data);
                if(is_object($result) && (get_class($result) == 'Exception' || get_class($result) == 'Illuminate\Database\QueryException')){
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
            $access = Access::find($id);
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
            $result = Access::find($id);
            if(is_object($result) && (get_class($result) == 'Exception' || get_class($result) == 'Illuminate\Database\QueryException')){
                throw new Exception($result->getMessage(),$result->getCode());
            }else{
                $result = $result->delete();
                if(is_object($result) && (get_class($result) == 'Exception' || get_class($result) == 'Illuminate\Database\QueryException')){
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