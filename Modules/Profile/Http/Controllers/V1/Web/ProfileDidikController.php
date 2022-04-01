<?php 

namespace Modules\Profile\Http\Controllers\V1\Web;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Modules\Reference\Entities\V1\RefSekolah;
use Modules\Personal\Entities\V1\Personal;
use Modules\Personal\Entities\V1\PersonalDidik;
use Modules\Wilayah\Entities\V1\Provinsi;

class ProfileDidikController extends Controller 
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
        $datas = PersonalDidik::where('personal_id',$personalid)->paginate(10);
        // dd($datas);
        DB::commit();
        return view('profile::'.config('app.be_view').'.didik.profiledidik_index', compact('personal','datas'));
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
    $refs = RefSekolah::all();
    $provinsis = Provinsi::all();
    return view('profile::'.config('app.be_view').'.didik.profiledidik_create', compact('refs','personal','provinsis'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $request->validate([
        'ref_sekolah_id' => ['required_without:ref'],
        'nama' => ['required_with:ref'],
        'mulai_thn' => ['required','string','max:11'],
        'lulus_thn' => ['required','string','max:11'],
        'ket' => 'max:100',
    ]);
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        if($request->ref){
          $sekolah = RefSekolah::where('nama','like','%'.$request->nama.'%')->where('tingkat',$request['tingkat'])->where('milik',$request['milik'])->first();
          if($sekolah){
            $kedidikanid = $sekolah->id;
          }else{
            $data = RefSekolah::create(
                [
                    'id' => Uuid::uuid6(),
                    'nama' => $request->nama,
                    'tingkat' => $request['tingkat'],
                    'npsn' => $request['npsn'],
                    'akreditasi' => $request['akreditasi'],
                    'milik' => $request['milik'],
                    'alamat' => $request['alamat'],
                    'ref_kabupaten_id' => $request['ref_kabupaten_id'],
                    'telp' => $request['telp'],
                    'ket' => $request['ket'],
                    'created_at' => Carbon::now()->toDateTimeString()
                ]
            )->id;
            $kedidikanid = $data;
          }
        }else{
            $kedidikanid = $request->ref_sekolah_id;
        }
        $uuid = Uuid::uuid6();
        PersonalDidik::create([
          'id' => $uuid,
          'personal_id' => $personalid,
          'ref_sekolah_id' => $kedidikanid,
          'mulai_thn' => $request->mulai_thn,
          'lulus_thn' => $request->lulus_thn,
          'ket' => $request['ket'],
          'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::commit();
        return redirect(route('admin.profile.didik.index'));
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
        $data = PersonalDidik::find($id);
        $refs = RefSekolah::all();
        $provinsis = Provinsi::all();
        DB::commit();
        return view('profile::'.config('app.be_view').'.didik.profiledidik_edit', compact('data','personal','refs','provinsis'));
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
      'ref_sekolah_id' => ['required_without:ref'],
      'nama' => ['required_with:ref'],
      'mulai_thn' => ['required','string','max:11'],
      'lulus_thn' => ['required','string','max:11'],
      'ket' => 'max:100',
    ]);
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        if($request->ref){
          $sekolah = RefSekolah::where('nama','like','%'.$request->nama.'%')->where('tingkat',$request['tingkat'])->where('milik',$request['milik'])->first();
          if($sekolah){
            $kedidikanid = $sekolah->id;
          }else{
            $data = RefSekolah::create(
                [
                    'id' => Uuid::uuid6(),
                    'nama' => $request->nama,
                    'tingkat' => $request['tingkat'],
                    'npsn' => $request['npsn'],
                    'akreditasi' => $request['akreditasi'],
                    'milik' => $request['milik'],
                    'alamat' => $request['alamat'],
                    'ref_kabupaten_id' => $request['ref_kabupaten_id'],
                    'telp' => $request['telp'],
                    'ket' => $request['ket'],
                    'created_at' => Carbon::now()->toDateTimeString()
                ]
            )->id;
            $kedidikanid = $data;
          }
        }else{
            $kedidikanid = $request->ref_sekolah_id;
        }
        $uuid = Uuid::uuid6();
        PersonalDidik::find($id)->update([
          'ref_sekolah_id' => $kedidikanid,
          'mulai_thn' => $request->mulai_thn,
          'lulus_thn' => $request->lulus_thn,
          'ket' => $request['ket'],
          'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::commit();
        return redirect(route('admin.profile.didik.index'));
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
        PersonalDidik::find($id)->delete();
        DB::commit();
        return back()->with('success','Data Berhasil Dihapus');
    }catch(\Exception $err){
        DB::rollback();
        return back()->with('error',$err->getMessage());
    }    
  }
  
}

?>