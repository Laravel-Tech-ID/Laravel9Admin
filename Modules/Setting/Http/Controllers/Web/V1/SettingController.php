<?php

namespace Modules\Setting\Http\Controllers\Web\V1;

use Illuminate\Http\Request;
use Modules\Setting\Entities\V1\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;
use Storage;

class SettingController extends Controller
{
    public function index(){
        try{
            DB::beginTransaction();
            try{
                $data = Setting::first();
                if($data){
                    DB::commit();
                    return view('setting::'.config('app.be_view').'.setting_edit', compact('data'));
                }else{
                    DB::commit();
                    return view('setting::'.config('app.be_view').'.setting_create');
                }
            }catch(\Exception $err){
                DB::rollback();
                return back()->with('error',$err->getMessage());
            }
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error',$err->getMessage());
        }
    }
    public function store(Request $request){
        $request->validate([
            'initial' => ['required', 'min: 5', 'max:255'],
            'name' => ['required', 'min: 5', 'max:255'],
            'description' => ['max:255'],
            'icon' => ['required', 'file', 'image', 'max:'.config('app.max_image')],
            'logo' => ['required', 'file', 'image', 'max:'.config('app.max_image')],
            'login_image' => ['required', 'file', 'image', 'max:'.config('app.max_image')],
            'phone' => ['max:255'],
            'address' => ['max:255'],
            'email' => ['max:255'],
            'facebook' => ['max:255'],
            'twitter' => ['max:255'],
            'google' => ['max:255'],
            'instagram' => ['max:255'],
            'copyright' => ['max:255'],
            'maps_key' => ['max:255'],
            'latitude' => ['max:255'],
            'longitude' => ['max:255'],
            'api_key' => ['max:255'],
        ]);
        DB::beginTransaction();
        try{
            $uuid = Uuid::uuid6();
            $arrs = [
                'id' => $uuid,
                'initial' => $request['initial'],
                'name' => $request['name'],
                'description' => $request['description'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'email' => $request['email'],
                'facebook' => $request['facebook'],
                'twitter' => $request['twitter'],
                'google' => $request['google'],
                'instagram' => $request['instagram'],
                'copyright' => $request['copyright'],
                'maps_key' => $request['maps_key'],
                'latitude' => $request['latitude'],
                'longitude' => $request['longitude'],
                'api_key' => $request['api_key'],
            ];
            if($request->has('icon')){
                $icon = $request['icon'];
                $icon_name = date('Y-m-d_hia').rand(1,10000).'.'.$icon->getClientOriginalExtension();    
                $icon->storeAs(config('setting.public'),$icon_name);
                $arrs = array_merge($arrs,['icon' => $icon_name]);
            }
            if($request->has('logo')){
                $logo = $request['logo'];
                $logo_name = date('Y-m-d_hia').rand(1,10000).'.'.$logo->getClientOriginalExtension();    
                $logo->storeAs(config('setting.public'),$logo_name);
                $arrs = array_merge($arrs,['logo' => $logo_name]);
            }
            if($request->has('login_image')){
                $login_image = $request['login_image'];
                $login_image_name = date('Y-m-d_hia').rand(1,10000).'.'.$login_image->getClientOriginalExtension();
                $login_image->storeAs(config('setting.public'),$login_image_name);
                $arrs = array_merge($arrs,['login_image' => $login_image_name]);
            }

            Setting::create(
                $arrs
            );

            DB::commit();
            return redirect(route('admin.v1.setting.index'));
        }catch(\Exception $err){
            DB::rollback();
            return back()->withInput()->with('error',$err->getMessage());
        }
    }
    public function update(Request $request){
        $request->validate([
            'initial' => ['required', 'min: 5', 'max:255'],
            'name' => ['required', 'min: 5', 'max:255'],
            'description' => ['max:255'],
            'logo' => ['file', 'image', 'max:'.config('app.max_image')],
            'login_image' => ['file', 'image', 'max:'.config('app.max_image')],
            'phone' => ['max:255'],
            'address' => ['max:255'],
            'email' => ['max:255'],
            'facebook' => ['max:255'],
            'twitter' => ['max:255'],
            'google' => ['max:255'],
            'instagram' => ['max:255'],
            'copyright' => ['max:255'],
            'maps_key' => ['max:255'],
            'latitude' => ['max:255'],
            'longitude' => ['max:255'],
            'api_key' => ['max:255'],
        ]);
        DB::beginTransaction();
        try{
            $setting = Setting::first();
            $arrs = [
                'initial' => $request['initial'],
                'name' => $request['name'],
                'description' => $request['description'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'email' => $request['email'],
                'facebook' => $request['facebook'],
                'twitter' => $request['twitter'],
                'google' => $request['google'],
                'instagram' => $request['instagram'],
                'copyright' => $request['copyright'],
                'maps_key' => $request['maps_key'],
                'latitude' => $request['latitude'],
                'longitude' => $request['longitude'],
                'api_key' => $request['api_key'],
            ];
            if($request->has('icon')){
                Storage::delete(config('setting.public').$setting->icon);
                $icon = $request['icon'];
                $icon_name = date('Y-m-d_hia').rand(1,10000).'.'.$icon->getClientOriginalExtension();    
                $icon->storeAs(config('setting.public'),$icon_name);
                $arrs = array_merge($arrs,['icon' => $icon_name]);
            }
            if($request->has('logo')){
                Storage::delete(config('setting.public').$setting->logo);
                $logo = $request['logo'];
                $logo_name = date('Y-m-d_hia').rand(1,10000).'.'.$logo->getClientOriginalExtension();    
                $logo->storeAs(config('setting.public'),$logo_name);
                $arrs = array_merge($arrs,['logo' => $logo_name]);
            }
            if($request->has('login_image')){
                Storage::delete(config('setting.public').$setting->login_image);
                $login_image = $request['login_image'];
                $login_image_name = date('Y-m-d_hia').rand(1,10000).'.'.$login_image->getClientOriginalExtension();
                $login_image->storeAs(config('setting.public'),$login_image_name);
                $arrs = array_merge($arrs,['login_image' => $login_image_name]);
            }

            $setting->update(
                $arrs
            );
            DB::commit();
            return redirect(route('admin.v1.setting.index'));            
        }catch(\Exception $err){
            DB::rollback();
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
