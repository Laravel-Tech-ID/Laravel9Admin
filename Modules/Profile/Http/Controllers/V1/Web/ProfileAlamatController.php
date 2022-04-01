<?php 

namespace Modules\Profile\Http\Controllers\V1\Web;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Modules\Personal\Entities\V1\Personal;
use Modules\Personal\Entities\V1\PersonalAlamat;
use Modules\Wilayah\Entities\V1\Provinsi;

class ProfileAlamatController extends Controller 
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
        $datas = PersonalAlamat::where('personal_id',$personalid)->paginate(10);
        DB::commit();
        return view('profile::'.config('app.be_view').'.alamat.profilealamat_index', compact('personal','datas'));
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
    $provinsis = Provinsi::all();
    return view('profile::'.config('app.be_view').'.alamat.profilealamat_create', compact('personal','provinsis'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'desa_id' => 'required|string|max:50',
      'dusun' => 'nullable|string|max:50',
      'jln' => 'nullable|string|max:100',
      'kodepos' => 'nullable|string|max:10',
      'rt' => 'nullable|string|max:10',
      'rw' => 'nullable|string|max:10',
      'tinggal' => 'nullable|string|max:50',
      'transport' => 'nullable|string|max:100',
      'jarak_status' => 'nullable|string|max:255',
      'jarak_jml' => 'nullable|numeric',
      'waktu_jam' => 'nullable|max:255',
      'waktu_menit' => 'nullable|string|max:255',
      'ket' => 'max:255',
    ]);
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        $uuid = Uuid::uuid6();
        PersonalAlamat::create([
          'id' => $uuid,
          'personal_id' => $personalid,
          'desa_id' => $request->desa_id,
          'jln' => $request->jln,
          'dusun' => $request->dusun,
          'rt' => $request->rt,
          'rw' => $request->rw,
          'tinggal' => $request->tinggal,
          'kodepos' => $request->kodepos,
          'transport' => $request->transport,
          'jarak_status' => $request->jarak_status,
          'jarak' => $request->jarak,
          'waktu_jam' => $request->waktu_jam,
          'waktu_menit' => $request->waktu_menit,
          'ket' => $request->ket,
          'created_at' => Carbon::now()->toDateTimeString()
      ]);
        DB::commit();
        return redirect(route('admin.profile.alamat.index'));
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
        $data = PersonalAlamat::find($id);
        $provinsis = Provinsi::all();
        DB::commit();
        return view('profile::'.config('app.be_view').'.alamat.profilealamat_edit', compact('data','personal','provinsis'));
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
      'desa_id' => 'required|string|max:50',
      'dusun' => 'nullable|string|max:50',
      'jln' => 'nullable|string|max:100',
      'kodepos' => 'nullable|string|max:10',
      'rt' => 'nullable|string|max:10',
      'rw' => 'nullable|string|max:10',
      'tinggal' => 'nullable|string|max:50',
      'transport' => 'nullable|string|max:100',
      'jarak_status' => 'nullable|string|max:255',
      'jarak_jml' => 'nullable|numeric',
      'waktu_jam' => 'nullable|max:255',
      'waktu_menit' => 'nullable|string|max:255',
      'ket' => 'max:255',
    ]);
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        PersonalAlamat::find($id)->update([
          'personal_id' => $personalid,
          'desa_id' => $request->desa_id,
          'jln' => $request->jln,
          'dusun' => $request->dusun,
          'rt' => $request->rt,
          'rw' => $request->rw,
          'tinggal' => $request->tinggal,
          'kodepos' => $request->kodepos,
          'transport' => $request->transport,
          'jarak_status' => $request->jarak_status,
          'jarak' => $request->jarak,
          'waktu_jam' => $request->waktu_jam,
          'waktu_menit' => $request->waktu_menit,
          'ket' => $request->ket,
          'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::commit();
        return redirect(route('admin.profile.alamat.index'));
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
        PersonalAlamat::find($id)->delete();
        DB::commit();
        return back()->with('success','Data Berhasil Dihapus');
    }catch(\Exception $err){
        DB::rollback();
        return back()->with('error',$err->getMessage());
    }    
  }
  
}

?>