<?php

// define routes
$router->get('/', function(){

    $messages = [
        'name' => 'error desde el controlador',
        'name' => 'otro error'
    ];    
    return view('welcome', [], $messages);
});

$router->get('users', 'UserController@index');
$router->get('register', 'UserController@register');
$router->post('users/create', 'UserController@store');


$router->before('GET|POST','/login', function(){
    if (isset($_SESSION)) {
        header('location: /');
        exit();
    }
});

$router->get('login', 'AuthController@login');
$router->post('login/auth', 'AuthController@auth');


$router->get('test', function(){
    flasher('hola mundo.');
    dd($_SESSION);
});