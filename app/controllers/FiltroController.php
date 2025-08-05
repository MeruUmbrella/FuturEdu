<?php

class FiltroController extends Controller
{

    private $modelFiltro;

    //Construir algo automaticamente - executa todos os dados | Instanciou uma classe e será executado 
    public function __construct()
    {
        $this->modelFiltro = new Imovel();
    }

    public function index()
    {
        $dados = array();

        $filtro = $this->modelFiltro->getTodosImoveis();
        $dados["filtro"] = $filtro;

        $this->carregarViews('admin/filtro/', $dados);
    }
    
    
}
