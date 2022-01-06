<?php

namespace Controllers;

use Models\User;
use App\core\Controller;
use Progsmile\Validator\Validator;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show($id){
        $user = User::find($id);

        dd($user);
    }
}
