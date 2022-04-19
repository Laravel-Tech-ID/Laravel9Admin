<?php

namespace Modules\Auth\Http\Controllers\Api\V1;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Response;
use Modules\Access\Entities\V1\User;
use DB;
use App\Functions;
use Exception;

class AuthController extends Controller
{
    public function login()
    {
        try{
            $credentials = request(['email', 'password']);
            if (!$token = auth()->guard('api')->attempt($credentials)) {
                throw new Exception("",401);
            }else{
                return Response::true(data: $this->respondWithToken($token)->original);    
            }
        }catch(\Exception $err){
            if(in_array($err->getCode(),Response::$messages)){
                $function = "_".$err->getCode();
                return Response::$function();
            }else{
                return Response::false(message: $err->getMessage(), error_code: $err->getCode());
            }
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        DB::beginTransaction();
        try{
            $data = User::find(auth('api')->user()->id);
            if($data){
                DB::commit();
                return Response::true(data: $data);
            }else{
                if(Functions::exception($data)){
                    throw new Exception($data->getMessage(),$data->getCode());
                }else{
                    throw new Exception("",404);
                }    
            }
        }catch(\Exception $err){
            DB::rollback();
            if(in_array($err->getCode(),Response::$messages)){
                // dd('Satu');
                $function = "_".$err->getCode();
                return Response::$function();
            }else{
                return Response::false(message: $err->getMessage(), error_code: $err->getCode());
            }
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try{
            $result = auth('api')->logout();
            if(Functions::exception($result)){
                throw new Exception($data->getMessage(),$data->getCode());
            }else{
                return Response::true();
            }
        }catch(\Exception $err){
            if(in_array($err->getCode(),Response::$messages)){
                // dd('Satu');
                $function = "_".$err->getCode();
                return Response::$function();
            }else{
                return Response::false(message: $err->getMessage(), error_code: $err->getCode());
            }
        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try{
            $result = $this->respondWithToken(auth('api')->refresh());
            if(Functions::exception($result)){
                throw new Exception($data->getMessage(),$data->getCode());
            }else{
                return Response::true(data: $result->original);
            }    
        }catch(\Exception $err){
            if(in_array($err->getCode(),Response::$messages)){
                // dd('Satu');
                $function = "_".$err->getCode();
                return Response::$function();
            }else{
                return Response::false(message: $err->getMessage(), error_code: $err->getCode());
            }
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return Response::false(message: $validator->errors()->toJson(), code: 400);
        }

        DB::beginTransaction();
        try{
            $result = User::create(array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)]
            ));    
            if(is_object($result) && get_class($result) == 'Exception'){
                throw new Exception($result->getMessage(),500);
            }else{
                return Response::_201(data: $result);
            }    
        }catch(\Exception $err){
            DB::rollback();
            if($err->getCode() || $err->getCode() !== null){
                $function = "_".$err->getCode();
                return Response::$function(message: $err->getMessage());    
            }else{
                return Response::false(message: $err->getMessage());
            }
        }
    }    
}
