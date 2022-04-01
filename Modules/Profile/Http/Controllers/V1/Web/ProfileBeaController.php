<?php 

namespace Modules\Profile\Http\Controllers\V1\Web;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Modules\Reference\Entities\V1\RefBea;
use Modules\Personal\Entities\V1\Personal;
use Modules\Personal\Entities\V1\PersonalBea;

class ProfileBeaController extends Controller 
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
        $datas = PersonalBea::where('personal_id',$personalid)->paginate(10);
        // dd($datas);
        DB::commit();
        return view('profile::'.config('app.be_view').'.bea.profilebea_index', compact('personal','datas'));
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
    $refs = RefBea::all();
    return view('profile::'.config('app.be_view').'.bea.profilebea_create', compact('refs','personal'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $request->validate([
        'ref_bea_id' => ['required_without:ref'],
        'nama' => ['required_with:ref'],
        'thn_mulai' => ['required','string','max:11'],
        'thn_selesai' => ['required','string','max:11'],
        'instansi' => ['required','string','max:50'],
        'ket' => 'max:100',
    ]);
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        if($request->ref){
            $bea = RefBea::where('nama',$request->nama)->first();
            if($bea){
              $kebeaanid = $bea->id;
            }else{
              $data = RefBea::create(
                  [
                      'id' => Uuid::uuid6(),
                      'nama' => $request->nama    
                  ]
              )->id;
              $kebeaanid = $data;
            }
        }else{
            $kebeaanid = $request->ref_bea_id;
        }
        $uuid = Uuid::uuid6();
        PersonalBea::create([
          'id' => $uuid,
          'personal_id' => $personalid,
          'ref_bea_id' => $kebeaanid,
          'thn_mulai' => $request->thn_mulai,
          'thn_selesai' => $request->thn_selesai,
          'instansi' => $request->instansi,
          'ket' => $request['ket'],
          'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::commit();
        return redirect(route('admin.profile.bea.index'));
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
        $data = PersonalBea::find($id);
        $refs = RefBea::all();
        DB::commit();
        return view('profile::'.config('app.be_view').'.bea.profilebea_edit', compact('data','personal','refs'));
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
      'ref_bea_id' => ['required_without:ref'],
      'nama' => ['required_with:ref'],
      'thn_mulai' => ['required','string','max:11'],
      'thn_selesai' => ['required','string','max:11'],
      'instansi' => ['required','string','max:50'],
      'ket' => 'max:100',
    ]);
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        if($request->ref){
            $bea = RefBea::where('nama',$request->nama)->first();
            if($bea){
              $kebeaanid = $bea->id;
            }else{
              $data = RefBea::create(
                  [
                      'id' => Uuid::uuid6(),
                      'nama' => $request->nama    
                  ]
              )->id;
              $kebeaanid = $data;
            }
        }else{
            $kebeaanid = $request->ref_bea_id;
        }
        $uuid = Uuid::uuid6();
        PersonalBea::find($id)->update([
          'ref_bea_id' => $kebeaanid,
          'thn_mulai' => $request->thn_mulai,
          'thn_selesai' => $request->thn_selesai,
          'instansi' => $request->instansi,
          'ket' => $request->ket,
          'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::commit();
        return redirect(route('admin.profile.bea.index'));
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
        PersonalBea::find($id)->delete();
        DB::commit();
        return back()->with('success','Data Berhasil Dihapus');
    }catch(\Exception $err){
        DB::rollback();
        return back()->with('error',$err->getMessage());
    }    
  }
  
}

?>