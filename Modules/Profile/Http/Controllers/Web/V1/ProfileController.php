<?php

namespace Modules\Profile\Http\Controllers\Web\V1;

use Auth;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Access\Entities\V1\User;
use Modules\Access\Entities\V1\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use File;
use Storage;

class ProfileController extends Controller
{

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $search = $request['search'];
            $datas = User::
            where('code','like','%'.$search.'%')
            ->orWhere('name','like','%'.$search.'%')
            ->orWhere('phone','like','%'.$search.'%')
            ->orWhere('email','like','%'.$search.'%')
            ->orWhere('status','like','%'.$search.'%')
            ->paginate(10);
            DB::commit();
            return view('profile::profile.profile_show', compact('datas','search'));
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error',$err->getMessage());
        }        }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit()
    {
        DB::beginTransaction();
        try{
            $roles = Role::all();
            $data = User::find(Auth::user()->id);
            DB::commit();
            return view('profile::'.config('app.be_view').'.profile.profile_edit', compact('data','roles'));
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error',$err->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $validateData =  $request->validate([
            'code' => ['max:20'],
            'name' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email,'.$id.',id'],
            'password' => ['nullable','string','min:8','confirmed'],
            'picture' => ['file', 'image', 'max:'.config('app.max_image')],
        ]);
        DB::beginTransaction();
        try{
            $arr = [
                'code' => $request['code'],
                'name' => $request['name'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'updated_at' => Carbon::now()->toDateTimeString()
            ];
            $data = User::find($id);
            if($request->has('picture')){
                Storage::delete(config('access.private').'user/'.$data->picture);
                $file_1 = $request['picture'];
                $file_name_1 = $id.'.'.$file_1->getClientOriginalExtension();
                $file_1->storeAs(config('access.private').'user',$file_name_1);
                $arr = array_merge($arr,['picture' => $file_name_1]);
            }
            if($request->filled('password')){
                $arr = array_merge($arr,['password' => Hash::make($request['password'])]);
            }
            $data->update($arr);
            DB::commit();
            return back()->with('success','Profile Berhasil Diubah');
        }catch(\Exception $err){
            DB::rollback();
            return back()->withInput()->with('error',$err->getMessage());
        }                   
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $data = User::find($id);
            if($data->delete())
            {
              Storage::delete(config('access.private').'user/'.$data->picture);
            }
    
            DB::commit();
            return back()->with('success','Berhasil Dihapus');
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error',$err->getMessage());
        }    
    }
    public function file($filename)
    {
      if(Storage::exists(config('access.private').'user/'.$filename)){
        return file_show(config('access.private').'user/'.$filename);
      }
      return abort(404);
    }
    public function image($filename)
    {
        if(Storage::exists(config('access.private').'user/'.$filename)){
            return file_show(config('access.private').'user/'.$filename);
        }
        return abort(404);
    }
}
