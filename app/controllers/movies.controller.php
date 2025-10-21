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


    //valido que hayan mandado todo
    if (empty($titulo) || empty($sinopsis) || empty($duracion) || empty($genero) || empty($puntaje)){
        $this->view->showError('Faltan datos obligatorios');
        die();
    }

    
    $id = $this->model->insertMovie($titulo, $sinopsis, $duracion, $genero, $puntaje, $imagen);

    header("Location: " . BASE_URL);
    }

    function deleteMovie($id){
        $this->model->removeMovie($id);
        header("Location: " . BASE_URL);
    }
}