<?php

namespace App\Http\Requests\EmployeeRequests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'user_id' => 'nullable',
            'salary_id' => 'required|exists:salaries,id',
            'name' => 'required|string',
            'surname' => 'required|string',
            'father_name' => 'required|string',
            'phone' => 'required|regex:/^\+998[0-9]{9}$/',
            'address' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ];
    }
}
