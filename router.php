<?php
require_once 'libs/response.php';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';
require_once 'app/controllers/movies.controller.php';
require_once 'app/controllers/auth.controller.php';


// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');


$res = new Response();


$action = 'home'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}


// anadir -> addMovie();
// borrar -> deleteMovie();



// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        sessionAuthMiddleware($res);
        $controller = new MoviesController($res);
        $controller->showMovies();
        break;
    case 'anadir':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new MoviesController($res);
        $controller->addMovie();
        break;
    case 'eliminar':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new MoviesController($res);
        $controller->deleteMovie($params[1]);
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'showEdit':
        if (isset($params[1])) {
        $controller = new MoviesController($res);
        $controller->showEdit($params[1]);
        }
        break;
    case 'updateMovie':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if (isset($params[1])) {
            $controller = new MoviesController($res);
            $controller->updateMovie($params[1]);
            }
        break;

    default:
        echo "404 Page Not Found";
        break;
}