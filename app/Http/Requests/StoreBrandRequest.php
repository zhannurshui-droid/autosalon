<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
{
    public function authorize(): bool { return true; }

public function rules(): array
{
    return [
        'name'        => ['required', 'string', 'min:2', 'max:100', 'unique:brands,name'],
        'description' => ['nullable', 'string', 'max:1000'],
    ];
}

public function messages(): array
{
    return [
        'required'    => 'Поле «:attribute» обязательно для заполнения.',
        'name.unique' => 'Такая марка уже есть.',
    ];
}
}
