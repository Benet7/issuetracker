<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Allow anyone (or adjust if you add policies later)
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'start_date'  => ['nullable','date'],
            'deadline'    => ['nullable','date','after_or_equal:start_date'],
        ];
    }
}
