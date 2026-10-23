<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:80',
                Rule::unique('brands', 'name')->ignore($this->route('brand')),
            ],
            'description' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'   => 'Укажите название марки.',
            'name.min'        => 'Название должно быть не короче :min символов.',
            'name.max'        => 'Название не должно быть длиннее :max символов.',
            'name.unique'     => 'Марка с таким названием уже есть.',
            'description.max' => 'Описание не должно быть длиннее :max символов.',
        ];
    }
}