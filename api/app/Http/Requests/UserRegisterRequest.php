<?php 
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class UserRegisterRequest extends FormRequest{
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

        ], 400));
    }
    public function messages(){
        return [
            'name.required' => 'Nome é obrigatório',
            'username.min' => 'Username é no mínimo 3 caracteres',
            'username.unique' => 'Username já existente',
            'username.required'=> 'Username é obrigatório',
            'username.alpha_dash' => 'Somente letras e números',
            'email.unique' => 'Email já existente',
            'email.email' => 'Email é invalido',
            'emai.required' => 'Email é obrigatório',
            'password.min' => 'Senha muito curta'
        ];
    }

}