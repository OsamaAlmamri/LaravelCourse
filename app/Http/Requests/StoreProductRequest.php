<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
       // return  dd($this->request);
        return [
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price'=>'required|numeric',
            'categories' => "required|array",
            'categories.*' => "required|exists:categories,id",
            'brand_id'=>'required|numeric|exists:brands,id',
            "image"=>[request()->id>0?"nullable":"required","image","max:51120"]

        ];
    }
}
