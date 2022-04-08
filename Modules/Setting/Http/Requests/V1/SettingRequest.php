<?php

namespace Modules\Setting\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($id = null)
    {
        $arr = [
            'initial' => 'required|min: 5|max:255',
            'name' => 'required|min: 5|max:255',
            'description' => 'max:255',
            'icon' => 'required|file|image|max:'.config('app.max_image'),
            'logo' => 'required|file|image|max:'.config('app.max_image'),
            'login_image' => 'required|file|image|max:'.config('app.max_image'),
            'phone' => 'max:255',
            'address' => 'max:255',
            'email' => 'max:255',
            'facebook' => 'max:255',
            'twitter' => 'max:255',
            'google' => 'max:255',
            'instagram' => 'max:255',
            'copyright' => 'max:255',
            'maps_key' => 'max:255',
            'latitude' => 'max:255',
            'longitude' => 'max:255',
            'api_key' => 'max:255',

        ];
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
