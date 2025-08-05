<?php
class MensagemController extends Controller
{
    private $model;

    public function __construct() {
        $this->model = new Mensagem();
    }

    public function listar() {
        $dados['mensagens'] = $this->model->listar();
        $dados['conteudo'] = 'admin/mensagem/listar';
        $this->carregarViews('admin/dash', $dados);
    }

    public function adicionar() {
        $dados['mensagem'] = null;
        $dados['clientes'] = $this->model->listarClientes();
        $dados['proprietarios'] = $this->model->listarProprietarios();
        $dados['imoveis'] = $this->model->listarImoveis();
        $dados['conteudo'] = 'admin/mensagem/form';
        $this->carregarViews('admin/dash', $dados);
    }

    public function editar($id) {
        $dados['mensagem'] = $this->model->buscarPorId($id);
        $dados['clientes'] = $this->model->listarClientes();
        $dados['proprietarios'] = $this->model->listarProprietarios();
        $dados['imoveis'] = $this->model->listarImoveis();
        $dados['conteudo'] = 'admin/mensagem/form';
        $this->carregarViews('admin/dash', $dados);
    }

    public function salvar() {
        $dados = $_POST;
        if (isset($dados['id_mensagem']) && $dados['id_mensagem'] != '') {
            $this->model->atualizar($dados);
        } else {
            $this->model->inserir($dados);
        }
        header("Location: " . URL_BASE . "mensagem/listar");
    }

    public function excluir($id) {
        $this->model->excluir($id);
        header("Location: " . URL_BASE . "mensagem/listar");
    }






}