<?php

function render()
{
    $views = __DIR__ . '/../../resources/';
    $cache = __DIR__ . '/../../bin/cache/';
    return $render = new \App\core\View($views, $cache, \App\core\View::MODE_AUTO);
}

function buildView($view)
{
    if ($view != '') {
        if (strpos($view, '.blade.php')) {

            return 'views/' . $view;
        } else {
            if (strpos($view, '.')) {
                $strings = explode('.', $view);
                $buldView = [];
                foreach ($strings as $string) {
                    $buldView[] = $string;
                }
                $view = implode('/', $buldView);
            }
        }
        return 'views/' . $view .  render()->getFileExtension();
    }
    return;
}

function messages(string $item, string $message, string $type = 'error')
{
    return render()->message()->addItem($item, $message, $type);
}

function view($view, $data = [], $messages = [])
{
    $views = __DIR__ . '/../../resources/';
    $cache = __DIR__ . '/../../bin/cache/';
    $render = new \App\core\View($views, $cache, \App\core\View::MODE_AUTO);
    if ($messages) {
        foreach($messages as $key => $message){
            $render->message()->addItem($key, $message);
        }
    }
    $render->message()->addItem('name', 'otro error mas helper');

    $buildView = buildView($view);
    echo $render->run($buildView, $data);
    return;
}


function route(string $route)
{
    return URL . $route;
}

function asset(string $asset)
{
    return ASSETS . $asset;
}

function clean($str, $cleanhtml = false)
{
    $str = @trim(@rtrim($str));

    // if (get_magic_quotes_gpc()) {
    // 	$str = stripslashes($str);
    // }

    if ($cleanhtml === true) {
        return htmlspecialchars($str);
    }

    return filter_var($str, FILTER_SANITIZE_STRING);
}

function auth_user($key = null)
{
    if (!isset($_SESSION['user_session'])) return false;

    $session = $_SESSION['user_session']; // información de la sesión del usuario actual, regresará siempre falso si no hay dicha sesión

    if (!isset($session['user']) || empty($session['user'])) return false;

    $user = $session['user']; // información de la base de datos o directamente insertada del usuario

    if ($key === null) return $user;

    if (!isset($user[$key])) return false; // regresará falso en caso de no encontrar el key buscado

    // Regresa la información del usuario
    return $user[$key];
}

// function new_password($password = null, $options = ['cost' => 10])
// {
//     $password = $password === null ? rand_password() : $password;

//     return password_hash($password . $_ENV['AUTH_SALT'], PASSWORD_BCRYPT, $options);
// }

function password($password, $options = ['cost' => 10])
{
    return password_hash($password . $_ENV['AUTH_SALT'], PASSWORD_BCRYPT, $options);
}

function valide_password($post_password, $password)
{
    return password_verify($post_password . $_ENV['AUTH_SALT'], $password);
}

// function redirect(){
//     $urlGenerator = new \Illuminate\Routing\UrlGenerator();
//     $redirect = new \App\core\Redirect($urlGenerator);
// }

function flasher($message, $type = 'success'){
    // $flasher = new \Flasher\Prime\FlasherInterface;
    // return $flasher->addFlash($message);

}
