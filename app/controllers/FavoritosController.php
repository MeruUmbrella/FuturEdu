<?php
class FavoritosController extends Controller
{
    private $modelFavorito;

    public function __construct()
    {

        $this->modelFavorito = new Favorito(); // seu model Favorito
    }

    // Método toggle para favoritar ou desfavoritar
    public function toggle($id_imovel)
    {
        session_start();

        if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'cliente') {
            // redireciona ou exibe erro para não logados ou não clientes
            header('Location: ' . URL_BASE . 'login');
            exit;
        }

        $id_cliente = $_SESSION['tipo_id'];

        // Verifica se já está favoritado
        $existe = $this->modelFavorito->verificar($id_cliente, $id_imovel);

        if ($existe) {
            // já favoritado, remove
            $this->modelFavorito->remover($id_cliente, $id_imovel);
        } else {
            // não favoritado, adiciona
            $this->modelFavorito->adicionar($id_cliente, $id_imovel);
        }

        // Redireciona de volta para a página anterior ou para o detalhe do imóvel
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    public function remover($id_imovel)
    {


        if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'cliente') {
            header('Location: ' . URL_BASE . 'login');
            exit;
        }

        $id_cliente = $_SESSION['tipo_id'];

        $this->modelFavorito->remover($id_cliente, $id_imovel);

        header('Location: ' . URL_BASE . 'cliente/listarFavoritos');
        exit;
    }
    public function listar()
    {


        if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'cliente') {
            header('Location: ' . URL_BASE . 'login');
            exit;
        }

        $id_cliente = $_SESSION['tipo_id'];

        $favoritos = $this->modelFavorito->listarFavoritosPorId($id_cliente);

        $dados = [
            'favoritos' => $favoritos,
            'titulo' => 'Meus Favoritos'



        ];

        $this->carregarViews('cliente/favoritos', $dados);
    }
    public function listagem()
    {
        $id_cliente = $_SESSION['id_cliente'] ?? null;

        if ($id_cliente) {
            $favoritoModel = new Favorito();
            $favoritos = $favoritoModel->getFavoritosByCliente($id_cliente);
            $dados['favoritos'] = $favoritos;
        } else {
            $dados['favoritos'] = [];
        }

        $this->carregarViews('admin/favoritos/listagem', $dados);
    }
}
