<?php

namespace Modules\Access\Http\Controllers\Web\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Access\Http\Requests\V1\AccessRoleAccessRequest;
use Modules\Access\Http\Services\V1\AccessRoleAccessService;
use Validator;
use App\Functions;
use Exception;

class RoleAccessController extends Controller
{
    public function index(Request $request, AccessRoleAccessService $service, $id)
    {
        try{
            if(!isset($request->q_paging)){
                $q_paging = 10;
            }else{
                $q_paging = $request->q_paging;
            }

            $q_name = $request->q_name;
            $q_guard_name = $request->q_guard_name;
            $q_status = $request->q_status;

            $result = $service->index(
                $id,
                $q_paging,
                $q_name,
                $q_guard_name,
                $q_status
            );

            if(Functions::exception($result)){
                throw new Exception($result->getMessage(),is_string($result->getCode()) ? (int)$result->getCode() : $result->getCode());
            }else{
                $datas = $result['datas'];
                $guards = $result['guards'];
                $role = $result['role'];
                return view('access::'.config('app.be_view').'.role.access.access_index',compact(
                    'datas',
                    'guards',
                    'role',
                    'q_paging',
                    'q_name',
                    'q_guard_name',
                    'q_status',
                ));    
            }
        }catch(\Exception $err){
            return back()->with('error', $err->getMessage());
        }
    }


    public function assign(AccessRoleAccessService $service, $role, $access)
    {
        try{
            $data = $service->assign($role, $access);
            if(Functions::exception($data)){
                throw new Exception($data->getMessage(),is_string($data->getCode()) ? (int)$data->getCode() : $data->getCode());
            }else{
                return back()->with('success', config('app.message_success'));            
            }
        }catch(\Exception $err){
            return back()->withInput()->with('error',$err->getMessage());
        }
    }

    public function assign_selected(Request $request, AccessRoleAccessService $service, $role)
    {
        try{
            $data = $service->assign_selected($request->selected, $role);
            if(Functions::exception($data)){
                throw new Exception($data->getMessage(),is_string($data->getCode()) ? (int)$data->getCode() : $data->getCode());
            }else{
                return back()->with('success', config('app.message_success'));            
            }
        }catch(\Exception $err){
            return back()->with('error', $err->getMessage());            
        }
    }

    public function revoke_selected(Request $request, AccessRoleAccessService $service, $role)
    {
        try{
            $data = $service->revoke_selected($request->selected, $role);
            if(Functions::exception($data)){
                throw new Exception($data->getMessage(),is_string($data->getCode()) ? (int)$data->getCode() : $data->getCode());
            }else{
                return back()->with('success', config('app.message_success'));            
            }
        }catch(\Exception $err){
            return back()->with('error', $err->getMessage());            
        }
    }    
}
