<?php

namespace App\core;
use Illuminate\Routing\Controller as BaseController;
use Progsmile\Validator\Validator;
use Symfony\Component\HttpFoundation\Request;

class Controller extends BaseController
{

    public $rules;
    public $userMessagges = [];
    public Request $requestBag;
    protected $request;
    protected $redirect;

    function __construct()
    {
        $this->requestBag = Request::createFromGlobals();
        $this->request = (object) $this->requestBag->request->all();
        $this->redirect = $this->requestBag->server->get('HTTP_REFERER');

        if ($this->requestBag->getMethod() == 'POST') {
            if(!validCsrf()){
                redirect('expired');
            }
        }
    }

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

    public function back(){
        if ($this->redirect = '') {
            header('Location: ' . URL);
            die();
        }

        if ($this->redirect) {
            header('Location: ' . $this->redirect);
            die();
        }
    }
}
