<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoardRequest extends FormRequest
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
            'message' => 'required',
            'due_date' => 'date',
            'importance' => 'size:1',
        ];
    }

    public function messages()
    {
        return [
            'user_id.exists' => 'ユーザーIDが存在しません。',
            'message.required' => 'メッセージは必ず入力してください。',
        ];
    }
}