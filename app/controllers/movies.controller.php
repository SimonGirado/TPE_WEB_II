<?php
require_once 'app/models/movies.model.php';
require_once 'app/views/movies.view.php';

class MoviesController {

    private $model;
    private $view;

    function __construct($res){
        $this->model = new MoviesModel();
        $this->view = new MoviesView($res->user);
    }

    function showMovies() {
        $movies = $this->model->getMovies();

        foreach ($movies as $pelicula) {
            if ($pelicula->img) {
                // Convertimos a Base64 para la vista
                $pelicula->imagen_base64 = base64_encode($pelicula->img);
                $pelicula->mime = 'image/jpeg';
            } else {
                $pelicula->imagen_base64 = null;
            }
        }

        $this->view->showMovies($movies);

    }

    function addMovie(){

    $titulo = $_POST['titulo'];
    $sinopsis = $_POST['sinopsis'];
    $duracion = intval($_POST['duracion']);
    $puntaje = floatval($_POST['puntaje']);
    $genero = intval($_POST['genero']);
    $imagen = $_FILES['img'] ?? null;

    
    $limite = 1 * 1024 * 1024;

    if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
        if ($imagen['size'] > $limite) {
            $this->view->showError("La imagen supera el tamaño máximo permitido (1 MB)");
            return; // Detiene la ejecución
        }
    }

    //valido que hayan mandado todo
    if (empty($titulo) || empty($sinopsis) || empty($duracion) || empty($genero) || empty($puntaje)){
        $this->view->showError('Faltan datos obligatorios');
        die();
    }

    
    $id = $this->model->insertMovie($titulo, $sinopsis, $duracion, $genero, $puntaje, $imagen);

    header("Location: " . BASE_URL);
    }

    function updateMovie($id){
         if (isset($_POST['titulo']) && !empty($_POST['titulo']) &&
            isset($_POST['sinopsis']) && !empty($_POST['sinopsis']) &&
            isset($_POST['duracion']) && !empty($_POST['duracion']) &&
            isset($_POST['puntaje']) && !empty($_POST['puntaje']) &&
            isset($_POST['genero']) && !empty($_POST['genero']))
            {   
                $titulo = $_POST['titulo'];
                $sinopsis = $_POST['sinopsis'];
                $duracion = intval($_POST['duracion']);
                $puntaje = floatval($_POST['puntaje']);
                $genero = intval($_POST['genero']);
                $imagenData = null;
                if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                    $imagenData = file_get_contents($_FILES['img']['tmp_name']);
                }

                $this->model->refreshMovie($id, $titulo, $sinopsis, $duracion, $genero, $puntaje, $imagenData);
            } else {
                $this->view->showError("Datos incompletos en la edición");
                die();
            }
            header("Location: " . BASE_URL);
        //valido que hayan mandado todo

        }


    function showEdit($id){
        $movie = $this->model->getItemById($id);
        if($movie){
            $this->view->showEditForm($movie);
        }
        else {
            header("Location: " . BASE_URL);
        }
    }

    function deleteMovie($id){
        $this->model->removeMovie($id);
        header("Location: " . BASE_URL);
    }
        public function showPeliculaById($id)
{
    $movie = $this->model->getItemById($id);

    if ($movie) {
        if ($movie->img) {
            $movie->imagen_base64 = base64_encode($movie->img);
            $movie->mime = 'image/jpeg';
        } else {
            $movie->imagen_base64 = null;
        }
        $this->view->ShowDetalle($movie);
    } 
    else {
        $this->view->showError("La pelicula no existe");
    }
}

}