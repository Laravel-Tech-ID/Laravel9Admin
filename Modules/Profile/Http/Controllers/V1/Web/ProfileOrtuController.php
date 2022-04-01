<?php 

namespace Modules\Profile\Http\Controllers\V1\Web;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Modules\Personal\Entities\V1\Personal;
use Modules\Personal\Entities\V1\PersonalOrtu;
use Modules\Access\Entities\V1\User;
use Illuminate\Support\Facades\Hash;

class ProfileOrtuController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        $personal = Personal::find($personalid);
        $datas = PersonalOrtu::where('personal_id',$personalid)->paginate(10);
        DB::commit();
        return view('profile::'.config('app.be_view').'.ortu.profileortu_index', compact('personal','datas'));
    }catch(\Exception $err){
        DB::rollback();
        return back()->with('error',$err->getMessage());
    }    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $personalid = Auth::user()->personal->id;
    $personal = Personal::find($personalid);
    $refs = User::all();
    return view('profile::'.config('app.be_view').'.ortu.profileortu_create', compact('refs','personal'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $request->validate([
        'user_id' => ['required_without:ref','unique:personal_ortus,user_id,null,id,personal_id,'.$personalid],
        'jenis' => ['required','unique:personal_ortus,jenis'],
        'code' => ['required_with:ref','max:20'],
        'name' => ['required_with:ref', 'max:50'],
        'phone' => ['required_with:ref', 'max:15'],
        'email' => ['required_with:ref', 'nullable', 'email', 'max:50', 'unique:users'],
        'password' => ['required_with:ref', 'nullable', 'min:8', 'confirmed'],
        'picture' => ['file','image'],
        'ket' => 'max:255',
    ]);
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        if($request->ref){

          $uuid = Uuid::uuid6();

          $arruser = [
            'id' => $uuid,
            'code' => $request['code'],
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'status' => 'Inactive',
            'created_at' => Carbon::now()->toDateTimeString()
          ];

          if($request->has('picture')){
            $file_1 = $request['picture'];
            $file_name_1 = $uuid.'.'.$file_1->getClientOriginalExtension();
            $file_1->storeAs(config('access.private').'user',$file_name_1);
            $arruser = array_merge($arruser,['picture' => $file_name_1]);
          }

          User::create($arruser);
          $keortuanid = $uuid;
        }else{
          $keortuanid = $request->ref_ortu_id;
        }

        PersonalOrtu::create([
          'id' => Uuid::uuid6(),
          'personal_id' => $personalid,
          'user_id' => $keortuanid,
          'jenis' => $request['jenis'],
          'ket' => $request['ket'],
          'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::commit();
        return redirect(route('admin.profile.ortu.index'));
      }catch(\Exception $err){
        DB::rollback();
        return back()->withInput()->with('error',$err->getMessage());
    }    
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        $personal = Personal::find($personalid);
        $data = PersonalOrtu::find($id);
        $refs = User::all();
        DB::commit();
        return view('profile::'.config('app.be_view').'.ortu.profileortu_edit', compact('data','personal','refs'));
    }catch(\Exception $err){
        DB::rollback();
        return back()->with('error',$err->getMessage());
    }    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request,$id)
  {
    $validateData = $request->validate([
        'user_id' => ['required_without:ref','unique:personal_ortus,user_id,'.$id.',id,personal_id,'.$personalid],
        'jenis' => ['required','unique:personal_ortus,jenis,'.$id.',id'],
        'code' => ['required_with:ref','max:20'],
        'name' => ['required_with:ref', 'max:50'],
        'phone' => ['required_with:ref', 'max:15'],
        'email' => ['required_with:ref', 'nullable', 'email', 'max:50', 'unique:users,email,'.$id.',id'],
        'password' => ['required_with:ref', 'nullable', 'min:8', 'confirmed'],
        'picture' => ['file', 'image', 'max:'.config('app.max_image')],
        'ket' => 'max:255',
    ]);
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        if($request->ref){

          $uuid = Uuid::uuid6();
          $arruser = [
            'id' => $uuid,
            'code' => $request['code'],
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'status' => 'Inactive',
            'created_at' => Carbon::now()->toDateTimeString()
          ];

          if($request->has('picture')){
            $file_1 = $request['picture'];
            $file_name_1 = $uuid.'.'.$file_1->getClientOriginalExtension();
            $file_1->storeAs(config('access.private').'user',$file_name_1);
            $arruser = array_merge($arruser,['picture' => $file_name_1]);
          }

          User::create($arruser);
          $keortuanid = $uuid;
        }else{
          $keortuanid = $request->ref_ortu_id;
        }
        PersonalOrtu::find($id)->update([
          'ref_ortu_id' => $keortuanid,
          'jenis' => $request['jenis'],
          'ket' => $request['ket'],
          'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::commit();
        return redirect(route('admin.profile.ortu.index'));
    }catch(\Exception $err){
        DB::rollback();
        return back()->withInput()->with('error',$err->getMessage());
    }    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    DB::beginTransaction();
    try{
        $data = PersonalOrtu::find($id);
        User::find($data->user_id)->delete();
        $data->delete();
        DB::commit();
        return redirect(route('admin.profile.ortu.index'));
    }catch(\Exception $err){
        DB::rollback();
        return back()->with('error',$err->getMessage());
    }    
  }
  
}

?>