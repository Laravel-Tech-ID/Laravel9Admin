<?php 

namespace Modules\Profile\Http\Controllers\V1\Web;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Modules\Reference\Entities\V1\RefPekerjaan;
use Modules\Personal\Entities\V1\Personal;
use Modules\Personal\Entities\V1\PersonalKerja;

class ProfileKerjaController extends Controller 
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
        $datas = PersonalKerja::where('personal_id',$personalid)->paginate(10);
        DB::commit();
        return view('profile::'.config('app.be_view').'.kerja.profilekerja_index', compact('personal','datas'));
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
    $refs = RefPekerjaan::all();
    return view('profile::'.config('app.be_view').'.kerja.profilekerja_create', compact('refs','personal'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $request->validate([
        'ref_pekerjaan_id' => ['required_without:ref'],
        'nama' => ['required_with:ref'],
        'instansi_nama' => ['required','string','max:100'],
        'instansi_alamat' => ['required','string','max:100'],
        'thn_mulai' => ['required','numeric'],
        'thn_selesai' => ['nullable','numeric'],
        'gaji' => ['required','numeric'],
        'ket' => 'max:255',
    ]);
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        if($request->ref){
          $kerja = RefPekerjaan::where('nama',$request->nama)->first();
          if($kerja){
            $kekerjaanid = $kerja->id;
          }else{
            $data = RefPekerjaan::create(
                [
                    'id' => Uuid::uuid6(),
                    'nama' => $request->nama    
                ]
            )->id;
            $kekerjaanid = $data;
          }
        }else{
            $kekerjaanid = $request->ref_pekerjaan_id;
        }
        $uuid = Uuid::uuid6();
        PersonalKerja::create([
          'id' => $uuid,
          'personal_id' => $personalid,
          'ref_pekerjaan_id' => $kekerjaanid,
          'instansi_nama' => $request->instansi_nama,
          'instansi_alamat' => $request->instansi_alamat,
          'thn_mulai' => $request->thn_mulai,
          'thn_selesai' => $request->thn_selesai,
          'gaji' => $request->gaji,
          'ket' => $request['ket'],
          'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::commit();
        return redirect(route('admin.profile.kerja.index'));
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
        $data = PersonalKerja::find($id);
        $refs = RefPekerjaan::all();
        DB::commit();
        return view('profile::'.config('app.be_view').'.kerja.profilekerja_edit', compact('data','personal','refs'));
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
        'ref_pekerjaan_id' => ['required_without:ref'],
        'nama' => ['required_with:ref'],
        'instansi_nama' => ['required','string','max:100'],
        'instansi_alamat' => ['required','string','max:100'],
        'thn_mulai' => ['required','numeric'],
        'thn_selesai' => ['nullable','numeric'],
        'gaji' => ['required','numeric'],
        'ket' => 'max:255',
    ]);
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        if($request->ref){
          $kerja = RefPekerjaan::where('nama',$request->nama)->first();
          if($kerja){
            $kekerjaanid = $kerja->id;
          }else{
            $data = RefPekerjaan::create(
                [
                    'id' => Uuid::uuid6(),
                    'nama' => $request->nama    
                ]
            )->id;
            $kekerjaanid = $data;
          }
        }else{
          $kekerjaanid = $request->ref_pekerjaan_id;
        }
        $uuid = Uuid::uuid6();
        PersonalKerja::find($id)->update([
          'ref_pekerjaan_id' => $kekerjaanid,
          'instansi_nama' => $request->instansi_nama,
          'instansi_alamat' => $request->instansi_alamat,
          'thn_mulai' => $request->thn_mulai,
          'thn_selesai' => $request->thn_selesai,
          'gaji' => $request->gaji,
          'ket' => $request['ket'],
          'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::commit();
        return redirect(route('admin.profile.kerja.index'));
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
        PersonalKerja::find($id)->delete();
        DB::commit();
        return back()->with('success','Data Berhasil Dihapus');
    }catch(\Exception $err){
        DB::rollback();
        return back()->with('error',$err->getMessage());
    }    
  }
  
}

?>