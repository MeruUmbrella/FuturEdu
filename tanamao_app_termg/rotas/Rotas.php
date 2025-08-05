<?php

class Rotas
{

    public function executar()
    {

        $url = '/';

        if (isset($_GET['url'])) {

            $url .= $_GET['url'];
        }

        $parametro = array();

        // verificar se existe a URL
        if (!empty($url) && $url != '/') {

            $url = explode('/', $url);
            array_shift($url); //remove o excesso de barras
            $controladorAtual = ucfirst($url[0]) . 'Controller'; //pega o primeiro caracter e transforma em letra maiuscula
            array_shift($url);
            if (isset($url[0]) && !empty($url[0])) {

                $acao = $url[0];
                array_shift($url);
            } else {

                $acao = 'index';
            }

            // caso temha algo a mais considerar um parametro

            if (count($url) > 0) {

                $parametro = $url;
            }
        } else {

            $controladorAtual = 'HomeController';
            $acao = 'index';
        }

        if (
            !file_exists('app/controllers/' . $controladorAtual . '.php')
            || !method_exists($controladorAtual, $acao)
        ) {
            echo 'Arquivo ' . $controladorAtual . ' ou metodo ' . $acao . ' não encontrado.';
            $controladorAtual = 'ErroController';
            $acao = 'index';
        }

        $controller = new $controladorAtual;
        call_user_func_array(array($controller, $acao), $parametro);
    }
}
