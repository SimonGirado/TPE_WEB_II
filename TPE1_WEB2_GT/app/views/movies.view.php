<?php

class MoviesView{

    /*function showMovies($movies){
    
        require_once 'templates/header.php';
        foreach($movies as $movie) {
            echo $movie->titulo;
        }
        require_once 'templates/form.add.php';
        require_once 'templates/footer.php';
    }*/

        function showMovies($movies){
    require_once 'templates/header.php';

    foreach($movies as $movie): ?>
        <div class="movie">
            <h2><?= htmlspecialchars($movie->titulo) ?></h2>
            <p><?= htmlspecialchars($movie->sinopsis) ?></p>
            <p>Duración: <?= $movie->duracion ?> min</p>
            <p>Puntaje: <?= $movie->puntaje_promedio ?></p>

            <?php if (!empty($movie->imagen_base64)): ?>
                <img src="data:<?= $movie->mime ?>;base64,<?= $movie->imagen_base64 ?>"
                    alt="<?= htmlspecialchars($movie->titulo) ?>" width="200">
            <?php else: ?>
                <p>No hay imagen disponible</p>
            <?php endif; ?>
        </div>
    <?php endforeach;

    require_once 'templates/form.add.php';
    require_once 'templates/footer.php';
}

    function showError($msg){
        echo "<h1> ERROR! </h1>";
        echo "<h2> $msg </h2>";

    }
}