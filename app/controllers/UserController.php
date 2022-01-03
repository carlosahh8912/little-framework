<?php

namespace Controllers;

use Models\User;
use App\core\Controller;
use Progsmile\Validator\Validator;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('users.index', compact($users));
    }

    public function register(){
        return view('auth.register');
    }

    public function store(){
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:5',
            'retipe_password' => 'required|same:password'
        ];

        $validate = Validator::make($_REQUEST, $rules);
    }
}
