<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
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
            'user_id' => 'required,exists:users,id',
            'message' => 'required|max:20',
            'due_date' => 'required|date|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => '投稿にはユーザーIDが必要です',
            'user_id.exists' => 'ユーザーIDが存在しません。',
            'message.required' => 'タスクは必ず入力してください。',
            'message.max' => '20文字以内で入力してください',
            'due_date.required' => '日付は必ず入力してください',
            'due_date.date' => '日付で入力してください',
            'due_date.after_or_equal' => '日付は今日か今日以降で入力してください',
        ];
    }
}
