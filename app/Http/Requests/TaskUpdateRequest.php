<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
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
            'message' => 'required',
            'due_date' => 'date',
            'color' => 'required',
            // 'color' => 'required|regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'メッセージは必ず入力してください。',
            'due_date.date' => '日付で入力してください',
            'color.required' => '必ず入力してください',
            'color.regex' => 'hex形式で入力してください',
        ];
    }
}
