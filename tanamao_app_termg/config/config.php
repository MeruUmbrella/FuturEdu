<?php

if (session_status() == PHP_SESSION_NONE) {

    session_start();
}

//INFORMAR A URL BASE

define('URL_BASE', 'http://localhost/tanamao_app/public/');

spl_autoload_register(function($class) {
    if (file_exists('../app/controllers/'.$class.'.php')) {

        require_once '../app/controllers/'.$class.'.php';
    }

    if (file_exists('../rotas/'.$class.'.php')) {

        require_once '../rotas/'.$class.'.php';
    }
});
