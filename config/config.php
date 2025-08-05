<?php

// No PHP, a função define() é usada para criar constantes, ou seja, valores que não podem ser alterados durante a execução do script. Ela permite que você associe um nome a um valor fixo que será acessível globalmente.
define("URL_BASE", "http://localhost/tanamao_imoveis/public/");

//Configurações do Banco de Dados
define('DB_HOST', 'smpsistema.com.br');
define('DB_NAME', 'u283879542_imoveistanamao');
define('DB_USER', 'u283879542_imoveistanamao');
define('DB_PASS', 'Senac@imoveistanamao01');    


// Configurações do Email
define('EMAIL_HOST', 'smtp.hostinger.com.br');
define('EMAIL_PORT', '465');
define('EMAIL_USER', 'tipi03@smpsistema.com.br');
define('EMAIL_PASS', 'Senac@tipi03');


//Sistemas de carregamento automatico de class
spl_autoload_register(function ($class) {

    if (file_exists('../app/controllers/' . $class . '.php')) {
                           //'../app/controllers/HomeController.php'
        require_once '../app/controllers/' . $class . '.php';
    }

    if(file_exists('../app/models/'. $class . '.php')){
        require_once '../app/models/'. $class . '.php';
    }

    if(file_exists('../rotas/'. $class . '.php')){
        require_once '../rotas/'. $class . '.php';
    }

});
