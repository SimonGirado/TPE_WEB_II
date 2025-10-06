<?php
/**
 * Este archivo concentra todas las funciones que acceden
 * a la Base de Datos.
 */

function getConnection() {
    return new PDO('mysql:host=localhost;dbname=movies_db;charset=utf8', 'root', '');
}

function getMovies() {
    // 1. abro conexión con la DB
    $db = getConnection();

    // 2. ejecuto la consulta SQL (SELECT * FROM tareas)
    $query = $db->prepare('SELECT * FROM peliculas');
    $query->execute();

    // 3. obtengo los resultados de la consulta
    $movies = $query->fetchAll(PDO::FETCH_OBJ);

    return $movies;
}
