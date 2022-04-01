<?php 

namespace Modules\Profile\Http\Controllers\V1\Web;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Modules\Reference\Entities\V1\RefHobi;
use Modules\Personal\Entities\V1\Personal;
use Modules\Personal\Entities\V1\PersonalHobi;

class ProfileHobiController extends Controller 
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
        $datas = PersonalHobi::where('personal_id',$personalid)->paginate(10);
        DB::commit();
        return view('profile::'.config('app.be_view').'.hobi.profilehobi_index', compact('personal','datas'));
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
    $refs = RefHobi::all();
    return view('profile::'.config('app.be_view').'.hobi.profilehobi_create', compact('refs','personal'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $personalid = Auth::user()->personal->id;
    $request->validate([
        'ref_hobi_id' => ['required_without:ref','unique:personal_hobis,ref_hobi_id,null,id,personal_id,'.$personalid],
        'nama' => ['required_with:ref'],
        'ket' => 'max:255',
    ]);
    DB::beginTransaction();
    try{
        if($request->ref){
          $hobi = RefHobi::where('nama',$request->nama)->first();
          if($hobi){
            $kehobianid = $hobi->id;
          }else{
            $data = RefHobi::create(
                [
                    'id' => Uuid::uuid6(),
                    'nama' => $request->nama    
                ]
            )->id;
            $kehobianid = $data;
          }
        }else{
          $kehobianid = $request->ref_hobi_id;
        }
        $uuid = Uuid::uuid6();
        PersonalHobi::create([
          'id' => $uuid,
          'personal_id' => $personalid,
          'ref_hobi_id' => $kehobianid,
          'ket' => $request['ket'],
          'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::commit();
        return redirect(route('admin.profile.hobi.index'));
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
        $data = PersonalHobi::find($id);
        $refs = RefHobi::all();
        DB::commit();
        return view('profile::'.config('app.be_view').'.hobi.profilehobi_edit', compact('data','personal','refs'));
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
    $personalid = Auth::user()->personal->id;
    $validateData = $request->validate([
        'ref_hobi_id' => ['required_without:ref','unique:personal_hobis,ref_hobi_id,'.$id.',id,personal_id,'.$personalid],
        'nama' => ['required_with:ref'],
        'ket' => 'max:255',
    ]);
    DB::beginTransaction();
    try{
        if($request->ref){
          $hobi = RefHobi::where('nama',$request->nama)->first();
          if($hobi){
            $kehobianid = $hobi->id;
          }else{
            $data = RefHobi::create(
                [
                    'id' => Uuid::uuid6(),
                    'nama' => $request->nama    
                ]
            )->id;
            $kehobianid = $data;
          }
        }else{
            $kehobianid = $request->ref_hobi_id;
        }
        $uuid = Uuid::uuid6();
        PersonalHobi::find($id)->update([
          'ref_hobi_id' => $kehobianid,
          'ket' => $request['ket'],
          'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::commit();
        return redirect(route('admin.profile.hobi.index'));
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
        PersonalHobi::find($id)->delete();
        DB::commit();
        return back()->with('success','Data Berhasil Dihapus');
    }catch(\Exception $err){
        DB::rollback();
        return back()->with('error',$err->getMessage());
    }    
  }
  
}

?>