<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FleetImageRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() !== null; }
    public function rules(): array { return ['image' => [$this->route('fleet') ? 'nullable' : 'required','image','mimes:jpg,jpeg,png,webp','max:12288'], 'caption' => ['required','string','max:200','regex:/^[\x00-\x7F]+$/'], 'sort_order' => ['required','integer','min:0','max:999']]; }
}
