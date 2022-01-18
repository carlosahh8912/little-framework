<?php

// define routes
$router->get('/', function () {
    return view('welcome');
});

// Middelware
$router->before('GET|POST', 'users', function () {
    if (!isset($_SESSION['user_session'])) {
        redirect("auth/login");
        exit();
    }
});

$router->before('GET|POST|PUT', 'users/.*', function () {
    if (!isset($_SESSION['user_session'])) {
        redirect("auth/login");
        exit();
    }
});


$router->mount('/users', function () use ($router) {

    $router->get('/', 'UserController@index');
    $router->get('/(\d+)', 'UserController@show');
    $router->get('/(\d+)/edit', 'UserController@edit');
    $router->match('PUT|PATCH','/(\d+)/update' ,'UserController@update');
    
});





$router->get('test', function () {
    dd($_SESSION);
});
