<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'icon' => [
                'nullable',
                'mimes:jpeg,png',
            ],

            'name' => [
                'required',
                'max:20',
            ],

            'postal_code' => [
                'required',
                'regex:/^\d{3}-\d{4}$/',
                'size:8',
            ],

            'address' => [
                'required',
            ],

            'building_name' => [
                'nullable',
            ],
        ];
    }

    public function messages()
    {
        return [
            'icon.mimes' => 'プロフィール画像はjpegまたはpng形式でアップロードしてください。',
            'name.required'=> 'お名前を入力してください。',
            'name.max'=> 'お名前は20文字以内で入力してください。',
            'postal_code.required' => '郵便番号を入力してください。',
            'postal_code.regex' => '郵便番号は 123-4567 の形式で入力してください。',
            'postal_code.size' => '郵便番号は8文字で入力してください。',
            'address.required' => '住所を入力してください。',
        ];
    }
}
