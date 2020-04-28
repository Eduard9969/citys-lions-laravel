<?php

namespace App\Http\Requests;

use http\Client\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !empty(Auth::id());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function rules(\Illuminate\Http\Request $request)
    {
        $rules = [
            'first_name' => 'min:2|max:255|required',
            'last_name'  => 'min:2|max:255|required',
        ];

        $without_pass = $request->session()->get('without_password', false);
        if (!$without_pass)
            $rules['password'] = 'required|min:5|max:255|confirmed';

        return $rules;
    }
}
