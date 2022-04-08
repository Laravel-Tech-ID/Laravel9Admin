<?php

namespace Modules\Access\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class AccessAccessRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($id = null)
    {
        $arr = [
            'guard_name' => 'required|string',
            'status' => 'required|string',
            'desc' => 'nullable|string'
        ];
        
        if($id){
            $arr = array_merge($arr,['name' => 'required|string|unique:accesses,name,'.$id.',id']);
        }else{
            $arr = array_merge($arr,['name' => 'required|string|unique:accesses']);
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
