<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
{
    return true;   // доступ закрывает middleware auth в маршруте
}

public function rules(): array
{
    return [
        'phone'   => ['required', 'regex:/^\+7\d{10}$/'],
        'comment' => ['nullable', 'string', 'max:500'],
    ];
}

public function messages(): array
{
    return [
        'phone.required' => 'Введите номер телефона.',
        'phone.regex'    => 'Номер должен быть в формате +7XXXXXXXXXX (например, +77011234567).',
        'comment.max'    => 'Комментарий не длиннее 500 символов.',
    ];
}
}
