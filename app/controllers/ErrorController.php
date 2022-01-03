<?php

namespace Controllers;

use App\core\Controller;

class ErrorController extends Controller
{
    public function error(){
        header('HTTP/1.1 404 Not Found');
        return view('error');
    }
}