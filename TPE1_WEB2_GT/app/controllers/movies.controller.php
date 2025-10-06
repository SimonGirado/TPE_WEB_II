<?php
require_once 'app/models/movies.model.php';
require_once 'app/views/movies.view.php';

class MoviesController {

    private $model;
    private $view;

    function __construct(){
        $this->model = new MoviesModel();
        $this->view = new MoviesView();
    }

    function showMovies() {
        $movies = $this->model->getMovies();

        $this->view->showMovies($movies);

    }

}