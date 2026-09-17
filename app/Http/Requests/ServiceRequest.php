<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() !== null; }
    public function rules(): array { return ['title' => ['required','string','max:150','regex:/^[\x00-\x7F]+$/'], 'description' => ['required','string','max:2000','regex:/^[\x00-\x7F]+$/'], 'icon' => ['required','in:route,ship,drop,chart'], 'sort_order' => ['required','integer','min:0','max:999']]; }
}
