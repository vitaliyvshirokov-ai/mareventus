<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequestForm extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'], 'email' => ['required', 'email:rfc,dns', 'max:190'],
            'phone' => ['nullable', 'string', 'max:40'], 'company' => ['nullable', 'string', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:5000'], 'website' => ['nullable', 'max:0'],
        ];
    }
    public function messages(): array { return ['website.max' => 'Your request could not be submitted.']; }
}
