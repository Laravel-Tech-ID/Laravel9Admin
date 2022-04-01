<?php 

namespace Modules\Profile\Http\Controllers\V1\Web;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Modules\Personal\Entities\V1\Personal;
use Modules\Personal\Entities\V1\PersonalSehat;

class ProfileSehatController extends Controller 
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
        $datas = PersonalSehat::where('personal_id',$personalid)->paginate(10);
        DB::commit();
        return view('profile::'.config('app.be_view').'.sehat.profilesehat_index', compact('personal','datas'));
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
    return view('profile::'.config('app.be_view').'.sehat.profilesehat_create', compact('personal'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'tanggal' => 'date',
      'tinggi' => 'nullable|numeric',
      'berat' => 'nullable|numeric',
      'ket' => 'max:255',
    ]);
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        $uuid = Uuid::uuid6();
        PersonalSehat::create([
          'id' => $uuid,
          'personal_id' => $personalid,
          'tanggal' => $request['tanggal'],
          'tinggi' => $request['tinggi'],
          'berat' => $request['berat'],
          'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::commit();
        return redirect(route('admin.profile.sehat.index'));
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
        $data = PersonalSehat::find($id);
        DB::commit();
        return view('profile::'.config('app.be_view').'.sehat.profilesehat_edit', compact('data','personal'));
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
        'tanggal' => 'date',
        'tinggi' => 'nullable|numeric',
        'berat' => 'nullable|numeric',
        'ket' => 'max:255',
    ]);
    DB::beginTransaction();
    try{
        $personalid = Auth::user()->personal->id;
        $uuid = Uuid::uuid6();
        PersonalSehat::find($id)->update([
          'tanggal' => $request['tanggal'],
          'tinggi' => $request['tinggi'],
          'berat' => $request['berat'],
          'ket' => $request['ket'],
          'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::commit();
        return redirect(route('admin.profile.sehat.index'));
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
        PersonalSehat::find($id)->delete();
        DB::commit();
        return back()->with('success','Data Berhasil Dihapus');
    }catch(\Exception $err){
        DB::rollback();
        return back()->with('error',$err->getMessage());
    }    
  }
  
}

?>