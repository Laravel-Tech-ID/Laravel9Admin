<?php

namespace Modules\Access\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class AccessUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($id = null)
    {
        $arr = [
            'code' => 'max:20',
            'name' => 'required|string|max:50',
            'phone' => 'required|string|max:15',
            'status' => 'string|max:10',
            'role' => 'required|array|min:1',
            'picture' => 'file|image|max:'.config('app.max_image'),
            'blocked_reason' => 'required_if:blocked,1|max:255',
        ];
        
        if($id){
            $arr = array_merge($arr,['email' => 'required|string|unique:users,email,'.$id.',id']);
            $arr = array_merge($arr,['password' => 'nullable|string|min:8|confirmed']);
            $arr = array_merge($arr,['password_confirmation' => 'required_with:password']);

        }else{
            $arr = array_merge($arr,['email' => 'required|string|unique:users']);
            $arr = array_merge($arr,['password' => 'required|string|min:8|confirmed']);
            $arr = array_merge($arr,['password_confirmation' => 'required']);
        }
        return $arr;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
