<?php

class RelatorioController extends Controller
{

    private $modelRelatorio;

    public function __construct()
    {

        $this->modelRelatorio = new Relatorio();
    }

    public function index()
    {

        $dados = array();

        $todosOsRelatorios = $this->modelRelatorio->getRelatorio();
        $dados["relatorios"] = $todosOsRelatorios;

        $this->carregarViews('admin/relatorio/listar', $dados);
    }

    public function listar()
    {

        $dados = array();

        $dados['conteudo'] = 'admin/relatorio/listar';

        $relatorio = $this->modelRelatorio->getRelatorio();

        $dados['relatorio'] = $relatorio;



        // var_dump($cursos); caso queire testar o que o cursos irá trazer do banco

        $this->carregarViews('admin/dash', $dados);
    }

    public function editar($id)
    {
        $dados = [];
    
        $relatorio = $this->modelRelatorio->getRelatorioById($id);
        if (!$relatorio) {
            header('Location: ' . URL_BASE . 'relatorio/listar');
            exit;
        }
    
        $dados['conteudo'] = 'admin/relatorio/editar';
        $dados['relatorio'] = $relatorio;
    
        $this->carregarViews('admin/dash', $dados);
    }
    
    public function salvarEdicao()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_relatorio'];
            $tipo = $_POST['tipo_relatorio'];
            $dados = $_POST['dados_relatorio'];
    
            $this->modelRelatorio->atualizarRelatorio($id, $tipo, $dados);
    
            header('Location: ' . URL_BASE . 'relatorio/listar');
            exit;
        }
    }

    public function adicionar()
{
    $dados['funcionarios'] = $this->modelRelatorio->listarTodos(); // carrega os nomes
    $dados['conteudo'] = 'admin/relatorio/adicionar';
    $this->carregarViews('admin/dash', $dados);
}

public function salvar()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tipo = $_POST['tipo_relatorio'];
        $dadosRel = $_POST['dados_relatorio'];
        $idFuncionario = $_POST['id_funcionario'];

        $this->modelRelatorio->inserirRelatorio($tipo, $dadosRel, $idFuncionario);

        header('Location: ' . URL_BASE . 'relatorio/listar');
        exit;
    }
}


public function desativar($id)
{

    $resultado = $this->modelRelatorio->desativarRelatorio($id);

    if ($resultado) {
        //Retornar a resposta do AJAX
        echo json_encode(['sucesso' => true]);
    } else {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao Excluir o Relatorio.']);
    }
}



}