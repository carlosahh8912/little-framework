<?php

$router->before('GET|POST', '/auth/.*', function () {
    if (isset($_SESSION['user_session'])) {
        back();
        exit();
    }
});



$router->mount('/auth', function () use ($router) {
    $router->get('/login', 'AuthController@login');
    $router->post('/', 'AuthController@auth');
    $router->get('/register', 'AuthController@register');
    $router->post('/create', 'AuthController@newUser');
});



$router->before('GET|POST', '/logout', function () {
    if (!isset($_SESSION['user_session'])) {
        redirect('auth/login');
        exit();
    }
});

$router->get('logout', function () {
    session()->destroy();
    redirect('auth/login');
});
