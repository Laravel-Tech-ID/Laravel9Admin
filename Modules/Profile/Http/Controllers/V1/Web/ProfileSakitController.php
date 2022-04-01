<?php 

namespace Modules\Profile\Http\Controllers\V1\Web;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Modules\Reference\Entities\V1\RefPenyakit;
use Modules\Personal\Entities\V1\Personal;
use Modules\Personal\Entities\V1\PersonalSakit;

class ProfileSakitController extends Controller 
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
        $datas = PersonalSakit::where('personal_id',$personalid)->paginate(10);
        DB::commit();
        return view('profile::'.config('app.be_view').'.sakit.profilesakit_index', compact('personal','datas'));
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
    $refs = RefPenyakit::all();
    return view('profile::'.config('app.be_view').'.sakit.profilesakit_create', compact('refs','personal'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $request->validate([
        'ref_penyakit_id' => ['required_without:ref'],
        'nama' => ['required_with:ref'],
        'stadium' => 'max:50',
        'thn' => 'nullable|numeric',
        'pantangan' => 'max:100',
        'penanganan' => 'max:100',
        'status' => 'max:50',
        'ket' => 'max:255',
    ]);
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        if($request->ref){
          $sakit = RefPenyakit::where('nama',$request->nama)->first();
          if($sakit){
            $kesakitanid = $sakit->id;
          }else{
            $data = RefPenyakit::create(
                [
                    'id' => Uuid::uuid6(),
                    'nama' => $request->nama    
                ]
            )->id;
            $kesakitanid = $data;
          }
        }else{
            $kesakitanid = $request->ref_penyakit_id;
        }
        $uuid = Uuid::uuid6();
        PersonalSakit::create([
          'id' => $uuid,
          'personal_id' => $personalid,
          'ref_penyakit_id' => $kesakitanid,
          'stadium' => $request['stadium'],
          'thn' => $request['thn'],
          'pantangan' => $request['pantangan'],
          'penanganan' => $request['penanganan'],
          'status' => $request['status'],
          'ket' => $request['ket'],
          'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::commit();
        return redirect(route('admin.profile.sakit.index'));
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
        $data = PersonalSakit::find($id);
        $refs = RefPenyakit::all();
        DB::commit();
        return view('profile::'.config('app.be_view').'.sakit.profilesakit_edit', compact('data','personal','refs'));
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
        'ref_penyakit_id' => ['required_without:ref'],
        'nama' => ['required_with:ref'],
        'stadium' => 'max:50',
        'thn' => 'nullable|numeric',
        'pantangan' => 'max:100',
        'penanganan' => 'max:100',
        'status' => 'max:50',
        'ket' => 'max:255',
    ]);
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        if($request->ref){
          $sakit = RefPenyakit::where('nama',$request->nama)->first();
          if($sakit){
            $kesakitanid = $sakit->id;
          }else{
            $data = RefPenyakit::create(
                [
                    'id' => Uuid::uuid6(),
                    'nama' => $request->nama    
                ]
            )->id;
            $kesakitanid = $data;
          }
        }else{
            $kesakitanid = $request->ref_penyakit_id;
        }
        $uuid = Uuid::uuid6();
        PersonalSakit::find($id)->update([
          'ref_penyakit_id' => $kesakitanid,
          'ket' => $request['ket'],
          'stadium' => $request['stadium'],
          'thn' => $request['thn'],
          'pantangan' => $request['pantangan'],
          'penanganan' => $request['penanganan'],
          'status' => $request['status'],
          'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::commit();
        return redirect(route('admin.profile.sakit.index'));
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
        PersonalSakit::find($id)->delete();
        DB::commit();
        return back()->with('success','Data Berhasil Dihapus');
    }catch(\Exception $err){
        DB::rollback();
        return back()->with('error',$err->getMessage());
    }    
  }
  
}

?>