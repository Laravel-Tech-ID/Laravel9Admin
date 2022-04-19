<?php

namespace Modules\Setting\Http\Controllers\Api\V1;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\V1\Setting;
use Illuminate\Support\Facades\DB;
use App\Helpers\JsonResponse;
use Ramsey\Uuid\Uuid;
use Modules\Setting\Transformers\V1\SettingResource;
use App\Functions;
use Exception;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try{
            DB::beginTransaction();
            try{
                DB::commit();
                // throw new \Exception('Tidak Ditemukan', 404);
                $setting = new SettingResource(Setting::first());
                $api = new JsonResponse;
                return $api->success(200,$setting);
            }catch(\Exception $err){
                DB::rollback();
                $api = new JsonResponse;
                return $api->exception($err);
            }
        }catch(\Illuminate\Validation\ValidationException $err){
            $api = new JsonResponse;
            return $api->exception([422,$err->getMessage()], $err->errors());
        }catch(\Exception $err){
            $api = new JsonResponse;
            return $api->exception($err->getMessage(),$err->errors());
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('setting::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try{
            $datavalidate = [
                'initial' => ['required', 'min: 5', 'max:255'],
                'name' => ['required', 'min: 5', 'max:255'],
                'description' => ['required', 'min: 5', 'max:255'],
                'news' => ['max:255'],
                'news_desc' => ['max:255'],
                'news_background' => ['file', 'image', 'max:'.config('app.max_image')],
                'welcome' => ['max:255'],
                'welcome_desc' => ['max:255'],
                'welcome_image' => ['file', 'image', 'max:'.config('app.max_image')],
                'find_us_image' => ['file', 'image', 'max:'.config('app.max_image')],
                'testimony_category_id' => ['max:255'],
                'page_category_id' => ['max:255'],
                'testimony_background' => ['file', 'image', 'max:'.config('app.max_image')],
                'phone' => ['max:255'],
                'address_short' => ['max:255'],
                'address_long' => ['max:255'],
                'working_hour' => ['max:255'],
                'email' => ['max:255'],
                'facebook' => ['max:255'],
                'twitter' => ['max:255'],
                'google' => ['max:255'],
                'instagram' => ['max:255'],
                'award' => ['file', 'image', 'max:'.config('app.max_image')],
                'copyright' => ['max:255'],
                'about_us' => ['max:255'],
                'about_us_who' => ['max:255'],
                'about_us_what' => ['max:255'],
                'about_us_include' => ['max:255'],
                'about_us_background' => ['file', 'image', 'max:'.config('app.max_image')],
                'team' => ['max:255'],
                'team_desc' => ['max:255'],
                'contact' => ['max:255'],
                'contact_desc' => ['max:255'],
                'contact_desc_long' => ['max:255'],
                'contact_background' => ['file', 'image', 'max:'.config('app.max_image')],
                'maps_key' => ['max:255'],
                'latitude' => ['max:255'],
                'longitude' => ['max:255'],
                'api_key' => 'max:255'
            ];
            $find_setting = Setting::first();
            if($find_setting){
                $datavalidate = array_merge($datavalidate, ['logo' => ['file', 'image', 'max:'.config('app.max_image')],'login_image' => ['file', 'image', 'max:'.config('app.max_image')]]);
            }else{
                $datavalidate = array_merge($datavalidate, ['logo' => ['required', 'file', 'image', 'max:'.config('app.max_image')],'login_image' => ['required', 'file', 'image', 'max:'.config('app.max_image')]]);
            }

            $request->validate($datavalidate);
            DB::beginTransaction();
            try{
                $arrs = [
                    'initial' => $request['initial'],
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'news' => $request['news'],
                    'news_desc' => $request['news_desc'],
                    'welcome' => $request['welcome'],
                    'welcome_desc' => $request['welcome_desc'],
                    'phone' => $request['phone'],
                    'address_short' => $request['address_short'],
                    'address_long' => $request['address_long'],
                    'working_hour' => $request['working_hour'],
                    'email' => $request['email'],
                    'facebook' => $request['facebook'],
                    'twitter' => $request['twitter'],
                    'google' => $request['google'],
                    'instagram' => $request['instagram'],
                    'copyright' => $request['copyright'],
                    'about_us' => $request['about_us'],
                    'about_us_who' => $request['about_us_who'],
                    'about_us_what' => $request['about_us_what'],
                    'about_us_include' => $request['about_us_include'],
                    'team' => $request['team'],
                    'team_desc' => $request['team_desc'],
                    'contact' => $request['contact'],
                    'contact_desc' => $request['contact_desc'],
                    'contact_desc_long' => $request['contact_desc_long'],
                    'maps_key' => $request['maps_key'],
                    'latitude' => $request['latitude'],
                    'longitude' => $request['longitude'],
                    'api_key' => $request['api_key']
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
                if($request->has('news_background')){
                    $news_background = $request['news_background'];
                    $news_background_name = date('Y-m-d_hia').rand(1,10000).'.'.$news_background->getClientOriginalExtension();    
                    $news_background->storeAs(config('setting.public'),$news_background_name);
                    $arrs = array_merge($arrs,['news_background' => $news_background_name]);
                }
                if($request->has('welcome_image')){
                    $welcome_image = $request['welcome_image'];
                    $welcome_image_name = date('Y-m-d_hia').rand(1,10000).'.'.$welcome_image->getClientOriginalExtension();    
                    $welcome_image->storeAs(config('setting.public'),$welcome_image_name);
                    $arrs = array_merge($arrs,['welcome_image' => $welcome_image_name]);
                }
                if($request->has('find_us_image')){
                    $find_us_image = $request['find_us_image'];
                    $find_us_image_name = date('Y-m-d_hia').rand(1,10000).'.'.$find_us_image->getClientOriginalExtension();    
                    $find_us_image->storeAs(config('setting.public'),$find_us_image_name);
                    $arrs = array_merge($arrs,['find_us_image' => $find_us_image_name]);
                }
                if($request->has('testimony_background')){
                    $testimony_background = $request['testimony_background'];
                    $testimony_background_name = date('Y-m-d_hia').rand(1,10000).'.'.$testimony_background->getClientOriginalExtension();    
                    $testimony_background->storeAs(config('setting.public'),$testimony_background_name);
                    $arrs = array_merge($arrs,['testimony_background' => $testimony_background_name]);
                }
                if($request->has('award')){
                    $award = $request['award'];
                    $award_name = date('Y-m-d_hia').rand(1,10000).'.'.$award->getClientOriginalExtension();    
                    $award->storeAs(config('setting.public'),$award_name);
                    $arrs = array_merge($arrs,['award' => $award_name]);
                }
                if($request->has('about_us_background')){
                    $about_us_background = $request['about_us_background'];
                    $about_us_background_name = date('Y-m-d_hia').rand(1,10000).'.'.$about_us_background->getClientOriginalExtension();    
                    $about_us_background->storeAs(config('setting.public'),$about_us_background_name);
                    $arrs = array_merge($arrs,['about_us_background' => $about_us_background_name]);
                }
                if($request->has('contact_background')){
                    $contact_background = $request['contact_background'];
                    $contact_background_name = date('Y-m-d_hia').rand(1,10000).'.'.$contact_background->getClientOriginalExtension();    
                    $contact_background->storeAs(config('setting.public'),$contact_background_name);
                    $arrs = array_merge($arrs,['contact_background' => $contact_background_name]);
                }

                $find_setting = Setting::first();
                if($find_setting){
                    $setting = Setting::first()->update(
                        $arrs
                    );    
                }else{
                    $arrs = array_merge($arrs,['id' => Uuid::uuid6()]);
                    $setting = Setting::create(
                        $arrs
                    );    
                }
                DB::commit();
                $api = new JsonResponse;
                return $api->store(200,$setting);
            }catch(\Exception $err){
                DB::rollback();
                $api = new JsonResponse;
                return $api->exception($err);
            }
        }catch(\Illuminate\Validation\ValidationException $err){
            $api = new JsonResponse;
            return $api->exception([422,$err->getMessage()], $err->errors());
        }catch(\Exception $err){
            $api = new JsonResponse;
            return $api->exception($err->getMessage(),$err->errors());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('setting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('setting::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
