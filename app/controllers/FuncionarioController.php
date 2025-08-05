<?php

class FuncionarioController extends Controller
{
    public function perfilFuncionario()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'funcionario') {
            header('Location: ' . URL_BASE);
            exit;
        }

        $idFuncionario = $_SESSION['tipo_id'];
        $funcionarioModel = new Funcionario();
        $dados = [];




        $dados['funcionario'] = $funcionarioModel->getFuncionarioById($idFuncionario);
    
        $dados['conteudo'] = 'admin/funcionario/perfilFuncionario';

        $this->carregarViews('admin/dash', $dados);
    }
}
