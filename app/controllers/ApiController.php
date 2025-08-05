<?php

class ApiController extends Controller
{

    private $imovelModel;
    private $filtrarModel;
    private $localidadeEnderecoModel;
    private $localidadeEstadoModel;
    private $localidadeBairroModel;
    private $valorModel;
    private $areaModel;
    private $areaExpModel;
    private $quartoImovel;
    private $suiteImovel;
    private $banheiroModel;
    private $vagasModel;
    private $condModel;
    private $financModel;
    private $mobiliadoModel;
    private $petsModel;
    private $escrituraModel;
    private $tipoModel;
    private $favoritosModel;
    private $piscinaModel;
    private $salaoFestasModel;
    private $churrasqueiraModel;
    private $quadraEsportesModel;
    private $espacoGourmetModel;
    private $brinquedotecaModel;
    private $playgroundModel;
    private $portaria24hModel;
    private $segurancaModel;
    private $bicicletarioModel;
    private $elevadorModel;
    private $vagaVisitanteModel;
    private $geradorEnergiaModel;
    private $wifiComumModel;
    private $coworkingModel;
    private $lavanderiaCompartilhadaModel;
    private $petPlaceModel;
    private $atualizaModel;
    private $clienteModel;


    public function __construct()
    {

        $this->imovelModel = new Imovel();
        $this->filtrarModel = new Filtro();
        $this->clienteModel = new Cliente();
    }

    // Parte Felipe ==========================================================================


    public function ListarImoveis()
    {
        // echo 'teste';

        $imovel = $this->imovelModel->getTodosImoveis();

        if (empty($imovel)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum curso encontrado"]);
            return;
        }

        // O json está trazendo a variavel ja codificada |  
        echo json_encode($imovel, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function ListarAnuncioImovel($tipo)
    {

        $tipo = $this->filtrarModel->getFiltrarImovel($tipo);

        if (empty($tipo)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imovel Encontrado!!!"]);
            return;
        }

        echo json_encode($tipo, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    //Localização de Imoveis--------------------------------------------

    public function LocalidadeEstadoImovel($estado)
    {

        $estado = $this->localidadeEstadoModel->getEstadoImovel($estado);

        if (empty($estado)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Esse local não existe!!!"]);
            return;
        }

        echo json_encode($estado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function LocalidadeBairroImovel($bairro)
    {

        $bairro = $this->localidadeBairroModel->getBairroImovel($bairro);

        if (empty($bairro)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Esse local não existe!!!"]);
            return;
        }

        echo json_encode($bairro, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function LocalidadeEnderecoImovel($endereco)
    {

        $endereco = $this->localidadeEnderecoModel->getEnderecoImovel($endereco);

        if (empty($endereco)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Esse local não existe!!!"]);
            return;
        }

        echo json_encode($endereco, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Fim Localização de Imoveis--------------------------------------------

    // Infraestrutura Imovel -----------------------------------------------------

    public function ListarPiscinaImovel($piscina)
    {
        $piscina = $this->piscinaModel->getPiscina($piscina);

        if (empty($piscina)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com piscina encontrado!"]);
            return;
        }

        echo json_encode($piscina, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarAcademiaImovel($academia)
    {
        $academia = $this->filtrarModel->getAcademia($academia);

        if (empty($academia)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com academia encontrado!"]);
            return;
        }

        echo json_encode($academia, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarSalaoFestasImovel($salao)
    {
        $resultado = $this->salaoFestasModel->getSalaoFesta($salao);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com salão de festas encontrado!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarChurrasqueiraImovel($churrasqueira)
    {
        $resultado = $this->churrasqueiraModel->getChurrasqueira($churrasqueira);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com churrasqueira encontrado!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarQuadraEsportesImovel($quadra)
    {
        $resultado = $this->quadraEsportesModel->getQuadraEsporte($quadra);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com quadra de esportes encontrado!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarEspacoGourmetImovel($gourmet)
    {
        $resultado = $this->espacoGourmetModel->getGourmet($gourmet);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com espaço gourmet encontrado!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarBrinquedotecaImovel($brinquedoteca)
    {
        $resultado = $this->brinquedotecaModel->getBrinquedoteca($brinquedoteca);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com brinquedoteca encontrado!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarPlaygroundImovel($playground)
    {
        $resultado = $this->playgroundModel->getPlayground($playground);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com playground encontrado!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarPortaria24hImovel($portaria24)
    {
        $resultado = $this->portaria24hModel->getPortaria24($portaria24);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com portaria 24h encontrado!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarSegurancaImovel($seguranca)
    {
        $resultado = $this->segurancaModel->getSeguranca($seguranca);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com segurança encontrado!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarBicicletarioImovel($bicicleta)
    {
        $resultado = $this->bicicletarioModel->getBicicletario($bicicleta);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com bicicletário encontrado!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarElevadorImovel($elevador)
    {
        $resultado = $this->elevadorModel->getElevador($elevador);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com elevador encontrado!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarVagaVisitanteImovel($vagasvisits)
    {
        $resultado = $this->vagaVisitanteModel->getVisitantes($vagasvisits);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com vaga para visitante encontrado!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarGeradorEnergiaImovel($gerador)
    {
        $resultado = $this->geradorEnergiaModel->getGeradorEnergia($gerador);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com gerador de energia encontrado!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarWifiComumImovel($wifi)
    {
        $resultado = $this->wifiComumModel->getWifiComum($wifi);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com Wi-Fi comum encontrado!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarCoworkingImovel($coworking)
    {
        $resultado = $this->coworkingModel->getCoworking($coworking);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com coworking encontrado!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarLavanderiaCompartilhadaImovel($lavanderia)
    {
        $resultado = $this->lavanderiaCompartilhadaModel->getLavanderia($lavanderia);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com lavanderia compartilhada encontrado!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ListarPetPlaceImovel($petplace)
    {
        $resultado = $this->petPlaceModel->getPetPlace($petplace);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel com pet place encontrado!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Fim Infraestrutura Imovel -------------------------------------------------

    //Valor Imoveís----------------------------------------------------------

    public function valorImovel($valor)
    {

        $valor = $this->valorModel->getValorImovel($valor);

        if (empty($valor)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Não Temos Imóvel desse Preço!!!"]);
            return;
        }

        echo json_encode($valor, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    //Fim Valor Imóvel-------------------------------------------------------


    //Area Imovel-----------------------------------------------------------

    public function areaImovel($area)
    {

        $area = $this->areaModel->gerAreaImovel($area);

        if (empty($area)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Não Temos Imóvel desse Preço!!!"]);
            return;
        }

        echo json_encode($area, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function areaImovelExata($areaExp)
    {

        $areaExp = $this->areaExpModel->getImovelPorAreaExata($areaExp);

        if (empty($areaExp)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Não Temos Imóvel desse Preço!!!"]);
            return;
        }

        echo json_encode($areaExp, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    //Fim Area Imovel-------------------------------------------------------

    //Numero de Quartos_Banheiros_Suites_vagasGaragem---------------------------------------------------

    public function numeroQuartosImovel($quarto)
    {

        $quarto = $this->quartoImovel->getImovelPorQuarto($quarto);

        if (empty($quarto)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Não Temos Imóvel desse Preço!!!"]);
            return;
        }

        echo json_encode($quarto, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function numeroSuitesImovel($suite)
    {

        $suite = $this->suiteImovel->getSuitesPorQuarto($suite);

        if (empty($suite)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Não Temos Imóvel desse Preço!!!"]);
            return;
        }

        echo json_encode($suite, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function numeroBanheirosImovel($banheiro)
    {

        $banheiro = $this->banheiroModel->getBanheiroImovel($banheiro);

        if (empty($banheiro)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Não Temos Imóvel desse Preço!!!"]);
            return;
        }

        echo json_encode($banheiro, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function numeroVagasGaragemImovel($vagas)
    {

        $vagas = $this->vagasModel->getVagasGararemImovel($vagas);

        if (empty($vagas)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Não Temos Imóvel desse Preço!!!"]);
            return;
        }

        echo json_encode($vagas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function NovoTipo()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $titulo = $_POST["titulo_tipo_imovel"] ?? '';

            $novoTipo = $this->imovelModel->postNovoTipo($titulo);
            if ($novoTipo) {
                http_response_code(200);
            } else {
                http_response_code(404);
            }
        }
    }

    public function agendarVisita()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $contentType = $_SERVER["CONTENT_TYPE"] ?? '';
            if (stripos($contentType, 'application/json') !== false) {
                $dados = json_decode(file_get_contents("php://input"), true);
            } else {
                $dados = $_POST;
            }

            if (!isset($dados['id_imovel']) || !isset($dados['id_cliente']) || !isset($dados['data_visita'])) {
                http_response_code(422);
                echo json_encode(["erro" => "Campos obrigatórios não informados."]);
                return;
            }

            // Sanitização
            $id_imovel = filter_var($dados['id_imovel'], FILTER_SANITIZE_NUMBER_INT);
            $id_cliente = filter_var($dados['id_cliente'], FILTER_SANITIZE_NUMBER_INT);
            $data_visita = filter_var($dados['data_visita'], FILTER_SANITIZE_SPECIAL_CHARS);
            $status_agendamento = filter_var($dados['status_agendamento'], FILTER_SANITIZE_SPECIAL_CHARS);

            // Inserir via model
            $resultado = $this->imovelModel->agendamentoImovel($id_imovel, $id_cliente, $data_visita, $status_agendamento);

            if ($resultado) {
                http_response_code(201);
                echo json_encode(["mensagem" => "Visita agendada com sucesso."]);
            } else {
                http_response_code(500);
                echo json_encode(["erro" => "Erro ao agendar visita."]);
            }
        } else {
            http_response_code(405);
            echo json_encode(["erro" => "Método não permitido. Use POST."]);
        }
    }


    //Fim Numero de Quartos_Banheiros_Suites_vagasGaragem-----------------------------------------------

    // Fim Parte Felipe ===============================================================================

    //Parte Erick--------------------------------------------------------------------------------------

    public function atualizarImovel($id_imovel)
    {
        // Captura o JSON enviado no corpo da requisição
        $json = file_get_contents("php://input");
        $dados = json_decode($json, true);

        // VERIFICAÇÃO DE JSON DEVE VIR PRIMEIRO
        if (empty($dados)) {
            http_response_code(400);
            echo json_encode(["erro" => "Nenhum dado foi enviado para atualizar."]);
            return;
        }

        // Exemplo de validação mínima
        if (!isset($dados['nome_imovel']) || !isset($dados['preco_imovel'])) {
            http_response_code(422);
            echo json_encode(["erro" => "Campos obrigatórios 'nome_imovel' e 'preco_imovel' não informados."]);
            return;
        }

        // Agora sim, processa os dados
        $id_tipo_imovel = $dados['id_tipo_imovel'] ?? null;
        $id_proprietario = $dados['id_proprietario'] ?? null;
        $cep_imovel = $dados['cep_imovel'] ?? null;
        $endereco_imovel = $dados['endereco_imovel'] ?? null;
        $complemento_imovel = $dados['complemento_imovel'] ?? null;
        $bairro_imovel = $dados['bairro_imovel'] ?? null;
        $estado_imovel = $dados['estado_imovel'] ?? null;
        $descricao_imovel = $dados['descricao_imovel'] ?? null;
        $preco_imovel = $dados['preco_imovel'] ?? null;
        $status_imovel = $dados['status_imovel'] ?? null;
        $tipo_anuncio_imovel = $dados['tipo_anuncio_imovel'] ?? null;
        $duracao_anuncio_imovel = $dados['duracao_anuncio_imovel'] ?? null;
        $data_publicacao_imovel = $dados['data_publicacao_imovel'] ?? null;
        $nome_imovel = $dados['nome_imovel'] ?? null;
        $foto_imovel = $dados['foto_imovel'] ?? null;
        $quarto_imovel = $dados['quarto_imovel'] ?? null;
        $metro_imovel = $dados['metro_imovel'] ?? null;
        $condominio_fechado = $dados['condominio_fechado'] ?? null;
        $aceita_financiamento = $dados['aceita_financiamento'] ?? null;
        $imovel_mobiliado = $dados['imovel_mobiliado'] ?? null;
        $aceita_pets = $dados['aceita_pets'] ?? null;
        $possui_escritura = $dados['possui_escritura'] ?? null;
        $tipo_imovel = $dados['tipo_imovel'] ?? null;
        $suite_imovel = $dados['suite_imovel'] ?? null;
        $banheiro_imovel = $dados['banheiro_imovel'] ?? null;
        $vagas_garagem_imovel = $dados['vagas_garagem_imovel'] ?? null;
        $data_atualizacao_imovel = $dados['data_atualizacao_imovel'] ?? date('Y-m-d');
        $piscina_imovel = $dados['piscina_imovel'] ?? null;
        $academia_imovel = $dados['academia_imovel'] ?? null;
        $salao_festas_imovel = $dados['salao_festas_imovel'] ?? null;
        $churrasqueira_imovel = $dados['churrasqueira_imovel'] ?? null;
        $quadra_esportes_imovel = $dados['quadra_esportes_imovel'] ?? null;
        $espaco_gourmet_imovel = $dados['espaco_gourmet_imovel'] ?? null;
        $brinquedoteca_imovel = $dados['brinquedoteca_imovel'] ?? null;
        $playground_imovel = $dados['playground_imovel'] ?? null;
        $portaria_24h_imovel = $dados['portaria_24h_imovel'] ?? null;
        $seguranca_imovel = $dados['seguranca_imovel'] ?? null;
        $bicicletario_imovel = $dados['bicicletario_imovel'] ?? null;
        $elevador_imovel = $dados['elevador_imovel'] ?? null;
        $vaga_visitante_imovel = $dados['vaga_visitante_imovel'] ?? null;
        $gerador_energia_imovel = $dados['gerador_energia_imovel'] ?? null;
        $wifi_comum_imovel = $dados['wifi_comum_imovel'] ?? null;
        $coworking_imovel = $dados['coworking_imovel'] ?? null;
        $lavanderia_compartilhada_imovel = $dados['lavanderia_compartilhada_imovel'] ?? null;
        $pet_place_imovel = $dados['pet_place_imovel'] ?? null;

        // Agora sim, chama o model
        $resultado = $this->imovelModel->updateImovelByID(
            id_imovel: $id_imovel,
            id_tipo_imovel: $id_tipo_imovel,
            id_proprietario: $id_proprietario,
            cep_imovel: $cep_imovel,
            endereco_imovel: $endereco_imovel,
            complemento_imovel: $complemento_imovel,
            bairro_imovel: $bairro_imovel,
            estado_imovel: $estado_imovel,
            descricao_imovel: $descricao_imovel,
            preco_imovel: $preco_imovel,
            status_imovel: $status_imovel,
            tipo_anuncio_imovel: $tipo_anuncio_imovel,
            duracao_anuncio_imovel: $duracao_anuncio_imovel,
            data_publicacao_imovel: $data_publicacao_imovel,
            nome_imovel: $nome_imovel,
            foto_imovel: $foto_imovel,
            quarto_imovel: $quarto_imovel,
            metro_imovel: $metro_imovel,
            condominio_fechado: $condominio_fechado,
            aceita_financiamento: $aceita_financiamento,
            imovel_mobiliado: $imovel_mobiliado,
            aceita_pets: $aceita_pets,
            possui_escritura: $possui_escritura,
            tipo_imovel: $tipo_imovel,
            suite_imovel: $suite_imovel,
            banheiro_imovel: $banheiro_imovel,
            vagas_garagem_imovel: $vagas_garagem_imovel,
            data_atualizacao_imovel: $data_atualizacao_imovel,
            piscina_imovel: $piscina_imovel,
            academia_imovel: $academia_imovel,
            salao_festas_imovel: $salao_festas_imovel,
            churrasqueira_imovel: $churrasqueira_imovel,
            quadra_esportes_imovel: $quadra_esportes_imovel,
            espaco_gourmet_imovel: $espaco_gourmet_imovel,
            brinquedoteca_imovel: $brinquedoteca_imovel,
            playground_imovel: $playground_imovel,
            portaria_24h_imovel: $portaria_24h_imovel,
            seguranca_imovel: $seguranca_imovel,
            bicicletario_imovel: $bicicletario_imovel,
            elevador_imovel: $elevador_imovel,
            vaga_visitante_imovel: $vaga_visitante_imovel,
            gerador_energia_imovel: $gerador_energia_imovel,
            wifi_comum_imovel: $wifi_comum_imovel,
            coworking_imovel: $coworking_imovel,
            lavanderia_compartilhada_imovel: $lavanderia_compartilhada_imovel,
            pet_place_imovel: $pet_place_imovel
        );

        if ($resultado) {
            http_response_code(200);
            echo json_encode(["mensagem" => "Imóvel atualizado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["erro" => "Erro ao atualizar o imóvel. Erro interno no servidor."]);
        }
    }

    public function adicionarCliente()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $_POST;

            // Validação básica
            if (
                !isset($dados['nome_cliente']) || !isset($dados['email_cliente']) || !isset($dados['senha_cliente']) ||
                !isset($dados['cpf_cliente']) || !isset($dados['cep_cliente']) || !isset($dados['endereco_cliente']) ||
                !isset($dados['bairro_cliente']) || !isset($dados['estado_cliente']) || !isset($dados['foto_cliente']) ||
                !isset($dados['alt_cliente']) || !isset($dados['status_cliente'])
            ) {
                http_response_code(422);
                echo json_encode(["erro" => "Campos obrigatórios não informados."]);
                return;
            }

            // Sanitização
            $nome        = filter_var($dados['nome_cliente'], FILTER_SANITIZE_SPECIAL_CHARS);
            $email       = filter_var($dados['email_cliente'], FILTER_SANITIZE_EMAIL);
            $senha       = password_hash($dados['senha_cliente'], PASSWORD_DEFAULT);
            $cpf         = filter_var($dados['cpf_cliente'], FILTER_SANITIZE_SPECIAL_CHARS);
            $cep         = filter_var($dados['cep_cliente'], FILTER_SANITIZE_SPECIAL_CHARS);
            $endereco    = filter_var($dados['endereco_cliente'], FILTER_SANITIZE_SPECIAL_CHARS);
            $bairro      = filter_var($dados['bairro_cliente'], FILTER_SANITIZE_SPECIAL_CHARS);
            $estado      = filter_var($dados['estado_cliente'], FILTER_SANITIZE_SPECIAL_CHARS);
            $foto        = filter_var($dados['foto_cliente'], FILTER_SANITIZE_SPECIAL_CHARS);
            $alt         = filter_var($dados['alt_cliente'], FILTER_SANITIZE_SPECIAL_CHARS);
            $status      = filter_var($dados['status_cliente'], FILTER_SANITIZE_SPECIAL_CHARS);
            $dataCriacao = date('Y-m-d');

            // Inserir via model
            $resultado = $this->clienteModel->inserirCliente(
                $nome,
                $email,
                $senha,
                $cpf,
                $cep,
                $endereco,
                $bairro,
                $estado,
                $foto,
                $alt,
                $status,
                $dataCriacao
            );

            if ($resultado) {
                http_response_code(201);
                echo json_encode(["mensagem" => "Cliente adicionado com sucesso."]);
            } else {
                http_response_code(500);
                echo json_encode(["erro" => "Erro ao adicionar cliente."]);
            }
        } else {
            http_response_code(405);
            echo json_encode(["erro" => "Método não permitido. Use POST."]);
        }
    }

    public function atualizarClientePorId($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "PATCH") {

            parse_str(file_get_contents("php://input"), $dados);

            if (empty($dados)) {

                http_response_code(404);
                echo json_encode(["erro" => "Nenhum dado foi enviado para a atualização..."]);
                return;
            }

            $resultado = $this->clienteModel->patchAtualizarCliente(
                $id,
                $dados['nome_cliente'] ?? null,
                $dados['email_cliente'] ?? null,
                $dados['senha_cliente'] ?? null,
                $dados['cpf_cliente'] ?? null,
                $dados['cep_cliente'] ?? null,
                $dados['endereco_cliente'] ?? null,
                $dados['bairro_cliente'] ?? null,
                $dados['estado_cliente'] ?? null,
                $dados['foto_cliente'] ?? null,
                $dados['alt_cliente'] ?? null,
                $dados['status_cliente'] ?? null,
                date('Y-m-d')
            );

            if ($resultado) {
                http_response_code(200);
                echo json_encode(["Mensagem" => "Cliente atualizado com sucesso!"]);
            } else {
                http_response_code(500);
                echo json_encode(["erro" => "Erro ao atualizar o cliente | Erro do Servidor..."]);
            }
        } else {
            http_response_code(405);
            echo json_encode(["erro" => "Método não Permitido!"]);
        }
    }

    // Condominio Fechado------------------------------------------------------------------------------

    public function condominioFechado($valor)
    {
        $resultado = $this->condModel->getCondominioFechado($valor);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel Encontrado!!!"]);
            return;
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    // Financiamento ----------------------------------------------------------------------------------

    public function aceitaFinanciamento($valor)
    {
        $resultado = $this->financModel->getAceitaFinanciamento($valor);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel Encontrado!!!"]);
            return;
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    //Imovel Imobiliado ------------------------------------------------------------------------------
    public function imovelMobiliado($valor)
    {
        $resultado = $this->mobiliadoModel->getImovelMobiliado($valor);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel Encontrado!!!"]);
            return;
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    //Aceita pets?------------------------------------------------------------------------------------

    public function aceitaPets($valor)
    {
        $resultado = $this->petsModel->getAceitaPets($valor);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel Encontrado!!!"]);
            return;
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    //Possui Escritura?------------------------------------------------------------------------------

    public function possuiEscritura($valor)
    {
        $resultado = $this->escrituraModel->getPossuiEscritura($valor);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel Encontrado!!!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    //Imovel novo ou usado?-------------------------------------------------------------------------

    public function tipoImovel($valor)
    {
        $resultado = $this->tipoModel->getTipoImovel($valor);

        if (empty($resultado)) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum Imóvel Encontrado!!!"]);
            return;
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Parte Hissam -------------------------------------------------------------------------------

    // Favoritos ---------------------------------------------------------------------------------------

    public function favoritosImovel($favoritos)
    {

        $resultado = $this->favoritosModel->getFavoritosImovel($favoritos);

        if (empty($resultado)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Não Temos Imóvel desse Preço!!!"]);
            return;
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    // Fim Favoritos -----------------------------------------------------------------------------------

}
