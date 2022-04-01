<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\JsonResponse;
use App;
use Modules\Access\Entities\User;
use Illuminate\Support\Arr;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function register(Request $request)
    {
        try{
            $arr = ['satu','dua','tiga'];
            $request->validate(
                [
                    'email' => ['required', 'email'],
                    'password' => ['required', 'confirmed', 'min:8']
                ]
            );
            DB::beginTransaction();
            try{
                DB::commit();
                throw new \Exception('Tidak Ditemukan', 404);
                // $users = User::paginate(10);
                // $api = new JsonResponse;
                // return $api->success(200,$users);
            }catch(\Exception $err){
                DB::rollback();
                $api = new JsonResponse;
                return $api->exception($err);
            }
        }catch(\Illuminate\Validation\ValidationException $err){
            $api = new JsonResponse;
            return $api->exception([422,$err->getMessage()], $err->errors());
        }catch(\Exception $err){
            $api = new JsonResponse;
            return $api->exception($err->getMessage(),$err->errors());
        }
    }

    public function login(Request $request)
    {
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {

        }
    }

    public function index()
    {
        return view('auth::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('auth::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('auth::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('auth::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
