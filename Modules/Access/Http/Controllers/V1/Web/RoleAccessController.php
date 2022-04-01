<?php

namespace Modules\Access\Http\Controllers\V1\Web;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Route;
use Modules\Access\Entities\V1\Access;
use Modules\Access\Entities\V1\Role;
use Illuminate\Routing\Controller;

class RoleAccessController extends Controller
{
    public function index(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $search = $request['search'];
            $role = Role::find($id);
            $accesses = Access::where('name','like','%'.$request['search'].'%')->orWhere('guard_name','like','%'.$request['search'].'%')->paginate(100);
            DB::commit();
            return view('access::'.config('app.be_view').'.role.access.access_index',compact('accesses','role','search'));
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error', $err->getMessage());
        }
    }

    public function assign($role, $access)
    {
        DB::beginTransaction();
        try{
            $roleres = Role::find($role);
            $accessres = Access::where('id',$access)->value('name');
            if($roleres->hasAccess($accessres)){
                $roleres->revokeAccess($accessres);
            }else{
                $roleres->assignAccess($accessres);
            }
            DB::commit();
            return back()->with('success', 'Berhasil Diaktivasi');            
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error', $err->getMessage());            
        }
    }

    public function assignall(Request $request, $role){
        DB::beginTransaction();
        try{
            $roleres = Role::find($role);
            foreach($request['access'] as $access){
                $accessres = Access::where('id',$access)->value('name');
                if(!$roleres->hasAccess($accessres)){
                    $roleres->assignAccess($accessres);
                }    
            }
            DB::commit();
            return back()->with('success', 'Berhasil Diaktivasi');            
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error', $err->getMessage());            
        }
    }

    public function revokeall(Request $request, $role){
        DB::beginTransaction();
        try{
            $roleres = Role::find($role);
            foreach($request['access'] as $access){
                $accessres = Access::where('id',$access)->value('name');
                if($roleres->hasAccess($accessres)){
                    $roleres->revokeAccess($accessres);
                }
            }
            DB::commit();
            return back()->with('success', 'Berhasil Diinaktivasi');            
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error', $err->getMessage());            
        }
    }
}
