<?php

namespace App\core;
use Illuminate\Routing\Controller as BaseController;
use Progsmile\Validator\Validator;
use Symfony\Component\HttpFoundation\Request;

class Controller extends BaseController
{

    public $rules;
    public $userMessagges = [];

    public function validate($rules = [], $userMessagges = []){

        if(empty($rules) && !empty($this->rules) && is_array($this->rules)){
            $rules = $this->rules;
        }

        if(isset($_REQUEST)){
            $validate = Validator::make($_REQUEST, $rules, $userMessagges = []);
            return $validate;
        }

        if(isset($_POST)){
            $validate = Validator::make($_POST, $rules, $userMessagges = []);
            return $validate;
        }

        return NULL;
    }
}
