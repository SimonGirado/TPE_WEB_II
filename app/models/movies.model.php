<?php
require_once 'config.php';

class MoviesModel{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=movies_db;charset=utf8', 'root', '');

        /*$this->_deploy();*/
    }

    function getItemById($id){
        $query = $this->db->prepare("SELECT * FROM peliculas WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function getMovies() {

        // 2. ejecuto la consulta SQL (SELECT * FROM tareas)
        $query = $this->db->prepare('SELECT * FROM peliculas');
        $query->execute();

        // 3. obtengo los resultados de la consulta
        $movies = $query->fetchAll(PDO::FETCH_OBJ);

        return $movies;
    }

    function insertMovie($titulo, $sinopsis, $duracion, $genero, $puntaje, $img = null){


        /*INSERT INTO `peliculas` (`id`, `titulo`, `sinopsis`, `duracion`, `id_genero`, `puntaje_promedio`) */
        $query = $this->db->prepare('INSERT INTO peliculas (titulo, sinopsis, duracion, id_genero, puntaje_promedio, img) VALUES (?, ?, ?, ?, ?, ?)');

        $imagenData = null;
        if ($img && $img['error'] === UPLOAD_ERR_OK) {
            $imagenData = file_get_contents($img['tmp_name']);
        }

        $query->execute([$titulo, $sinopsis, $duracion, $genero, $puntaje, $imagenData]);

        return $this->db->lastInsertId();
    }

    function removeMovie($id){

        $query = $this->db->prepare('DELETE FROM peliculas WHERE id = ?');
        $query->execute([$id]);
    }

    /*function refreshMovie($id, $titulo, $sinopsis, $duracion, $genero, $puntaje, $imagenData = null) {
        if ($imagenData !== null) {
            $query = $this->db->prepare('UPDATE peliculas 
                SET titulo = ?, sinopsis = ?, duracion = ?, id_genero = ?, puntaje_promedio = ?, img = ? 
                WHERE id = ?');
            $query->execute([$titulo, $sinopsis, $duracion, $genero, $puntaje, $imagenData, $id]);
        } else {
            $query = $this->db->prepare('UPDATE peliculas 
                SET titulo = ?, sinopsis = ?, duracion = ?, id_genero = ?, puntaje_promedio = ? 
                WHERE id = ?');
            $query->execute([$titulo, $sinopsis, $duracion, $genero, $puntaje, $id]);
        }
    }*/
        function refreshMovie($id, $titulo, $sinopsis, $duracion, $genero, $puntaje, $imagenData = null) {
    if ($imagenData !== null) {
        $query = $this->db->prepare('UPDATE peliculas 
            SET titulo = ?, sinopsis = ?, duracion = ?, id_genero = ?, puntaje_promedio = ?, img = ? 
            WHERE id = ?');
        $ok = $query->execute([$titulo, $sinopsis, $duracion, $genero, $puntaje, $imagenData, $id]);
    } else {
        $query = $this->db->prepare('UPDATE peliculas 
            SET titulo = ?, sinopsis = ?, duracion = ?, id_genero = ?, puntaje_promedio = ? 
            WHERE id = ?');
        $ok = $query->execute([$titulo, $sinopsis, $duracion, $genero, $puntaje, $id]);
    }

}




    /*private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql =<<<END
            END;
        $this->db->query($sql);
    }
    // Entre los dos END deberia poner el script de creacion de tablas, pero como la cadena de caracteres supera por muchisimo el limite 
    // de caracteres permitidos, lo dejo asi para no tener errores, intente varias cosas para que funcione pero no pude.
    }*/

}