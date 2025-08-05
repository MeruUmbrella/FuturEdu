<?php

class HomeController extends Controller{

    public function index(){

        $dados = array();
         
        $dados['titulo'] = "Home";
        $this->carregarViews('home', $dados);
    }
}