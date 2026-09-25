<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       return auth()->user()?->isAdmin() ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_id' => ['required','exists:projects,id',],

           'assigned_to' => ['required', 'integer',
                Rule::exists('users', 'id')
                    ->where(fn ($query) => $query->where('role', 'employee')),
            ],
            'title' => ['required', 'string', 'max:255',],
            'description' => ['nullable', 'string', 'max:5000',],
            'priority' => ['required', 'in:low,medium,high'],
            'status' => ['required', 'in:pending,in_progress,completed,cancelled'],
            'due_date' => ['nullable', 'date',],
        ];
    }
}
