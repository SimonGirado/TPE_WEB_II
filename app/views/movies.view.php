<?php

class MoviesView{
    private $user = null;
    public function __construct($user){
        $this->user = $user;
    }
    function showMovies($movies){
        require_once 'templates/header.phtml';
    ?>

    <div class="movies-grid">
        <?php foreach($movies as $movie): ?>
            <div class="movie-card">
                <?php if (!empty($movie->imagen_base64)): ?>
                    <img src="data:<?= $movie->mime ?>;base64,<?= $movie->imagen_base64 ?>"
                        alt="<?= htmlspecialchars($movie->titulo) ?>">
                <?php else: ?>
                    <div class="placeholder-img">Sin imagen</div>
                <?php endif; ?>

                <div class="movie-info">
                    <h3><?= htmlspecialchars($movie->titulo) ?></h3>
                    <p><?= htmlspecialchars($movie->sinopsis) ?></p>
                    <p><strong>Duración:</strong> <?= $movie->duracion ?> min</p>
                    <p><strong>Puntaje:</strong> <?= $movie->puntaje_promedio ?></p>
                    <a href="eliminar/<?php echo $movie->id ?>" type="button" class="btn btn-outline-danger">Eliminar</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
        require_once 'templates/form.add.phtml';
        require_once 'templates/footer.phtml';
    }


        function showError($msg){
            echo "<h1> ERROR! </h1>";
            echo "<h2> $msg </h2>";

        }
    }