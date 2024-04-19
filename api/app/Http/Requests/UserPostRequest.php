<?php 
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class UserPostRequest extends FormRequest{
    public function rules(){
        return [
            'name' => 'required',
            'username' => 'required|min:3|alpha_dash|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4'
        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => 'Validation errors',

            'data'      => $validator->errors()

        ]));
    }
    public function messages(){
        return [
            'name.required' => 'Nome é obrigatório',
            'username.min' => 'Nome de usuário é no mínimo 3 caracteres',
            'username.unique' => 'Nome de usuário já existente',
            'email.unique' => 'Email já existente',
            'email.email' => 'Email é invalido',
            'password.min' => 'Senha muito curta'
        ];
    }

}