<?php

class AuthView {
    private $user = null;
    function showLogin($error = ''){
        require_once 'templates/form.login.phtml';
    }
}