<?php

namespace App\core;

use eftec\bladeone\BladeOne;
use eftec\bladeonehtml\BladeOneHtml;

class View extends BladeOne
{

    use BladeOneHtml;

    // public $views = __DIR__ . '/../resources/';
    // public $cache = __DIR__ . '/../bin/cache/';
    // public $blade;

    // public function __construct()
    // {
    //     $this->render = new BladeOne($this->views, $this->cache, Self::MODE_DEBUG); // MODE_DEBUG allows to pinpoint troubles.;
    //     // $this->render->setAuth('johndoe', 'admin'); // where johndoe is an user and admin is the role. The role is optional
        
    // }

    // public function render($view, array $data = []){

    //     // if(strpos($view, '.')){
    //     //     $strings = explode('.',$view);
    //     //     $buldView = [];
    //     //     foreach($strings as $string){
    //     //         $buldView[] = $string;
    //     //     }

    //     //     $view = implode('/', $buldView);
    //     // }

    //     echo $this->render->run("views/" . $view . ".blade.php", $data);
    // }
}
