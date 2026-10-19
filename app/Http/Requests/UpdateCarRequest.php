<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UpdateCarRequest extends FormRequest
{
    public function authorize(): bool
{
    return $this->user()->can('update', $this->route('car'));
}

    protected function prepareForValidation(): void
    {
        $this->merge(['in_stock' => $this->boolean('in_stock')]);
    }
    


    public function rules(): array
    {
        return [
            'brand_id'    => ['required', 'integer', 'exists:brands,id'],
            'title'       => ['required', 'string', 'min:2', 'max:120',
                              'regex:/^[\pL\pN\s\.\-]+$/u',
                              Rule::unique('cars', 'title')->ignore($this->route('car'))],
            'year'        => ['required', 'integer', 'between:1950,' . (date('Y') + 1)],
            'price'       => ['required', 'numeric', 'between:1,10000000'],
            'mileage'     => ['nullable', 'integer', 'min:0', 'max:2000000'],
            'description' => ['nullable', 'string', 'max:2000'],
            'in_stock'    => ['boolean'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'cover'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_cover' => ['nullable', 'boolean'],
            'attachment' => ['nullable', 'mimes:pdf', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'required'        => 'Поле «:attribute» обязательно для заполнения.',
            'title.unique'    => 'Автомобиль с таким названием уже есть.',
            'title.regex'     => 'Название может содержать только буквы, цифры, пробел, точку и дефис.',
            'brand_id.exists' => 'Выбрана несуществующая марка.',
            'year.between'    => 'Год должен быть от :min до :max.',
            'price.between'   => 'Цена должна быть от :min до :max.',
            'max'             => 'Слишком длинное значение в поле «:attribute».',
            'cover.image' => 'Файл должен быть изображением.',
            'cover.mimes' => 'Допустимые форматы: jpg, png, webp.',
            'cover.max'   => 'Размер файла не больше 2 МБ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'brand_id'    => 'марка',
            'title'       => 'название',
            'year'        => 'год выпуска',
            'price'       => 'цена',
            'mileage'     => 'пробег',
            'description' => 'описание',
            'in_stock'    => 'в наличии',
            'cover' => 'фото'
        ];
    }
    
}