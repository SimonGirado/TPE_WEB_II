<?php

class AuthView {
    function showLogin($error = ''){
        require_once 'templates/form.login.phtml';
    }
}