<?php

class MoviesView{

    function showMovies($movies){
    // obtengo las tareas de la DB
        require_once 'templates/header.php';
        foreach($movies as $movie) {
            echo $movie->titulo;
        }
        require_once 'templates/form.add.php';
        require_once 'templates/footer.php';
    }

    function showError($msg){
        echo "<h1> ERROR! </h1>";
        echo "<h2> $msg </h2>";

    }
}