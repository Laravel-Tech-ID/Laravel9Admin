<?php

namespace Modules\Access\Http\Controllers\Web\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Access\Http\Requests\V1\AccessUserRequest;
use Modules\Access\Http\Services\V1\AccessUserService;
use Exception;
use Validator;

class UserController extends Controller
{
    public function index(Request $request, AccessUserService $service)
    {
        try{
            if(!isset($request->q_paging)){
                $q_paging = 10;
            }else{
                $q_paging = $request->q_paging;
            }

            $q_code = $request->q_code;
            $q_name = $request->q_name;
            $q_phone = $request->q_phone;
            $q_email = $request->q_email;
            $q_role = $request->q_role;
            $q_status = $request->q_status;

            $result = $service->index(
                $q_paging,
                $q_code,
                $q_name,
                $q_phone,
                $q_email,
                $q_role,
                $q_status
            );

            if(is_object($result) && (get_class($result) == 'Exception' || get_class($result) == 'Illuminate\Database\QueryException')){
                throw new Exception($result->getMessage(),$result->getCode());
            }else{
                $datas = $result['datas'];
                $roles = $result['roles'];
                return view('access::'.config('app.be_view').'.user.user_index',compact(
                    'datas',
                    'roles',
                    'q_paging',
                    'q_code',
                    'q_name',
                    'q_phone',
                    'q_email',
                    'q_role',
                    'q_status'
                ));
            }

        }catch(\Exception $err){
            return back()->with('error',$err->getMessage());
        }
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(AccessUserService $service)
    {
        try{
            $roles = $service->create();
            if(is_object($roles) && (get_class($roles) == 'Exception' || get_class($roles) == 'Illuminate\Database\QueryException' || get_class($roles) == 'ErrorException')){
                throw new Exception($roles->getMessage(),$roles->getCode());
            }else{
                return view('access::'.config('app.be_view').'.user.user_create',compact('roles'));
            }
        }catch(\Exception $err){
            return back()->withInput()->with('error',$err->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request, AccessUserService $service)
    {
        try{
            $rules = (new AccessUserRequest)->rules();
            $request->merge(
                [
                    'blocked' => ($request->has('blocked')) ? 1 : 0,
                    'created_by' => Auth::user()->id
                ],
            );
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()){
                return back()->withInput()->withErrors($validator);
            }else{
                try{
                    $data = $service->store($request->all());
                    if(is_object($data) && (get_class($data) == 'Exception' || get_class($data) == 'Illuminate\Database\QueryException' || get_class($data) == 'ErrorException')){
                        throw new Exception($data->getMessage(),$data->getCode());
                    }else{
                        return redirect(route('admin.v1.access.user.index'))->with('success',config('app.message_store'));
                    }
                }catch(\Exception $err){
                    return back()->withInput()->with('error',$err->getMessage());
                }
            }
        }catch(\Exception $err){
            return back()->withInput()->with('error',$err->getMessage());
        }           
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(ProfileService $service, $id)
    {
        try{
            $datas = $service->edit($id);
            $data = $datas['data'];
            $roles = $datas['roles'];
            if(is_object($data) && (get_class($data) == 'Exception' || get_class($data) == 'Illuminate\Database\QueryException' || get_class($data) == 'ErrorException')){
                throw new Exception($data->getMessage(),$data->getCode());
            }else{
                return view('access::'.config('app.be_view').'.user.user_edit', compact(
                    'data',
                    'roles'
                ));
            }
        }catch(\Exception $err){
            return back()->withInput()->with('error',$err->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    
    public function update(Request $request, AccessUserService $service, $id)
    {
        try{
            $rules = (new AccessUserRequest)->rules($id);
            $request->merge(
                [
                    'blocked' => ($request->has('blocked')) ? 1 : 0,
                    'created_by' => Auth::user()->id
                ],
            );
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()){
                return back()->withInput()->withErrors($validator);
            }else{
                try{
                    $data = $service->update($request->all(), $id);
                    if(is_object($data) && (get_class($data) == 'Exception' || get_class($data) == 'Illuminate\Database\QueryException' || get_class($data) == 'ErrorException')){
                        throw new Exception($data->getMessage(),$data->getCode());
                    }else{
                        return redirect(route('admin.v1.access.user.index'))->with('success',config('app.message_update'));
                    }
                }catch(\Exception $err){
                    return back()->withInput()->with('error',$err->getMessage());
                }
            }
        }catch(\Exception $err){
            return back()->withInput()->with('error',$err->getMessage());
        }           
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(AccessUserService $service, $id)
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

    public function destroy_selected(Request $request, AccessUserService $service)
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

    public function file(AccessUserService $service, $filename)
    {
        return $service->file($filename);
    }    

    public function image(AccessUserService $service, $filename)
    {
        return $service->file($filename);
    }    
}
