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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    //pode ser que de ruim por causa dos nomes
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:80',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'required',
            'categoria_id' => 'required',

        ];
    }
}
