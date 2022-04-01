<?php 

namespace Modules\Profile\Http\Controllers\V1\Web;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Modules\Reference\Entities\V1\RefPrestasi;
use Modules\Personal\Entities\V1\Personal;
use Modules\Personal\Entities\V1\PersonalPrestasi;
use Storage;

class ProfilePrestasiController extends Controller 
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
        $datas = PersonalPrestasi::where('personal_id',$personalid)->paginate(10);
        DB::commit();
        return view('profile::'.config('app.be_view').'.prestasi.profileprestasi_index', compact('personal','datas'));
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
    $refs = RefPrestasi::all();
    return view('profile::'.config('app.be_view').'.prestasi.profileprestasi_create', compact('refs','personal'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $request->validate([
        'ref_prestasi_id' => ['required_without:ref'],
        'nama' => ['required_with:ref'],
        'jenis' => ['max:50'],
        'capaian' => ['max:100'],
        'tingkat' => ['max:50'],
        'tahun' => ['nullable','numeric'],
        'panitia' => ['max:100'],
        'sertifikat' => ['nullable','file','image'],
        'tropi' => ['max:10'],
        'ket' => 'max:100',
    ]);
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        if($request->ref){
            $prestasi = RefPrestasi::where('nama',$request->nama)->first();
            if($prestasi){
                $keprestasianid = $prestasi->id;
            }else{
                $data = RefPrestasi::create(
                    [
                        'id' => Uuid::uuid6(),
                        'nama' => $request->nama    
                    ]
                )->id;
                $keprestasianid = $data;    
            }
        }else{
            $keprestasianid = $request->ref_prestasi_id;
        }
        $uuid = Uuid::uuid6();
        $arr = [
          'id' => $uuid,
          'personal_id' => $personalid,
          'ref_prestasi_id' => $keprestasianid,
          'jenis' => $request['jenis'],
          'capaian' => $request['capaian'],
          'tingkat' => $request['tingkat'],
          'tahun' => $request['tahun'],
          'panitia' => $request['panitia'],
          'tropi' => $request['tropi'],
          'ket' => $request['ket'],
          'created_at' => Carbon::now()->toDateTimeString()
        ];
        if($request->has('sertifikat')){
            $file_1 = $request['sertifikat'];
            $file_name_1 = $uuid.'.'.$file_1->getClientOriginalExtension();
            $file_1->storeAs(config('personal.private').'prestasi',$file_name_1);
            $arr = array_merge($arr,['sertifikat' => $file_name_1]);
        }
        PersonalPrestasi::create($arr);

        DB::commit();
        return redirect(route('admin.profile.prestasi.index'));
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
        $data = PersonalPrestasi::find($id);
        $refs = RefPrestasi::all();
        DB::commit();
        return view('profile::'.config('app.be_view').'.prestasi.profileprestasi_edit', compact('data','personal','refs'));
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
        'ref_prestasi_id' => ['required_without:ref'],
        'nama' => ['required_with:ref'],
        'jenis' => ['max:50'],
        'capaian' => ['max:100'],
        'tingkat' => ['max:50'],
        'tahun' => ['nullable','numeric'],
        'panitia' => ['max:100'],
        'sertifikat' => ['nullable','file','image'],
        'tropi' => ['max:10'],
        'ket' => 'max:100',
    ]);
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        if($request->ref){
            $prestasi = RefPrestasi::where('nama',$request->nama)->first();
            if($prestasi){
                $keprestasianid = $prestasi->id;
            }else{
                $data = RefPrestasi::create(
                    [
                        'id' => Uuid::uuid6(),
                        'nama' => $request->nama    
                    ]
                )->id;
                $keprestasianid = $data;    
            }
        }else{
            $keprestasianid = $request->ref_prestasi_id;
        }

        $arr = [
          'ref_prestasi_id' => $keprestasianid,
          'jenis' => $request['jenis'],
          'capaian' => $request['capaian'],
          'tingkat' => $request['tingkat'],
          'tahun' => $request['tahun'],
          'panitia' => $request['panitia'],
          'tropi' => $request['tropi'],
          'ket' => $request['ket'],
          'updated_at' => Carbon::now()->toDateTimeString()
        ];
        $data = PersonalPrestasi::find($id);
        if($request->has('sertifikat')){
            Storage::delete(config('personal.private').'prestasi/'.$data->sertifikat);
            $file_1 = $request['sertifikat'];
            $file_name_1 = $id.'.'.$file_1->getClientOriginalExtension();
            $file_1->storeAs(config('personal.private').'prestasi',$file_name_1);
            $arr = array_merge($arr,['sertifikat' => $file_name_1]);
        }
        $data->update($arr);
        
        DB::commit();
        return redirect(route('admin.profile.prestasi.index'));
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
        $data = PersonalPrestasi::find($id);
        if($data->delete())
        {
          Storage::delete(config('personal.private').'prestasi/'.$data->sertifikat);
        }
        DB::commit();
        return back()->with('success','Data Berhasil Dihapus');
    }catch(\Exception $err){
        DB::rollback();
        return back()->with('error',$err->getMessage());
    }    
  }
  
  public function file($filename)
  {
    if(Storage::exists(config('personal.private').'prestasi/'.$filename)){
        return file_show(config('personal.private').'prestasi/'.$filename);
    }
    return abort(404);
  }
}

?>