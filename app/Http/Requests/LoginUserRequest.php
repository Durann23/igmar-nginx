<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'g-recaptcha-response' => 'required|captcha'
        ];
    }
    
    public function messages()
    {
        return [
            'email.required' => 'El campo de correo es obligatorio.',
            'email.email' => 'Debes ingresar un correo válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'g-recaptcha-response.required' => 'El campo captcha es obligatorio.',
            'g-recaptcha-response.captcha' => 'El campo captcha debe ser valido.'
        ];
    }
}
