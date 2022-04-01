<?php 

namespace Modules\Profile\Http\Controllers\V1\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Modules\Access\Entities\V1\User;
use Modules\Access\Entities\V1\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use File;
// use Illuminate\Support\Facades\Auth;
use Modules\Personal\Entities\V1\Personal;
use Modules\Personal\Entities\V1\PersonalAhli;
use Modules\Personal\Entities\V1\PersonalAlamat;
use Modules\Personal\Entities\V1\PersonalBea;
use Modules\Personal\Entities\V1\PersonalCita;
use Modules\Personal\Entities\V1\PersonalDidik;
use Modules\Personal\Entities\V1\PersonalHobi;
use Modules\Personal\Entities\V1\PersonalKerja;
use Modules\Personal\Entities\V1\PersonalOrtu;
use Modules\Personal\Entities\V1\PersonalPrestasi;
use Modules\Personal\Entities\V1\PersonalSakit;
use Modules\Personal\Entities\V1\PersonalSehat;
use Modules\Personal\Entities\V1\PersonalSiswa;
use Modules\PPDB\Entities\V1\Pendaftaran;
use Auth;
use Storage;

class ProfilePersonalController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */

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
  public function edit()
  {
    DB::beginTransaction();
    try{
        $data = Personal::find(Auth::user()->personal->id);
        DB::commit();
        return view('profile::'.config('app.be_view').'.personal.personal_edit', compact('data'));
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
  public function update(Request $request)
  {
    $id = Auth::user()->personal->id;
    $personal = Personal::find($id);
    $val_all = [
      'code' => ['max:20'],
      'name' => ['required', 'string', 'max:50'],
      'phone' => ['required', 'string', 'max:15'],
      'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email,'.$personal->user_id.',id'],
      'password' => ['nullable', 'string', 'min:8', 'confirmed'],
      'picture' => ['file', 'image', 'max:'.config('app.max_image')],

      // ===== UNTUK SISWA =====
      // 'nis_ra' => ['nullable', 'string', 'max:100'],
      // 'nis_tk' => ['nullable', 'string', 'max:100'],
      // 'nis_sd' => ['nullable', 'string', 'max:255'],
      // 'nis_smp' => ['nullable', 'string', 'max:255'],
      // 'nis_sma' => ['nullable', 'string', 'max:255'],
      // ===== UNTUK SISWA =====
      'jk' => 'nullable|string|max:9',
      'lahir_tmpt' => 'nullable|string|max:100',
      'lahir_tgl' => 'nullable|date',
      'anak_ke' => 'nullable|numeric',
      'saudara' => 'nullable|numeric',
      'agama' => 'nullable|string|max:20',
      'negara' => 'nullable|string|max:50',
      'golongan' => 'nullable|string|max:50',
      'pangkat' => 'nullable|string|max:50',
      'berkebutuhan' => 'nullable|string|max:50',
      // ===== UNTUK SISWA =====
      // 'paud' => 'nullable|string|max:10',
      // 'tk' => 'nullable|string|max:10',
      // ===== UNTUK SISWA =====
      'nik' => 'nullable|string|max:50',
      'kps' => 'nullable|string|max:50',
      'kps_no' => 'nullable|max:50',      
    ];

    $validateData =  $request->validate($val_all);
    DB::beginTransaction();
    try{
        $arr_users = [
            'code' => $request['code'],
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'created_at' => Carbon::now()->toDateTimeString()
        ];
        if($request->has('picture')){
            $file_1 = $request['picture'];
            $file_name_1 = $id.'.'.$file_1->getClientOriginalExtension();
            $file_1->storeAs(config('access.private').'user',$file_name_1);
            $arr_users = array_merge($arr_users,['picture' => $file_name_1]);
        }
        if($request->filled('password')){
          $arr_users = array_merge($arr_users,['password' => Hash::make($request['password'])]);
        }

        $arr_personals = [
          // ===== UNTUK SISWA =====
          // 'nis_ra' => $request->nis_ra,
          // 'nis_tk' => $request->nis_tk,
          // 'nis_sd' => $request->nis_sd,
          // 'nis_smp' => $request->nis_smp,
          // 'nis_sma' => $request->nis_sma,
          // ===== UNTUK SISWA =====
          'jk' => $request->jk,
          'lahir_tmpt' => $request->lahir_tmpt,
          'lahir_tgl' => $request->lahir_tgl,
          'anak_ke' => $request->anak_ke,
          'saudara' => $request->saudara,
          'agama' => $request->agama,
          'negara' => $request->negara,
          'golongan' => $request->golongan,
          'pangkat' => $request->pangkat,
          'berkebutuhan' => $request->berkebutuhan,
          // ===== UNTUK SISWA =====
          // 'paud' => $request->paud,
          // 'tk' => $request->tk,
          // ===== UNTUK SISWA =====
          'nik' => $request->nik,
          'kps' => $request->kps,
          'kps_no' => $request->kps_no,
          'updated_at' => Carbon::now()->toDateTimeString()
        ];

        $personal->update($arr_personals);
        $user = User::find($personal->user_id);
        $user->update($arr_users);
        DB::commit();
        return back()->with('success','Data Berhasil Disimpan');
    }catch(\Exception $err){
        DB::rollback();
        return back()->withInput()->with('error',$err->getMessage());
    }    
  }

  public function file($filename)
  {
    if(Storage::exists(config('access.private').'user/'.$filename)){
      return file_show(config('access.private').'user/'.$filename);
    }
    return abort(404);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
}

?>