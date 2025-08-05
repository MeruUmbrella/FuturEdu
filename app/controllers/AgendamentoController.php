<?php

class AgendamentoController extends Controller
{

    private $agendamentoModel;
    private $proprietarioModel;
    private $imovelModel;

    public function __construct()
    {

        $this->agendamentoModel = new Agendamento();
        $this->imovelModel = new Agendamento(); // Adicione esta linha
        $this->proprietarioModel = new Agendamento(); // E esta linha
    }
    public function index()
    {

        $dados = array();

        $todosOsAgendamentos = $this->agendamentoModel->getAgendamentos();
        $dados["agendamentos"] = $todosOsAgendamentos;

        $this->carregarViews('admin/agendamento/listar', $dados);
    }

    public function listar()
    {

        $dados = array();

        $dados['conteudo'] = 'admin/agendamento/listar';

        $agendamentos = $this->agendamentoModel->getAgendamentos();

        $dados['agendamentos'] = $agendamentos;


        $this->carregarViews('admin/dash', $dados);
    }

    public function adicionar() {
        $dados['agendamento'] = null;
        $dados['clientes'] = $this->agendamentoModel->listarClientes();
        $dados['proprietarios'] = $this->agendamentoModel->listarProprietarios();
        $dados['imoveis'] = $this->agendamentoModel->listarImoveis();
        $dados['conteudo'] = 'admin/agendamento/adicionar';
        $this->carregarViews('admin/dash', $dados);
    }

    public function editar($id) {
        $dados['agendamento'] = $this->agendamentoModel->buscarPorId($id);
        $dados['clientes'] = $this->agendamentoModel->listarClientes();
        $dados['proprietarios'] = $this->agendamentoModel->listarProprietarios();
        $dados['imoveis'] = $this->agendamentoModel->listarImoveis();
        $dados['conteudo'] = 'admin/agendamento/editar';
        $this->carregarViews('admin/dash', $dados);
    }

    public function salvar() {
        $dados = $_POST;
        if (isset($dados['id_agendamento']) && $dados['id_agendamento'] != '') {
            $this->agendamentoModel->atualizar($dados);
        } else {
            $this->agendamentoModel->inserir($dados);
        }
        header("Location: " . URL_BASE . "agendamento/listar");
    }

    public function excluir($id) {
        $this->agendamentoModel->excluir($id);
        header("Location: " . URL_BASE . "agendamento/listar");
    }


    public function atualizarStatus()
    {

        $dados = json_decode(file_get_contents('php://input'), true);

        $sucesso = $this->agendamentoModel->atualizarStatus($dados['id_agendamento'], $dados['status_agendamento']);

        echo json_encode(['sucesso' => $sucesso]);
    }


    
}
