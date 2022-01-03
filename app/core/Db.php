<?php

namespace App\core;

use Illuminate\Database\Capsule\Manager as Capsule;

class Db
{

    // Set the event dispatcher used by Eloquent models... (optional)
    // use Illuminate\Events\Dispatcher;
    // use Illuminate\Container\Container;

    public function __construct()
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => DB_DRIVER,
            'host' => DB_HOST,
            'database' => DB_DATABASE,
            'username' => DB_USERNAME,
            'password' => DB_PASSWORD,
            'charset' => DB_CHARSET,
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);


        // $capsule->setEventDispatcher(new Dispatcher(new Container));

        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }
}
