<?php

namespace Controllers;

use Models\User;
use App\core\Controller;
use Progsmile\Validator\Validator;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function auth(){
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $validate = Validator::make($_REQUEST, $rules);

        dd($validate->messages());
    }
}