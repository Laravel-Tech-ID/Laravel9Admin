<?php

namespace Modules\Access\Http\Controllers\Web\V1;

use Illuminate\Http\Request;
use DB;
use Modules\Access\Entities\V1\Access;
use Modules\Access\Entities\V1\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller
{
    public function index(Request $request)
    {
        DB::beginTransaction();
        try{
            $search = $request['search'];
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
            $datas = Access::where('name','like','%'.$request['search'].'%')->orWhere('guard_name','like','%'.$request['search'].'%')->paginate(100);
            DB::commit();
            return view('access::'.config('app.be_view').'.access.access_index',compact('datas','search'));
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error', $err->getMessage());
        }
    }

    public function create()
    {
        DB::beginTransaction();
        try{
            DB::commit();
            return view('access::'.config('app.be_view').'.access.access_create');
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error', $err->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|unique:accesses,name,NULL,id,guard_name,'.$request->guard_name,
                'guard_name' => 'required|string',
                'status' => 'required|string',
                'desc' => 'nullable|string',
                'created_by' => Auth::user()->id
            ]
        );
        DB::beginTransaction();
        try{
            Access::create(
                [
                    'id' => Uuid::uuid6(),
                    'name' => $request['name'],
                    'guard_name' => $request['guard_name'],
                    'status' => $request['status'],
                    'desc' => $request['desc']
                ]
            );
            DB::commit();
            return redirect(route('admin.v1.access.access.index'));
        }catch(\Exception $err){
            DB::rollback();
            return back()->withInput()->with('status', $err->getMessage());
        }
    }

    public function edit($id)
    {
        DB::beginTransaction();
        try{
            $data = Access::find($id);
            DB::commit();
            return view('access::'.config('app.be_view').'.access.access_edit',compact('data'));
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error',$err->getMessage());
        }
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|unique:accesses,name,'.$request->id.',id,guard_name,'.$request->guard_name,
                'guard_name' => 'required|string',
                'status' => 'required|string',
                'desc' => 'nullable|string'
            ]
        );
        DB::beginTransaction();
        try{
            Access::find($request['id'])->update(
                [
                    'name' => $request['name'],
                    'guard_name' => $request['guard_name'],
                    'status' => $request['status'],
                    'desc' => $request['desc']
                ]
            );
            DB::commit();
            return redirect(route('admin.v1.access.access.index'));
        }catch(\Exception $err){
            DB::rollback();
            return back()->withInput()->with('status', $err->getMessage());
        }
    }

    public function status($id){
        DB::beginTransaction();
        try{
            $access = Access::find($id);
            
            $access->update([
              'status' => ($access->status == 'Active') ? 'Inactive' : 'Active',
            ]);
            DB::commit();
            return back()->with('success', 'Status Berhasil Diubah');            
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error',$err->getMessage());
        }    
      }
    
      public function activateall(Request $request){
        DB::beginTransaction();
        try{
            foreach($request['access'] as $access){
                $access = Access::find($access);
                $access->update([
                'status' => 'Active',
                ]);
            }
            DB::commit();
            return back()->with('success', 'Akses Berhasil Diaktivasi');            
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error', $err->getMessage());            
        }
    }
    
    public function inactivateall(Request $request){
        DB::beginTransaction();
        try{
            foreach($request['access'] as $access){
                $access = Access::find($access);
                $access->update([
                    'status' => 'Inactive',
                ]);
            }
            DB::commit();
            return back()->with('success', 'Akses Berhasil Diinaktivasi');            
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error', $err->getMessage());            
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $access = Access::find($id)->delete();
            DB::commit();
            return back()->with('success', 'Akses Berhasil Dihapus');            
        }catch(\Exception $err){
            DB::rollback();
            return back()->withInput()->with('status', $err->getMessage());
        }
    }

    public function deleteall(Request $request){
        DB::beginTransaction();
        try{
            foreach($request['access'] as $access){
                $access = Access::find($access)->delete();
            }
            DB::commit();
            return back()->with('success', 'Akses Berhasil Dihapus');            
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error', $err->getMessage());            
        }
    }

}