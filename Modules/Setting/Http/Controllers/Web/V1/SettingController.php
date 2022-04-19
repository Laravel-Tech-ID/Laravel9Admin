<?php

namespace Modules\Setting\Http\Controllers\Web\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Setting\Http\Requests\V1\SettingRequest;
use Modules\Setting\Http\Services\V1\SettingService;
use Validator;
use App\Functions;
use Exception;

class SettingController extends Controller
{
    public function edit(SettingService $service)
    {
        try{
            $datas = $service->edit();
            $data = $datas['data'];
            if(Functions::exception($data)){
                throw new Exception($data->getMessage(),$data->getCode());
            }else{
                return view('setting::'.config('app.be_view').'.setting_edit', compact('data'));
            }
        }catch(\Exception $err){
            return back()->withInput()->with('error',$err->getMessage());
        }
    }

    public function update(Request $request, SettingService $service)
    {
        try{
            $rules = (new SettingRequest)->rules(Auth::user()->id);
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
                    $data = $service->update($request->all());
                    if(Functions::exception($data)){
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

    public function file($filename)
    {
        if(Storage::exists(config('setting.public').$filename)){
            return file_show(config('setting.public').$filename);
        }
        return abort(404);
    }
}
