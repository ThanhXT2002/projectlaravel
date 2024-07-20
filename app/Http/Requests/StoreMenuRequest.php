<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreMenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'menu_catalogue_id' => 'gt:0',
            'menu.name'=>[
                'required'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'menu_catalogue_id.gt'=>'Ban chua chon nhom vi tri cua menu ',
            'menu.name.required' => 'Ban phai chon it nhat 1 menu' 
        ];
    }
}