<?php

namespace Modules\Access\Http\Controllers\Web\V1;

use Illuminate\Http\Request;
use DB;
use Modules\Access\Entities\V1\Role;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;

class RoleController extends Controller
{
    public function index()
    {
        DB::beginTransaction();
        try{
            $roles = Role::paginate(50);
            DB::commit();
            return view('access::'.config('app.be_view').'.role.role_index',compact('roles'));
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
            return view('access::'.config('app.be_view').'.role.role_create');
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error', $err->getMessage());
        }
    }

    public function store(Request $data)
    {
        $data->validate(
            [
                'name' => 'required|string|unique:roles,name',
                'status' => 'required|string',
                'desc' => 'nullable|string'
            ]
        );
        DB::beginTransaction();
        try{
            Role::create(
                [
                    'id' => Uuid::uuid6(),
                    'name' => $data['name'],
                    'status' => $data['status'],
                    'desc' => $data['desc']
                ]
            );
            DB::commit();
            return redirect(route('admin.v1.access.role.index'));
        }catch(\Exception $err){
            DB::rollback();
            return back()->withInput()->with('status', $err->getMessage());
        }
    }

    public function edit($id)
    {
        DB::beginTransaction();
        try{
            $role = Role::find($id);
            DB::commit();
            return view('access::'.config('app.be_view').'.role.role_edit',compact('role'));
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error',$err->getMessage());
        }
    }

    public function update(Request $data)
    {
        $data->validate(
            [
                'name' => 'required|string|unique:roles,name,'.$data['id'],
                'status' => 'required|string',
                'desc' => 'nullable|string'
            ]
        );
        DB::beginTransaction();
        try{
            Role::find($data['id'])->update(
                [
                    'name' => $data['name'],
                    'status' => $data['status'],
                    'desc' => $data['desc']
                ]
            );
            DB::commit();
            return redirect(route('admin.v1.access.role.index'));
        }catch(\Exception $err){
            DB::rollback();
            return back()->withInput()->with('status', $err->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            Role::find($id)->delete();
            DB::commit();
            return redirect(route('admin.v1.access.role.index'));
        }catch(\Exception $err){
            DB::rollback();
            return back()->withInput()->with('status', $err->getMessage());
        }
    }
}
