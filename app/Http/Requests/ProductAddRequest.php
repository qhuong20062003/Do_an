<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|unique:products|max:255|min:10',
            'price'=> 'required',
            'category_id'=>'required',
            'content' =>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'ten khong duoc phesp de trong',
            'name.unique'  => 'Ten khoong duoc phep trung',
            'name.max' => 'ten khong duoc phesp qua 255 ki tu',
            'name.min' => 'ten khong duoc phesp duoi 10 ki tu',
            'price.required' => 'gia khong duoc phesp de trong',
            'category_id.required' => 'danh muc khong duoc phesp de trong',
            'content.required' => 'noi dung khong duoc phesp de trong',


        ];
    }
}
