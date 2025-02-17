<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralProductRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:5|max:100',
            'description' => 'required|min:5|max:1000',
            'short_description' => 'nullable|min:5|max:200',
            'slug' => 'required|min:5|max:190|unique:products,slug'.$this->id,
            'categories'=>'required|array|min:1',
            'categories.*'=>'numeric|exists:categories,id',
            'brand_id'=>'required|numeric|exists:brands,id',
            'tags'=>'nullable|array|min:1',
            'tags.*'=>'numeric|exists:tags,id',
        ];
    }

    public function messages(): array
    {
        return [

        ];
    }

}
