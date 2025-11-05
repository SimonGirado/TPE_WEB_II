<?php

class MoviesView{
    private $user = null;
    public function __construct($user){
        $this->user = $user;
    }
    function showMovies($movies){
        require_once 'templates/header.phtml';
        require_once 'templates/cartelera.phtml';
        if($this->user):
        require_once 'templates/form.add.phtml';
        endif;
        require_once 'templates/footer.phtml';
    }

    function showEditForm($movie){
        require_once 'templates/modifier.phtml';
    }
        function showError($msg){
            echo "<h1> ERROR! </h1>";
            echo "<h2> $msg </h2>";

        }
    }
    /*
     */