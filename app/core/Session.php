<?php

namespace App\core;

class Session
{

    public function __construct()
    {
        if (!session_id()) @session_start();
    }
}
