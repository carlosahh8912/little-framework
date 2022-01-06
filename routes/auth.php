<?php

$router->before('GET|POST','/auth/.*', function(){
    if (isset($_SESSION['user_session'])) {
        back();
        exit();
    }
});

$router->get('auth/login', 'AuthController@login');
$router->post('auth', 'AuthController@auth');
$router->get('auth/register', 'AuthController@register');
$router->post('auth/create', 'AuthController@newUser');


$router->before('GET|POST','/logout', function(){
    if (!isset($_SESSION['user_session'])) {
        redirect('auth/login');
        exit();
    }
});

$router->get('logout', function(){
    session()->destroy();
    redirect('auth/login');
});