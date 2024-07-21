<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Authrequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function message(): array
    {
        return [
            'email.required' => 'ban chua nhap email',
            'email.email' => 'email khong dung dinh dang',
            'password.required' => 'ban chua nhap mat khau'
        ];
    }
}
