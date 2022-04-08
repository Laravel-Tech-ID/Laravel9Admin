<?php

namespace Modules\Profile\Http\Controllers\Web\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Profile\Http\Requests\V1\ProfileRequest;
use Modules\Profile\Http\Services\V1\ProfileService;
use Exception;
use Validator;

class ProfileController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */

    public function edit(ProfileService $service)
    {
        try{
            $datas = $service->edit(Auth::user()->id);
            $data = $datas['data'];
            if(is_object($data) && (get_class($data) == 'Exception' || get_class($data) == 'Illuminate\Database\QueryException' || get_class($data) == 'ErrorException')){
                throw new Exception($data->getMessage(),$data->getCode());
            }else{
                return view('profile::'.config('app.be_view').'.profile.profile_edit', compact('data'));
            }
        }catch(\Exception $err){
            return back()->withInput()->with('error',$err->getMessage());
        }
    }

    public function update(Request $request, ProfileService $service)
    {
        try{
            $rules = (new ProfileRequest)->rules(Auth::user()->id);
            $request->merge(
                [
                    'updated_by' => Auth::user()->id
                ],
            );
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()){
                return back()->withInput()->withErrors($validator);
            }else{
                try{
                    $data = $service->update($request->all(), Auth::user()->id);
                    if(is_object($data) && (get_class($data) == 'Exception' || get_class($data) == 'Illuminate\Database\QueryException' || get_class($data) == 'ErrorException')){
                        throw new Exception($data->getMessage(),$data->getCode());
                    }else{
                        return back()->with('success',config('app.message_update'));
                    }
                }catch(\Exception $err){
                    return back()->withInput()->with('error',$err->getMessage());
                }
            }
        }catch(\Exception $err){
            return back()->withInput()->with('error',$err->getMessage());
        }           
    }
}
