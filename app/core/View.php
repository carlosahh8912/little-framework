<?php

namespace App\core;

use eftec\bladeone\BladeOne;
use eftec\bladeonehtml\BladeOneHtml;

class View extends BladeOne
{
    use BladeOneHtml;

    public function errors()
    {
        $errorArray = getRequest();

        if(is_array($errorArray) && !empty($errorArray)){

            $errorCallback = function ($key = null) use ($errorArray) {
        
                if (array_key_exists($key, $errorArray)) {
                    return $errorArray[$key][0];
                }
        
                return false;
            };
        
            $this->setErrorFunction($errorCallback);
        }
    }
}
