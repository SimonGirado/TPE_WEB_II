<?php
require_once 'app/controllers/movies.controller.php';
// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

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
        $controller = new MoviesController();
        $controller->addMovie();
        break;
    case 'eliminar':
        $controller = new MoviesController();
        $controller->deleteMovie($params[1]);
        break;
    default:
        echo "404 Page Not Found";
        break;
}