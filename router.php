<?php
require_once 'libs/response.php';
require_once 'app/middlewares/session.auth.middleware.php';
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
        $controller = new MoviesController();
        $controller->showMovies();
        break;
    case 'anadir':
        sessionAuthMiddleware($res);
        $controller = new MoviesController();
        $controller->addMovie();
        break;
    case 'eliminar':
        sessionAuthMiddleware($res);
        $controller = new MoviesController();
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
    default:
        echo "404 Page Not Found";
        break;
}