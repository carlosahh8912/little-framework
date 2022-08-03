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

function buildComponent($component)
{
    if ($component != '') {
        if (strpos($component, '.blade.php')) {

            return 'views/' . $component;
        } else {
            if (strpos($component, '.')) {
                $strings = explode('.', $component);
                $buldView = [];
                foreach ($strings as $string) {
                    $buldView[] = $string;
                }
                $component = implode('/', $buldView);
            }
        }
        return 'components/' . $component .  render()->getFileExtension();
    }
    return;
}

function messages(string $item, string $message, string $type = 'error')
{
    return render()->message()->addItem($item, $message, $type);
}

function view($view, $data = [])
{
    $views = __DIR__ . '/../../resources/';
    $cache = __DIR__ . '/../../bin/cache/';
    $render = new \App\core\View($views, $cache, \App\core\View::MODE_AUTO);
    $render->csrf_token = csrf()->generate('_token');
    if (!empty(auth_user('name'))) {
        $render->setAuth(auth_user('name'));
    }
    $render->errors();
    $buildView = buildView($view);
    echo $render->run($buildView, $data);
    return;
}

function component($view, $data = [])
{
    $render = render();
    $buildView = buildComponent($view);
    echo $render->run($buildView, $data);
    return;
}

function session()
{
    $session_factory = new \Aura\Session\SessionFactory;
    return $session = $session_factory->newInstance($_SESSION);
}

function flasher()
{
    // if ($message) {
    //     $flasher = session()->getSegment('flasher');
    //     $flasher->setFlash($type, $message);
    // }
    return $flasher = session()->getSegment('flasher');
}

function setSuccess($message)
{
    if ($message) {
        // $flasher = session()->getSegment('flasher');
        flasher()->setFlash('success', $message);
    }
    return;
}

function setInfo($message)
{
    if ($message) {
        flasher()->setFlash('info', $message);
    }
    return;
}

function setError($message)
{
    if ($message) {
        // $flasher = session()->getSegment('flasher');
        // $flasher->setFlash('error', $message);
        flasher()->setFlash('error', $message);
    }
    return;
}

function getError()
{
    return $error = flasher()->getFlash('error');
}

function setRequest($message, $old = [])
{
    if (!empty($old) && is_array($old)) {
        $oldValues = session()->getSegment('old_values');
        foreach ($old as $key => $value) {
            $oldValues->setFlash($key, $value);
        }
    }

    if ($message) {
        $request = session()->getSegment('request');
        $request->setFlash('error', $message);
    }
    return;
}

function getRequest()
{
    $request = session()->getSegment('request');
    return $request->getFlash('error');
}

function old($value)
{
    $oldValues = session()->getSegment('old_values');
    return $oldValues->getFlash($value);
}

function csrf()
{
    $sessionProvider = new \EasyCSRF\NativeSessionProvider();
    return $easyCSRF = new \EasyCSRF\EasyCSRF($sessionProvider);
}

function validCsrf($token = "", $timespan = null, $multiple = false)
{
    try {
        if (empty($token)) {
            if (isset($_REQUEST)) {
                $token = request("_token");
            } elseif (isset($_POST)) {
                $token = post("_token");
            } elseif (isset($_GET)) {
                $token = get("_token");
            }
        }

        csrf()->check('_token', $token, $timespan, $multiple);
        return true;
    } catch (\EasyCSRF\Exceptions\InvalidCsrfTokenException $e) {
        // return $e->getMessage();
        return false;
    }
}


function route(string $route, $var = "")
{
    if ($var != "") {
        return URL . $route . '/' . $var;
    }
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

    return filter_var($str, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

function userSession($user)
{
    $session = session()->getSegment('user_session');

    $user_data = [
        'auth' => true,
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'avatar' => $user->profile_photo_path
    ];

    $session->set('user', $user_data);
    $session->set('id', $user->id);

    $session = session()->getSegment('auth');
    $session->set('user', $user);
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

function auth($key = null)
{
    if (!isset($_SESSION['auth'])) return false;

    $auth = $_SESSION['auth']; // información de la sesión del usuario actual, regresará siempre falso si no hay dicha sesión

    if (!isset($auth['user']) || empty($auth['user'])) return false;

    $user = $auth['user']; // información de la base de datos o directamente insertada del usuario

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

function redirect($location)
{
    $redirect = new \App\core\Redirect;
    return $redirect::to($location);
}

function back($location = '')
{
    $redirect = new \App\core\Redirect;

    return $redirect::back($location);
}

function post($value)
{
    if (isset($_POST)) {
        return $_POST[$value];
    }
    return NULL;
}

function get($value)
{
    if (isset($_GET)) {
        return $_GET[$value];
    }
    return NULL;
}

function request($value)
{
    if (isset($_REQUEST)) {
        return $_REQUEST[$value];
    }
    return NULL;
}

function json_output($json, $die = true)
{
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json;charset=utf-8');

    if (is_array($json)) {
        $json = json_encode($json);
    }

    echo $json;

    if ($die === true) {
        die;
    }

    return true;
}

function get_component($view, $data = [])
{
    $file_to_include = COMPONENTS . $view . '.blade.php';
    $output = '';

    // Por si queremos trabajar con objeto
    // $d = to_object($data);

    if (!is_file($file_to_include)) {
        return false;
    }

    ob_start();
    require_once $file_to_include;
    $output = ob_get_clean();

    return $output;
}
