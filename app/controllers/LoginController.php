<?php
class LoginController extends Controller
{
    private $modelLogin;
    public function __construct()
    {
        $this->modelLogin = new Login();
    }
    // Action que carrega a página login normal
    public function index()
    {
        $dados = array();
        $this->carregarViews('login', $dados);
    }
    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo_usuario = filter_input(INPUT_POST, 'tipo_usuario', FILTER_SANITIZE_SPECIAL_CHARS);
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // importante para segurança

            if ($nome && $cpf && $email && $senha && $tipo_usuario) {
                if ($tipo_usuario === 'cliente') {
                    $dadosCliente = [
                        'nome' => $nome,
                        'cpf' => $cpf,
                        'email' => $email,
                        'senha' => $senha
                    ];

                    $this->modelLogin->addCliente($dadosCliente);
                    header('Location:' . URL_BASE);
                } elseif ($tipo_usuario === 'proprietario') {
                    $dadosProprietario = [
                        'nome' => $nome,
                        'cpf' => $cpf,
                        'email' => $email,
                        'senha' => $senha
                    ];
                    $this->modelLogin->addProprietario($dadosProprietario);
                    header('Location:' . URL_BASE);
                } else {
                    echo "Tipo de usuário inválido!";
                }
            }
        }
        $dados = array();
        $this->carregarViews('home', $dados);
    }
    // Nova action para retornar só o modal
    public function modal()
    {
        // Você pode desabilitar o layout, dependendo do framework

        $dados = array();
        // Renderiza a view com só o modal
        $this->carregarViews('modal_login', $dados);
    }

public function entrar()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // 🔥 Aqui captura a URL anterior (a página atual antes do login)
        $voltar_para = $_SERVER['HTTP_REFERER'];

        // Dados do formulário
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha');

        // Verificar Proprietário
        $proprietarioModel = new Proprietario();
        $usuario = $proprietarioModel->buscarProp($email, $senha);

        if ($usuario) {
            $tipo = 'proprietario';
            $tipo_id = $usuario['id_proprietario'];
            $tipo_nome = $usuario['nome_proprietario'];
            $tipo_email = $usuario['email_proprietario'];
        } else {
            // Verificar Cliente
            $clienteModel = new Cliente();
            $usuario = $clienteModel->postLoginCliente($email, $senha);

            if ($usuario) {
                $tipo = 'cliente';
                $tipo_id = $usuario['id_cliente'];
                $tipo_nome = $usuario['nome_cliente'];
                $tipo_email = $usuario['email_cliente'];
            } else {
                // Verificar Funcionário
                $funcionarioModel = new Funcionario();
                $usuario = $funcionarioModel->postLoginFuncionario($email, $senha);

                if ($usuario) {
                    $tipo = 'funcionario';
                    $tipo_id = $usuario['id_funcionario'];
                    $tipo_nome = $usuario['nome_funcionario'];
                    $tipo_email = $usuario['email_funcionario'];
                } else {
                    $usuario = null;
                }
            }
        }

        session_start();

        if ($usuario) {
            // Cria sessão
            $_SESSION['tipo'] = $tipo;
            $_SESSION['tipo_id'] = $tipo_id;
            $_SESSION['tipo_nome'] = $tipo_nome;
            $_SESSION['tipo_email'] = $tipo_email;

            // 🔥 Redireciona para a página anterior (a mesma onde estava)
            header('Location: ' . $voltar_para);
            exit;
        } else {
            // 🔥 Se deu erro no login, volta para a mesma página com erro
            $_SESSION['erro-login'] = "E-mail ou senha Inválidos!";
            header('Location: ' . $voltar_para);
            exit;
        }
    }
}

public function sair()
{
    session_start();

    // Destrói todas as variáveis de sessão
    session_unset();

    // Destroi a sessão
    session_destroy();

    // Redireciona para a página inicial (ou qualquer página que desejar)
    header('Location: ' . URL_BASE);
    exit;
}


}
