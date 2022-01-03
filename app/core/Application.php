<?php

class Application
{

    protected $db;

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->init_composer();
        $this->init_sessions();
        $this->init_env();
        $this->init_config();
        $this->init_database();
        $this->init_helpers();
        $this->init_router();
    }

    public function init_sessions()
    {
        $session = new \App\core\Session();
        return;
    }

    public function init_env()
    {
        $file = __DIR__ . "/../../.env";
        if (!file_exists($file)) {
            echo sprintf("El archivo %s no existe o no se puede acceder a el, es necesario para que la Aplicación funcione.", $file);
            return;
        }
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        return;
    }

    public function init_composer()
    {
        $file = __DIR__ . "/../../vendor/autoload.php";
        if (!file_exists($file)) {
            echo sprintf("El archivo %s no existe o no se puede acceder a el, es necesario para que la Aplicación funcione.", $file);
            return;
        }

        require_once $file;
        return;
    }

    public function init_config()
    {
        $file = __DIR__ . "/../config/app.php";
        if (!file_exists($file)) {
            echo sprintf("El archivo %s no existe o no se puede acceder a el, es necesario para que la Aplicación funcione.", $file);
            return;
        }

        require_once $file;
        return;
    }

    public function init_database()
    {

        $file = __DIR__ . "/Db.php";
        if (!file_exists($file)) {
            echo sprintf("El archivo %s no existe o no se puede acceder a el, es necesario para que la Aplicación funcione.", $file);
            return;
        }

        $this->db = new \App\core\Db;

        return;
    }

    public function init_helpers()
    {
        $file = __DIR__ . "/../helpers/helpers.php";
        if (!file_exists($file)) {
            echo sprintf("El archivo %s no existe o no se puede acceder a el, es necesario para que la Aplicación funcione.", $file);
            return;
        }

        require_once $file;
        return;
    }

    public function init_router()
    {
        $file = __DIR__ . "/Router.php";
        if (!file_exists($file)) {
            echo sprintf("El archivo %s no existe o no se puede acceder a el, es necesario para que la Aplicación funcione.", $file);
            return;
        }

        $router = new \App\core\Router;
        // $router->router_files = ['web'];
        $router->base_path = '/';
        $router->namespace_controllers = '\Controllers';
        $router->run();
        return;
    }

    public function run()
    {
        $application = new self;
        return;
    }
}
