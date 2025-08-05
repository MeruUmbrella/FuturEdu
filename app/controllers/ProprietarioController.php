<?php

class ProprietarioController extends Controller
{
    private $modelProprietario;

    public function __construct()
    {
        $this->modelProprietario = new Proprietario();
    }

    public function listar()
    {
        $dados = [];
        $dados['conteudo'] = 'admin/proprietario/listar';

        $dados['proprietarios'] = $this->modelProprietario->getProprietario();

        $this->carregarViews('admin/dash', $dados);
    }

    public function editar($id)
{
    $proprietario = $this->modelProprietario->getById($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dados = $_POST;

        if (!is_dir('upload/proprietario')) {
            mkdir('upload/proprietario', 0755, true);
        }

        if (isset($_FILES['foto_proprietario']) && $_FILES['foto_proprietario']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['foto_proprietario']['name'], PATHINFO_EXTENSION);
            $nomeFoto = uniqid() . '.' . $ext;
            $caminho = 'upload/proprietario/' . $nomeFoto;

            // Move o arquivo e verifica sucesso
            if (move_uploaded_file($_FILES['foto_proprietario']['tmp_name'], $caminho)) {
                // Remove a foto antiga se existir
                if (!empty($proprietario['foto_proprietario']) && file_exists('upload/proprietario/' . $proprietario['foto_proprietario'])) {
                    unlink('upload/proprietario/' . $proprietario['foto_proprietario']);
                }
                $dados['foto_proprietario'] = $nomeFoto;
            } else {
                // Falha ao mover arquivo
                $dados['foto_proprietario'] = $proprietario['foto_proprietario'];
                // Opcional: setar mensagem de erro para o usuário
                echo "Erro ao salvar a foto.";
            }
        } else {
            $dados['foto_proprietario'] = $proprietario['foto_proprietario'];
        }

        $dados['alt_proprietario'] = $_POST['alt_proprietario'] ?? '';
        $dados['status_proprietario'] = $_POST['status_proprietario'] ?? 'Ativo';

        $this->modelProprietario->atualizarProprietario($id, $dados);

        header('Location: ' . URL_BASE . 'proprietario/editar/' . $id . '?sucesso=true');
        exit;
    }

    $dados = [
        'proprietario' => $proprietario,
        'conteudo' => 'admin/proprietario/editar'
    ];
    $this->carregarViews('admin/dash', $dados);
}

    


    public function atualizarStatus()
    {
        $dados = json_decode(file_get_contents('php://input'), true);
    
        if (isset($dados['id_proprietario'], $dados['status_proprietario'])) {
            $id = $dados['id_proprietario'];
            $status = $dados['status_proprietario'];
    
            $sucesso = $this->modelProprietario->atualizarStatus($id, $status);
    
            echo json_encode(['sucesso' => $sucesso]);
        } else {
            echo json_encode(['sucesso' => false]);
        }
    }

    public function excluir($id)
    {
        $this->modelProprietario->excluir($id);
        header('Location: ' . URL_BASE . 'proprietario/listar');
        exit;
    }

   

    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $_POST;

            if (!is_dir('upload/proprietario')) {
                mkdir('upload/proprietario', 0755, true);
            }

            if (isset($_FILES['foto_proprietario']) && $_FILES['foto_proprietario']['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['foto_proprietario']['name'], PATHINFO_EXTENSION);
                $nomeFoto = uniqid() . '.' . $ext;
                $caminho = 'upload/proprietario/' . $nomeFoto;

                if (move_uploaded_file($_FILES['foto_proprietario']['tmp_name'], $caminho)) {
                    $dados['foto_proprietario'] = $nomeFoto;
                } else {
                    $dados['foto_proprietario'] = null;
                }
            } else {
                $dados['foto_proprietario'] = null;
            }

            $dados['alt_proprietario'] = $_POST['alt_proprietario'] ?? '';
            $dados['status_proprietario'] = $_POST['status_proprietario'] ?? 'Ativo';

            $sucesso = $this->modelProprietario->inserirProprietario($dados);

            if ($sucesso) {
                header('Location: ' . URL_BASE . 'proprietario/listar?sucesso=true');
                exit;
            } else {
                $erro = "Erro ao salvar o proprietário.";
            }
        }

        $dadosView = [
            'erro' => $erro ?? null,
            'conteudo' => 'admin/proprietario/adicionar'
        ];
        $this->carregarViews('admin/dash', $dadosView);
    }

   
}


