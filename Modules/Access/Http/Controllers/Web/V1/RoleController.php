<?php

namespace Modules\Access\Http\Controllers\Web\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Access\Http\Requests\V1\AccessRoleRequest;
use Modules\Access\Http\Services\V1\AccessRoleService;
use Validator;
use App\Functions;
use Exception;

class RoleController extends Controller
{
    public function index(Request $request, AccessRoleService $service)
    {
        try{
            if(!isset($request->q_paging)){
                $q_paging = 10;
            }else{
                $q_paging = $request->q_paging;
            }

            $q_name = $request->q_name;
            $q_status = $request->q_status;
            $q_desc = $request->q_desc;

            $result = $service->index(
                $q_paging,
                $q_name,
                $q_status,
                $q_desc,
            );

            if(Functions::exception($result)){
                throw new Exception($result->getMessage(),is_string($result->getCode()) ? (int)$result->getCode() : $result->getCode());
            }else{
                $datas = $result['datas'];
                return view('access::'.config('app.be_view').'.role.role_index',compact(
                    'datas',
                    'q_paging',
                    'q_name',
                    'q_status',
                    'q_desc',
                    ));    
            }
        }catch(\Exception $err){
            return back()->with('error', $err->getMessage());
        }
    }

    public function create()
    {
        try{
            return view('access::'.config('app.be_view').'.role.role_create');
        }catch(\Exception $err){
            return back()->with('error', $err->getMessage());
        }
    }

    public function store(Request $request, AccessRoleService $service)
    {
        try{
            $rules = (new AccessRoleRequest)->rules();
            $request->merge(['created_by' => Auth::user()->id]);
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()){
                return back()->withInput()->withErrors($validator);
            }else{
                try{
                    $data = $service->store($request->all());
                    if(Functions::exception($data)){
                        throw new Exception($data->getMessage(),is_string($data->getCode()) ? (int)$data->getCode() : $data->getCode());
                    }else{
                        return redirect(route('admin.v1.access.role.index'))->with('success',config('app.message_store'));
                    }
                }catch(\Exception $err){
                    return back()->withInput()->with('error',$err->getMessage());
                }
            }
        }catch(\Exception $err){
            return back()->with('error', $err->getMessage());
        }
    }

    public function edit(AccessRoleService $service, $id)
    {
        try{
            $data = $service->edit($id);
            if(Functions::exception($data)){
                throw new Exception($data->getMessage(),is_string($data->getCode()) ? (int)$data->getCode() : $data->getCode());
            }else{
                return view('access::'.config('app.be_view').'.role.role_edit',compact('data'));
            }
        }catch(\Exception $err){
            return back()->withInput()->with('error',$err->getMessage());
        }
    }

    public function update(Request $request, AccessRoleService $service, $id)
    {
        try{
            $rules = (new AccessRoleRequest)->rules($id);
            $request->merge(['updated_by' => Auth::user()->id]);
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return back()->withInput()->withErrors($validator);
            }else{
                try{
                    $data = $service->update($request->all(),$id);
                    if(Functions::exception($data)){
                        throw new Exception($data->getMessage(),is_string($data->getCode()) ? (int)$data->getCode() : $data->getCode());
                    }else{
                        return redirect(route('admin.v1.access.role.index'))->with('success',config('app.message_update'));
                    }
                }catch(\Exception $err){
                    return back()->withInput()->with('error',$err->getMessage());
                }
            }
        }catch(\Exception $err){
            return back()->with('error', $err->getMessage());
        }
    }

    public function destroy(AccessRoleService $service, $id)
    {
        try{
            $data = $service->destroy($id);
            if(Functions::exception($data)){
                throw new Exception($data->getMessage(),is_string($data->getCode()) ? (int)$data->getCode() : $data->getCode());
            }else{
                return back()->with('success',config('app.message_destroy'));
            }
        }catch(\Exception $err){
            return back()->with('error',$err->getMessage());
        }
    }

    public function destroy_selected(Request $request, AccessRoleService $service)
    {
        try{
            foreach($request->selected as $id){
                $service->destroy($id);
            }
            return back()->with('success',config('app.message_destroy'));
        }catch(\Exception $err){
            return back()->with('error',$err->getMessage());
        }
    }

}
