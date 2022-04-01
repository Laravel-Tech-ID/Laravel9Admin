<?php 

namespace Modules\Profile\Http\Controllers\V1\Web;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Modules\Reference\Entities\V1\RefAhli;
use Modules\Personal\Entities\V1\Personal;
use Modules\Personal\Entities\V1\PersonalAhli;
use Modules\File\Http\Controllers\V1\Web\File;
use Storage;

class ProfileAhliController extends Controller 
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
        $datas = PersonalAhli::where('personal_id',$personalid)->paginate(10);
        DB::commit();
        return view('profile::'.config('app.be_view').'.ahli.profileahli_index', compact('personal','datas'));
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
    $refs = RefAhli::all();
    return view('profile::'.config('app.be_view').'.ahli.profileahli_create', compact('refs','personal'));
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
        'ref_ahli_id' => ['required_without:ref','unique:personal_ahlis,ref_ahli_id,null,id,personal_id,'.$personalid],
        'nama' => ['required_with:ref'],
        'sertifikat' => ['nullable','file','image'],
        'ket' => 'max:255',
    ]);
    DB::beginTransaction();
    try{
        if($request->ref){
            $ahli = RefAhli::where('nama',$request->nama)->first();
            if($ahli){
              $keahlianid = $ahli->id;
            }else{
              $data = RefAhli::create(
                [
                    'id' => Uuid::uuid6(),
                    'nama' => $request->nama    
                ]
              )->id;
              $keahlianid = $data;
            }
        }else{
            $keahlianid = $request->ref_ahli_id;
        }
        $uuid = Uuid::uuid6();
        $arr = [
          'id' => $uuid,
          'personal_id' => $personalid,
          'ref_ahli_id' => $keahlianid,
          'ket' => $request['ket'],
          'created_at' => Carbon::now()->toDateTimeString()
        ];
        if($request->has('sertifikat')){
            $file_1 = $request['sertifikat'];
            $file_name_1 = $uuid.'.'.$file_1->getClientOriginalExtension();
            $file_1->storeAs(config('personal.private').'ahli',$file_name_1);
            $arr = array_merge($arr,['sertifikat' => $file_name_1]);
        }
        PersonalAhli::create($arr);
        DB::commit();
        return redirect(route('admin.profile.ahli.index'));
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
        $data = PersonalAhli::find($id);
        $refs = RefAhli::all();
        DB::commit();
        return view('profile::'.config('app.be_view').'.ahli.profileahli_edit', compact('data','personal','refs'));
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
        'ref_ahli_id' => ['required_without:ref','unique:personal_ahlis,ref_ahli_id,'.$id.',id,personal_id,'.$personalid],
        'nama' => ['required_with:ref'],
        'sertifikat' => ['nullable','file','image'],
        'ket' => 'max:255',
    ]);
    DB::beginTransaction();
    try{
        if($request->ref){
            $ahli = RefAhli::where('nama',$request->nama)->first();
            if($ahli){
              $keahlianid = $ahli->id;
            }else{
              $data = RefAhli::create(
                [
                    'id' => Uuid::uuid6(),
                    'nama' => $request->nama    
                ]
              )->id;
              $keahlianid = $data;
            }
        }else{
            $keahlianid = $request->ref_ahli_id;
        }
        $arr = [
          'ref_ahli_id' => $keahlianid,
          'ket' => $request['ket'],
          'updated_at' => Carbon::now()->toDateTimeString()
        ];
        $data = PersonalAhli::find($id);
        if($request->has('sertifikat')){
            Storage::delete(config('personal.private').'ahli/'.$data->sertifikat);
            $file_1 = $request['sertifikat'];
            $file_name_1 = $id.'.'.$file_1->getClientOriginalExtension();
            $file_1->storeAs(config('personal.private').'ahli',$file_name_1);
            $arr = array_merge($arr,['sertifikat' => $file_name_1]);
        }
        $data->update($arr);
        DB::commit();
        return redirect(route('admin.profile.ahli.index'));
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
        $data = PersonalAhli::find($id);
        if($data->delete())
        {
          Storage::delete(config('personal.private').'ahli/'.$data->sertifikat);
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
    if(Storage::exists(config('personal.private').'ahli/'.$filename)){
      return file_show(config('personal.private').'ahli/'.$filename);
    }
    return abort(404);
  }
  
}

?>