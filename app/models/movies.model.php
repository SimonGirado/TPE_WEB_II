<?php

class MoviesModel{

    private function getConnection() {
        return new PDO('mysql:host=localhost;dbname=movies_db;charset=utf8', 'root', '');
    }

    function getMovies() {
        // 1. abro conexión con la DB
        $db = $this->getConnection();

        // 2. ejecuto la consulta SQL (SELECT * FROM tareas)
        $query = $db->prepare('SELECT * FROM peliculas');
        $query->execute();

        // 3. obtengo los resultados de la consulta
        $movies = $query->fetchAll(PDO::FETCH_OBJ);

        return $movies;
    }

    function insertMovie($titulo, $sinopsis, $duracion, $genero, $puntaje, $img = null){

        $db = $this->getConnection();

        /*INSERT INTO `peliculas` (`id`, `titulo`, `sinopsis`, `duracion`, `id_genero`, `puntaje_promedio`) */
        $query = $db->prepare('INSERT INTO peliculas (titulo, sinopsis, duracion, id_genero, puntaje_promedio, img) VALUES (?, ?, ?, ?, ?, ?)');

        $imagenData = null;
        if ($img && $img['error'] === UPLOAD_ERR_OK) {
            $imagenData = file_get_contents($img['tmp_name']);
        }

        $query->execute([$titulo, $sinopsis, $duracion, $genero, $puntaje, $imagenData]);

        return $db->lastInsertId();
    }

    function removeMovie($id){
        $db = $this->getConnection();

        $query = $db->prepare('DELETE FROM peliculas WHERE id = ?');
        $query->execute([$id]);
    }
}