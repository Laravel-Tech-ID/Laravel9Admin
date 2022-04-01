<?php

namespace Modules\Access\Http\Controllers\V1\Web;

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
// use Illuminate\Support\Facades\Auth;
use Storage;

class UserController extends Controller
{
    public function index(Request $request){
        DB::beginTransaction();
        try{
            $search = $request['search'];
            $users = User::
            where('code','like','%'.$search.'%')
            ->orWhere('name','like','%'.$search.'%')
            ->orWhere('phone','like','%'.$search.'%')
            ->orWhere('email','like','%'.$search.'%')
            ->orWhere('status','like','%'.$search.'%')
            ->paginate(10);
            DB::commit();
            return view('access::'.config('app.be_view').'.user.user_index',compact('users','search'));
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error',$err->getMessage());
        }
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        DB::beginTransaction();
        try{
            $roles = Role::all();
            DB::commit();
            return view('access::'.config('app.be_view').'.user.user_create',compact('roles'));
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error',$err->getMessage());
        }    
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validateData =  $request->validate([
            'code' => ['max:20'],
            'name' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'status' => ['string', 'max:10'],
            'role' => ['required', 'array', 'min:1'],
            'picture' => ['file', 'image', 'max:'.config('app.max_image')],
            'blocked' => ['required_with:blocked_reason'],
            'blocked_reason' => ['required_with:blocked,true','max:255'],
        ]);
        DB::beginTransaction();
        try{
            $uuid = Uuid::uuid6();
            $arr = [
                'id' => $uuid,
                'code' => $request['code'],
                'name' => $request['name'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'status' => $request['status'],
                'blocked' => ($request->has('blocked')) ? 1 : 0,
                'blocked_reason' => $request['blocked_reason'],
                'created_at' => Carbon::now()->toDateTimeString()
            ];
            if($request->has('picture')){
                $file_1 = $request['picture'];
                $file_name_1 = $uuid.'.'.$file_1->getClientOriginalExtension();
                $file_1->storeAs(config('access.private').'user',$file_name_1);
                $arr = array_merge($arr,['picture' => $file_name_1]);
            }

            $user = User::create($arr);
            
            $user->assignRole($request['role']);    
            DB::commit();
            return redirect(route('admin.access.user.index'));
        }catch(\Exception $err){
            DB::rollback();
            return back()->withInput()->with('error',$err->getMessage());
        }           
    }

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
            $users = User::
            where('code','like','%'.$search.'%')
            ->orWhere('name','like','%'.$search.'%')
            ->orWhere('phone','like','%'.$search.'%')
            ->orWhere('email','like','%'.$search.'%')
            ->orWhere('status','like','%'.$search.'%')
            ->paginate(10);
            DB::commit();
            return view('access::user.user_show', compact('users','search'));
        }catch(\Exception $err){
            DB::rollback();
            return back()->with('error',$err->getMessage());
        }        }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        DB::beginTransaction();
        try{
            $roles = Role::all();
            $user = User::find($id);
            DB::commit();
            return view('access::'.config('app.be_view').'.user.user_edit', compact('user','roles'));
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
    public function update(Request $request, $id)
    {
        $validateData =  $request->validate([
            'code' => ['max:20'],
            'name' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email,'.$id.',id'],
            'password' => ['nullable','string','min:8','confirmed'],
            'status' => ['string', 'max:10'],
            'role' => ['required', 'array', 'min:1'],
            'picture' => ['file', 'image', 'max:'.config('app.max_image')],
            'blocked' => ['required_with:blocked_reason'],
            'blocked_reason' => ['required_with:blocked,true','max:255'],
        ]);
        DB::beginTransaction();
        try{
            $arr = [
                'code' => $request['code'],
                'name' => $request['name'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'status' => $request['status'],
                'blocked' => ($request->has('blocked')) ? 1 : 0,
                'blocked_reason' => $request['blocked_reason'],
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
            $data->refreshRole($request['role']);

            DB::commit();
            return redirect(route('admin.access.user.index'));
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
            if($data->delete()){
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
