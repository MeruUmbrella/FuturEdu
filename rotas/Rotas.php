<?php
 
class Rotas
{
 
    //! Método inicializador das rotas
    public function executar()
    {
        $url = '/';
 
        if (isset($_GET['url'])) {
 
            $url .=  $_GET['url'];
        }
        $parametro = array();
        //! parametro[0][1][2][3]
 
        //todo Verifica se a URL não está vazia e não é apenas uma /
        if (!empty($url) && $url != '/') {
 
            //! turma/aluno/5
            //! 1- Controller (TurmaController)
            //! 2- Método
            //! 3- Parametro
            
            $url = explode('/', $url);
 
            array_shift(array: $url);
            $controladorAtual = ucfirst($url[0]) . 'Controller';
 
            // var_dump($controladorAtual);
            array_shift($url); // remover a primeira casa do vetor
 
            if (isset($url[0]) && !empty($url[0])) {
 
                $acaoAtual = $url[0];
                array_shift($url);

            } else {

                $acaoAtual = 'index';

            }

            if (count($url) > 0) {

                $parametro = $url;
                
            }

        } else {

            $controladorAtual = 'HomeController';
            $acaoAtual = 'index';

        }

       
 
        // Somente verifica se não existe o Controller e ação dentro da pasta app/controllers
 
        if (!file_exists('../app/controllers/' . $controladorAtual . '.php') || !method_exists($controladorAtual, $acaoAtual)) {
 
            echo 'Cheguei Aqui!! - Não existe o ' . $controladorAtual . ' e nem a ação atual: ' . $acaoAtual;
 
            $controladorAtual = 'ErrorController';
 
            $acaoAtual = 'index';
 
        }
 
        // Criar a instancia do controller atual
         $controller = new  $controladorAtual();

        //  var_dump($controller);
 
         call_user_func_array(array($controller,$acaoAtual), $parametro);
 
    }
}