<?php 

class Controller{

    // funçao para carregar views
    public function carregarViews($views, $dados = array()){

        extract($dados);
        require_once 'app/views/'.$views.'.php';

    }
}