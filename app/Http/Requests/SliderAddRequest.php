<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
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
            'name' => 'bail|required|unique:sliders|max:255|min:5',
            'description'=> 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'ten khong duoc phesp de trong',
            'name.unique'  => 'Ten khoong duoc phep trung',
            'name.max' => 'ten khong duoc phesp qua 255 ki tu',
            'name.min' => 'ten khong duoc phesp duoi 55 ki tu',
            'description.required' => 'mo tata khong duoc phesp de trong',
            'image_path.required' => 'hinh anh khong duoc phesp de trong',


        ];
    }
}
