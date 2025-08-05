<?php

class DashController extends Controller
{

    private $modelProprietario;
    private $modelImovel;
    private $modelFuncionario;
    public function __construct()
    {

        $this->modelProprietario = new Proprietario();
        $this->modelImovel = new Imovel();
        $this->modelFuncionario = new Funcionario();
    }


    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['tipo']) || !isset($_SESSION['tipo_id'])) {
            header('location:' . URL_BASE);
            exit;
        }
    
        $dados = [];
        $dados['titulo'] = 'Dashboard | Sistema Tanamão';
    
        switch ($_SESSION['tipo']) {
            case 'proprietario':
                $dados['nome'] = $_SESSION['tipo_nome'];
                $dados['email'] = $_SESSION['tipo_email'];
    
                $proprietarioModel = new Proprietario();
                $idProprietario = $_SESSION['tipo_id'];
                // $dados['imoveis'] = $proprietarioModel->getImoveisPorProprietario($idProprietario);
    
                $this->carregarViews('admin/dashProprietario', $dados);
                break;
    
            case 'cliente':
                $dados['nome'] = $_SESSION['tipo_nome'];
                $dados['email'] = $_SESSION['tipo_email'];
    
                // Exemplo: carregar dados do cliente
                $clienteModel = new Cliente();
                $idCliente = $_SESSION['tipo_id'];
                $dados['reservas'] = $clienteModel->getClienteById($idCliente);
    
                $this->carregarViews('admin/dashCliente', $dados);
                break;
    
            case 'funcionario':
                $dados['nome'] = $_SESSION['tipo_nome'];
                $dados['email'] = $_SESSION['tipo_email'];
    
                // Exemplo: carregar dados do funcionário
                $funcionarioModel = new Funcionario();
                $idFuncionario = $_SESSION['tipo_id'];
                $dados['admin'] = $funcionarioModel->getFuncionarioById($idFuncionario);
    
                $this->carregarViews('admin/dash', $dados);
                break;
    
            default:
                // Tipo não reconhecido, redirecionar ou exibir erro
                header('location:' . URL_BASE);
                exit;
        }
    
        exit;
    }
    

    //função para destruir a pagina, apagar as informações e sair da pagina
    public function sair()
    {
        session_unset();
        session_destroy();
        header('location:' . URL_BASE);
        exit;
    }
}
