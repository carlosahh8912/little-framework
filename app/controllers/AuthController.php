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

        if(!validCsrf($_REQUEST['_token'])){
            request('Token expired.');
            redirect('auth/login');
        }

        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $validate = Validator::make($_REQUEST, $rules);

        if($validate->fails()){
            request($validate->raw());
            redirect('auth/login');
            return;
        }

        $user = User::firstWhere('email', $_REQUEST['email']);

        if(!valide_password($_REQUEST['password'], $user->password)){
            setError('El usuario o la contraseña son incorrectos');
            redirect('auth/login');
        }

        userSession($user);

        redirect('');

    }

    public function register(){
        return view('auth.register');
    }

    public function newUser(){

        if(!validCsrf($_REQUEST['_token']) && $_REQUEST['_method'] != 'POST'){
            redirect('expired');
        }

        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:5',
            'retypePassword' => 'required|same:password'
        ];

        $validate = Validator::make($_REQUEST, $rules);

        if($validate->fails()){
            request($validate->raw(), $_REQUEST);
            redirect('auth/register');
        }

        $user = User::create([
            'name' => ucfirst($_REQUEST['name']),
            'email' => $_REQUEST['email'],
            'password' => password($_REQUEST['password'])
        ]);

        redirect('auth/login');
    }
}