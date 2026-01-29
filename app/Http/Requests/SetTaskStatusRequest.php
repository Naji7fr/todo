<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SetTaskStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('task'));
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in([Task::STATUS_TODO, Task::STATUS_IN_PROGRESS, Task::STATUS_DONE])],
        ];
    }
}
