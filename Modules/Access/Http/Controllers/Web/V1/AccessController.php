<?php

namespace Modules\Access\Http\Controllers\Web\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Access\Http\Requests\V1\AccessAccessRequest;
use Modules\Access\Http\Services\V1\AccessAccessService;
use Exception;
use Validator;

class AccessController extends Controller
{
    public function index(Request $request, AccessAccessService $service)
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
            $q_desc = $request->q_desc;

            $result = $service->index(
                $q_paging,
                $q_name,
                $q_guard_name,
                $q_status,
                $q_desc,
            );

            if(is_object($result) && (get_class($result) == 'Exception' || get_class($result) == 'Illuminate\Database\QueryException')){
                throw new Exception($result->getMessage(),$result->getCode());
            }else{
                $datas = $result['datas'];
                $guards = $result['guards'];
                return view('access::'.config('app.be_view').'.access.access_index',compact(
                    'datas',
                    'guards',
                    'q_paging',
                    'q_name',
                    'q_guard_name',
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
            return view('access::'.config('app.be_view').'.access.access_create');
        }catch(\Exception $err){
            return back()->with('error', $err->getMessage());
        }
    }

    public function store(Request $request, AccessAccessService $service)
    {
        try{
            $rules = (new AccessAccessRequest)->rules();
            $request->merge(['created_by' => Auth::user()->id]);
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()){
                return back()->withInput()->withErrors($validator);
            }else{
                try{
                    $data = $service->store($request->all());
                    if(is_object($data) && (get_class($data) == 'Exception' || get_class($data) == 'Illuminate\Database\QueryException' || get_class($data) == 'ErrorException')){
                        throw new Exception($data->getMessage(),$data->getCode());
                    }else{
                        return redirect(route('admin.v1.access.access.index'))->with('success',config('app.message_store'));
                    }
                }catch(\Exception $err){
                    return back()->withInput()->with('error',$err->getMessage());
                }
            }
        }catch(\Exception $err){
            return back()->withInput()->with('error',$err->getMessage());
        }           
    }


    public function edit(AccessAccessService $service, $id)
    {
        try{
            $data = $service->edit($id);
            if(is_object($data) && (get_class($data) == 'Exception' || get_class($data) == 'Illuminate\Database\QueryException' || get_class($data) == 'ErrorException')){
                throw new Exception($data->getMessage(),$data->getCode());
            }else{
                return view('access::'.config('app.be_view').'.access.access_edit',compact('data'));
            }
        }catch(\Exception $err){
            return back()->withInput()->with('error',$err->getMessage());
        }
    }

    public function update(Request $request, AccessAccessService $service, $id)
    {
        try{
            $rules = (new AccessAccessRequest)->rules($id);
            $request->merge(['updated_by' => Auth::user()->id]);
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return back()->withInput()->withErrors($validator);
            }else{
                try{
                    $data = $service->update($request->all(),$id);
                    if(is_object($data) && (get_class($data) == 'Exception' || get_class($data) == 'Illuminate\Database\QueryException' || get_class($data) == 'ErrorException')){
                        throw new Exception($data->getMessage(),$data->getCode());
                    }else{
                        return redirect(route('admin.v1.access.access.index'))->with('success',config('app.message_update'));
                    }
                }catch(\Exception $err){
                    return back()->withInput()->with('error',$err->getMessage());
                }
            }  
        }catch(\Exception $err){
            return back()->withInput()->with('error',$err->getMessage());
        }           
    }

    public function status(AccessAccessService $service, $id)
    {
        try{
            $data = $service->status($id);
            if(is_object($data) && (get_class($data) == 'Exception' || get_class($data) == 'Illuminate\Database\QueryException' || get_class($data) == 'ErrorException')){
                throw new Exception($data->getMessage(),$data->getCode());
            }else{
                return back()->with('success',config('app.message_success'));
            }
        }catch(\Exception $err){
            return back()->with('error',$err->getMessage());
        }
    }
    
    public function activate_selected(Request $request, AccessAccessService $service)
    {
        try{
            foreach($request->selected as $id){
                $datas = [
                    'status' => 'Active',
                ];
                $service->update($datas,$id);
            }
            return back()->with('success',config('app.message_success'));
        }catch(\Exception $err){
            return back()->with('error',$err->getMessage());
        }
    }
    
    public function inactivate_selected(Request $request, AccessAccessService $service)
    {
        try{
            foreach($request->selected as $id){
                $datas = [
                    'status' => 'Inactive',
                ];
                $service->update($datas,$id);
            }    
            return back()->with('success',config('app.message_success'));
        }catch(\Exception $err){
            return back()->with('error',$err->getMessage());
        }
    }

    public function destroy(AccessAccessService $service, $id)
    {
        try{
            $data = $service->destroy($id);
            if(is_object($data) && (get_class($data) == 'Exception' || get_class($data) == 'Illuminate\Database\QueryException' || get_class($data) == 'ErrorException')){
                throw new Exception($data->getMessage(),$data->getCode());
            }else{
                return back()->with('success',config('app.message_destroy'));
            }
        }catch(\Exception $err){
            return back()->with('error',$err->getMessage());
        }
    }

    public function destroy_selected(Request $request, AccessAccessService $service)
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