<?php
require_once 'db.php';
require_once 'app//models/movies.model.php';
function showMovies() {
    // obtengo las tareas de la DB
    require_once 'templates/header.php';

    $movies = getMovies();

    foreach($movies as $movie) {
        echo $movie->titulo;
    }
    require_once 'templates/footer.php';

}

function addMovie(){

    //ToDo validar datos

    $titulo = $_POST['titulo'];
    $sinopsis = $_POST['sinopsis'];
    $duracion = $_POST['duracion'];
    $puntaje = $_POST['puntaje'];
    $genero = $_POST['genero'];

    insertMovie($titulo, $sinopsis, $duracion, $genero, $puntaje);
    echo "Putooo";
}