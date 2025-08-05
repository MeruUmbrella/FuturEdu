<?php

class ClienteController extends Controller
{

    private $modelCliente;

    public function __construct()
    {

        $this->modelCliente = new Cliente();
    }

    public function index()
    {

        $dados = array();

        $todosOsCliente = $this->modelCliente->getClientes();
        $dados["clientes"] = $todosOsCliente;

        $this->carregarViews('admin/cliente/listar', $dados);
    }

    public function perfil()
{
    $id_cliente = $_SESSION['id_cliente']; // ou outra forma de obter o id do cliente logado
    $clienteModel = new Cliente();
    $cliente = $clienteModel->getClienteById($id_cliente);

    $dados['cliente'] = $cliente;
    $this->carregarViews('admin/dashCliente', $dados);
}

    public function meusFavoritos()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'cliente') {
        header('Location: ' . URL_BASE);
        exit;
    }

    $idCliente = $_SESSION['tipo_id'];

    $favoritoModel = new Favorito();

    $dados = array();

    // Busca os imóveis favoritados pelo cliente
    $imoveisFavoritos = $favoritoModel->listarFavoritosPorId($idCliente);

    $dados['imoveis'] = $imoveisFavoritos;

    // Defina qual view será carregada (exemplo: admin/dashCliente)
    $dados['conteudo'] = 'admin/cliente/listarFavoritos';

    // Carrega o dashboard do cliente passando os dados
    $this->carregarViews('admin/dashCliente', $dados);
}

    public function listar()
    {

        $dados = array();

        $dados['conteudo'] = 'admin/cliente/listar';

        $clientes = $this->modelCliente->getClientes();

        $dados['clientes'] = $clientes;


        $this->carregarViews('admin/dash', $dados);
    }

    public function editar($id)
    {
        $dados = array();

        // 1º Carregar as informações atuais do cliente
        $carregarDadosCliente = $this->modelCliente->carregarDados($id);
        $dados['carregarDadosCliente'] = $carregarDadosCliente;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome_cliente     = filter_input(INPUT_POST, 'nome_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $email_cliente    = filter_input(INPUT_POST, 'email_cliente', FILTER_SANITIZE_EMAIL);
            $senha_cliente    = filter_input(INPUT_POST, 'senha_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf_cliente      = filter_input(INPUT_POST, 'cpf_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cep_cliente      = filter_input(INPUT_POST, 'cep_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $endereco_cliente = filter_input(INPUT_POST, 'endereco_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $bairro_cliente   = filter_input(INPUT_POST, 'bairro_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $estado_cliente   = filter_input(INPUT_POST, 'estado_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $alt_cliente      = filter_input(INPUT_POST, 'alt_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_cliente   = $carregarDadosCliente['status_cliente'];
            $data_criacao     = $carregarDadosCliente['data_criacao'];

            date_default_timezone_set('America/Sao_Paulo');
            $data_atualizacao = date('Y-m-d H:i:s');

            // Foto
            if (isset($_FILES['foto_cliente']) && $_FILES['foto_cliente']['error'] == 0) {
                $foto_cliente = $this->uploadFoto($_FILES['foto_cliente'], $id, $nome_cliente);
            } else {
                $foto_cliente = $carregarDadosCliente['foto_cliente'];
            }

            // Monta array de dados para atualizar
            $dadosCliente = array(
                'id_cliente'      => $id,
                'nome_cliente'    => $nome_cliente,
                'email_cliente'   => $email_cliente,
                'senha_cliente'   => $senha_cliente,
                'cpf_cliente'     => $cpf_cliente,
                'cep_cliente'     => $cep_cliente,
                'endereco_cliente' => $endereco_cliente,
                'bairro_cliente'  => $bairro_cliente,
                'estado_cliente'  => $estado_cliente,
                'foto_cliente'    => $foto_cliente,
                'alt_cliente'     => $alt_cliente,
                'status_cliente'  => $status_cliente,
                'data_criacao'    => $data_criacao,
                'data_atualizacao' => $data_atualizacao
            );

            $resultado = $this->modelCliente->editarCliente(dados: $dadosCliente);

            if ($resultado) {
                $_SESSION['Mensagem'] = "Cliente atualizado com sucesso!";
                $_SESSION['tipoMsg']  = "Sucesso!";
                header('Location: ' . URL_BASE . 'cliente/listar');
                exit;
            } else {
                $_SESSION['Mensagem'] = "Cliente não atualizado!";
                $_SESSION['tipoMsg']  = "erro!";
                header('Location: ' . URL_BASE . 'cliente/listar');
                exit;
            }
        }

        $dados['conteudo'] = 'admin/cliente/editar';
        $this->carregarViews('admin/dash', $dados);
    }

    public function editarCliente($id)
    {
        $dados = array();

        // 1º Carregar as informações atuais do cliente
        $carregarDadosCliente = $this->modelCliente->carregarDados($id);
        $dados['carregarDadosCliente'] = $carregarDadosCliente;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome_cliente     = filter_input(INPUT_POST, 'nome_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $email_cliente    = filter_input(INPUT_POST, 'email_cliente', FILTER_SANITIZE_EMAIL);
            $senha_cliente    = filter_input(INPUT_POST, 'senha_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf_cliente      = filter_input(INPUT_POST, 'cpf_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cep_cliente      = filter_input(INPUT_POST, 'cep_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $endereco_cliente = filter_input(INPUT_POST, 'endereco_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $bairro_cliente   = filter_input(INPUT_POST, 'bairro_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $estado_cliente   = filter_input(INPUT_POST, 'estado_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $alt_cliente      = filter_input(INPUT_POST, 'alt_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_cliente   = $carregarDadosCliente['status_cliente'];
            $data_criacao     = $carregarDadosCliente['data_criacao'];

            date_default_timezone_set('America/Sao_Paulo');
            $data_atualizacao = date('Y-m-d H:i:s');

            // Foto
            if (isset($_FILES['foto_cliente']) && $_FILES['foto_cliente']['error'] == 0) {
                $foto_cliente = $this->uploadFoto($_FILES['foto_cliente'], $id, $nome_cliente);
            } else {
                $foto_cliente = $carregarDadosCliente['foto_cliente'];
            }

            // Monta array de dados para atualizar
            $dadosCliente = array(
                'id_cliente'      => $id,
                'nome_cliente'    => $nome_cliente,
                'email_cliente'   => $email_cliente,
                'senha_cliente'   => $senha_cliente,
                'cpf_cliente'     => $cpf_cliente,
                'cep_cliente'     => $cep_cliente,
                'endereco_cliente' => $endereco_cliente,
                'bairro_cliente'  => $bairro_cliente,
                'estado_cliente'  => $estado_cliente,
                'foto_cliente'    => $foto_cliente,
                'alt_cliente'     => $alt_cliente,
                'status_cliente'  => $status_cliente,
                'data_criacao'    => $data_criacao,
                'data_atualizacao' => $data_atualizacao
            );

            $resultado = $this->modelCliente->editarCliente(dados: $dadosCliente);

            if ($resultado) {
                $_SESSION['Mensagem'] = "Cliente atualizado com sucesso!";
                $_SESSION['tipoMsg']  = "Sucesso!";
                header('Location: ' . URL_BASE . 'cliente/perfilCliente');
                exit;
            } else {
                $_SESSION['Mensagem'] = "Cliente não atualizado!";
                $_SESSION['tipoMsg']  = "erro!";
                header('Location: ' . URL_BASE . 'cliente/perfilCliente');
                exit;
            }
        }

        $dados['conteudo'] = 'admin/cliente/editarCliente';
        $this->carregarViews('admin/dashCliente', $dados);
    }
    public function desativar($id)
    {

        $resultado = $this->modelCliente->desativarCliente($id);

        if ($resultado) {
            //Retornar a resposta do AJAX
            echo json_encode(['sucesso' => true]);
        } else {
            echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao desativar o curso.']);
        }
    }

    public function adicionar()
    {

        $dados = array();



        // 1º = A chamada vem do botão Cadastrar Curso? | Verificar

        // 2º = Pegar os dados do Formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {



            $nome_cliente     = filter_input(INPUT_POST, 'nome_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $email_cliente    = filter_input(INPUT_POST, 'email_cliente', FILTER_SANITIZE_EMAIL);
            $senha_cliente    = filter_input(INPUT_POST, 'senha_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf_cliente      = filter_input(INPUT_POST, 'cpf_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cep_cliente      = filter_input(INPUT_POST, 'cep_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $endereco_cliente = filter_input(INPUT_POST, 'endereco_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $bairro_cliente   = filter_input(INPUT_POST, 'bairro_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $estado_cliente   = filter_input(INPUT_POST, 'estado_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $alt_cliente      = filter_input(INPUT_POST, 'alt_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_cliente   = 'Ativo';

            date_default_timezone_set('America/Sao_Paulo');
            $data_criacao = date('Y-m-d H:i:s');
            $data_atualizacao = date('Y-m-d H:i:s');

            // Foto
            if (isset($_FILES['foto_cliente']) && $_FILES['foto_cliente']['error'] == 0) {
                $foto_cliente = $this->uploadFoto($_FILES['foto_cliente'], uniqid(), $nome_cliente);
            } else {
                $foto_cliente = 'sem_imagem.png';
            }

            // Monta array de dados para inserir
            $dadosCliente = array(
                'nome_cliente'     => $nome_cliente,
                'email_cliente'    => $email_cliente,
                'senha_cliente'    => $senha_cliente,
                'cpf_cliente'      => $cpf_cliente,
                'cep_cliente'      => $cep_cliente,
                'endereco_cliente' => $endereco_cliente,
                'bairro_cliente'   => $bairro_cliente,
                'estado_cliente'   => $estado_cliente,
                'foto_cliente'     => $foto_cliente,
                'alt_cliente'      => $alt_cliente,
                'status_cliente'   => $status_cliente,
                'data_criacao'     => $data_criacao,
                'data_atualizacao' => $data_atualizacao
            );

            $resultado = $this->modelCliente->addCliente($dadosCliente);

            if ($resultado) {
                $_SESSION['Mensagem'] = "Cliente adicionado com sucesso!";
                $_SESSION['tipoMsg']  = "Sucesso!";
                header('Location: ' . URL_BASE . 'cliente/listar');
                exit;
            } else {
                $dados['Mensagem'] = 'Erro ao adicionar cliente.';
                $dados['tipoMsg'] = 'erro';
            }
        }

        $dados['conteudo'] = 'admin/cliente/adicionar';
        $this->carregarViews('admin/dash', $dados);
    }

    function gerarLinkImovel($link)
    {

        $link = mb_strtolower($link, 'UTF-8');
        $caracter = [


            'á' => 'a',
            'à' => 'a',
            'ã' => 'a',
            'â' => 'a',
            'ä' => 'a',
            'é' => 'e',
            'è' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'í' => 'i',
            'ì' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ó' => 'o',
            'ò' => 'o',
            'õ' => 'o',
            'ô' => 'o',
            'ö' => 'o',
            'ú' => 'u',
            'ù' => 'u',
            'û' => 'u',
            'ü' => 'u',
            'ç' => 'c',
            ' ' => '-',
            '!' => '',
            '"' => '',
            '#' => '',
            '$' => '',
            '%' => '',
            '&' => '',
            "'" => '',
            '(' => '',
            ')' => '',
            '*' => '',
            '+' => '',
            ',' => '',
            '.' => '',
            '/' => '',
            ':' => '',
            ';' => '',
            '<' => '',
            '=' => '',
            '>' => '',
            '?' => '',
            '@' => '',
            '[' => '',
            ']' => '',
            '^' => '',
            '`' => '',
            '{' => '',
            '|' => '',
            '}' => '',
            '~' => '',
            '\\' => '',
            '–' => '-',
            '—' => '-',
            '“' => '',
            '”' => '',
            '´' => '',
        ];

        $link = strtr($link, $caracter);

        return $link;
    }

    public function uploadFoto($file, $id, $nome)
    {

        $dir = 'uploads/cliente/';

        if (file_exists(!$dir)) { //comando para criar um diretorio caso nao exista

            mkdir($dir, 0755, true);
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);


        $novoNome = $id . '_' . $this->gerarLinkImovel($nome) . '.' . $ext;

        if (move_uploaded_file($file['tmp_name'], $dir . $novoNome)) {

            var_dump($novoNome);

            return $novoNome;
        } else {
            $novoNome = 'sem_imagem.png';
            return $novoNome;
        }
    }

    public function atualizarStatus()
    {

        $dados = json_decode(file_get_contents('php://input'), true);

        $sucesso = $this->modelCliente->atualizarStatus($dados['id_cliente'], $dados['status_cliente']);

        echo json_encode(['sucesso' => $sucesso]);
    }
    public function perfilCliente()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'cliente') {
            header('Location: ' . URL_BASE);
            exit;
        }

        $idCliente = $_SESSION['tipo_id'];

        $clienteModel = new Cliente();
        $dados = array();

        $dados['cliente'] = $clienteModel->getClienteById($idCliente);

        $dados['conteudo'] = 'admin/cliente/perfilCliente';

        $this->carregarViews('admin/dashCliente', $dados);
    }
}
