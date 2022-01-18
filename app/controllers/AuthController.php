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

        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $validate = $this->validate($rules);

        if($validate->fails()){
            setRequest($validate->raw());
            redirect('auth/login');
            return;
        }

        $user = User::firstWhere('email', $this->request->email);

        if(!$user){
            setError('Error en la validación tu usario o contraseña no son correctos.');
            redirect($this->redirect);
        }

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

        $validate = $this->validate();

        if (User::firstWhere('email', $this->request->email)) {
            setError('El correo ya esta registrado');
            redirect($this->redirect);
        }

        if($validate->fails()){
            setRequest($validate->raw(), $this->request);
            redirect($this->redirect);
        }

        $user = User::create([
            'name' => ucwords($this->request->name),
            'email' => $this->request->email,
            'password' => password($this->request->password)
        ]);

        redirect('auth/login');
    }
}