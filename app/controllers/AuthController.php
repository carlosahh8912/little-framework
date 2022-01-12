<?php

namespace Controllers;

use Models\User;
use App\core\Controller;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends Controller
{
    public $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'password' => 'required|min:5',
        'retypePassword' => 'required|same:password'
    ];

    public function login(){
        return view('auth.login');
    }

    public function auth(){

        if(!validCsrf()){
            setError('Token expired.');
            redirect('auth/login');
        }

        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        // $validate = Validator::make($_REQUEST, $rules);
        $validate = $this->validate($rules);

        if($validate->fails()){
            setRequest($validate->raw());
            redirect('auth/login');
            return;
        }

        $user = User::firstWhere('email', post('email'));

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

        if(!validCsrf() && post('_method') != 'POST'){
            redirect('expired');
        }

        $this->request;
        // $request = Request::createFromGlobals();

        dd($this->request);
        return;

        // $validate = Validator::make($_REQUEST, $rules);
        $validate = $this->validate();

        if($validate->fails()){
            setRequest($validate->raw(), $_REQUEST);
            redirect('auth/register');
        }

        $user = User::create([
            'name' => ucfirst(request('name')),
            'email' => request('email'),
            'password' => password(request('password'))
        ]);

        redirect('auth/login');
    }
}