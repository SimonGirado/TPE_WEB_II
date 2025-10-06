<?php
require_once 'db.php';
function showMovies() {
    // obtengo las tareas de la DB
    require_once 'templates/header.php';

    $movies = getMovies();

    foreach($movies as $movie) {
        echo $movie->titulo;
    }
    require_once 'templates/footer.php';

}