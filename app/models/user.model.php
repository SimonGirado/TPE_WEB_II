<?php

class UserModel{
    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=movies_db;charset=utf8', 'root', '');
    }

    function getUserByEmail($email){
        $query = $this->db->prepare('SELECT * FROM usuario WHERE user = ?');
        $query->execute([$email]);

        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }
}