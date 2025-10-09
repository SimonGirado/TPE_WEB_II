<?php
require_once 'app/models/movies.model.php';
require_once 'app/views/movies.view.php';

class MoviesController {

    private $model;
    private $view;

    function __construct(){
        $this->model = new MoviesModel();
        $this->view = new MoviesView();
    }

    function showMovies() {
        $movies = $this->model->getMovies();

        $this->view->showMovies($movies);

    }

    function addMovie(){

    $titulo = $_POST['titulo'];
    $sinopsis = $_POST['sinopsis'];
    $duracion = $_POST['duracion'];
    $puntaje = $_POST['puntaje'];
    $genero = $_POST['genero'];


    //valido que hayan mandado todo
    if (empty($titulo) || empty($sinopsis) || empty($duracion) || empty($genero) || empty($puntaje)){
        $this->view->showError('Faltan datos obligatorios');
        die();
    }

    
    $id = $this->model->insertMovie($titulo, $sinopsis, $duracion, $genero, $puntaje);

    header("Location: " . BASE_URL);
}

}