<?php

class Imovel extends Model
{
    public function getTodosImoveis()
    {
        $sql = "SELECT 
    i.*, 
    (
        SELECT f.url_foto_imovel 
        FROM tbl_foto_imovel f 
        WHERE f.id_imovel = i.id_imovel 
        LIMIT 1
    ) AS url_foto_imovel,

    -- Características do imóvel
    c.qtd_quartos,
    c.qtd_suites,
    c.qtd_banheiros,
    c.qtd_salas,
    c.qtd_cozinhas,
    c.qtd_varandas,
    c.qtd_lavanderias,
    c.qtd_escritorios,
    c.qtd_despensas,
    c.qtd_closets,
    c.qtd_piscinas,
    c.qtd_churrasqueiras,
    c.qtd_saloes_festas,
    c.qtd_playgrounds,
    c.qtd_academias,
    c.qtd_saunas,
    c.qtd_cinema,
    c.qtd_espacos_gourmet,
    c.qtd_bibliotecas,
    c.qtd_espacos_pets,
    c.qtd_elevadores,
    c.qtd_vagas_garagem,
    c.qtd_jardins,
    c.qtd_hall_social,
    c.qtd_depositos,

    -- Recursos (booleanos)
    c.possui_cameras_seguranca,
    c.possui_cerca_eletrica,
    c.possui_portaria_24h,
    c.possui_interfone,
    c.possui_wifi,
    c.possui_paineis_solares,
    c.possui_gerador_emergencia,
    c.possui_rampa_acesso,
    c.possui_banheiro_acessivel,
    c.possui_sinalizacao_braile,

    -- Observações
    c.observacoes

FROM 
    tbl_imovel AS i
LEFT JOIN 
    tbl_caracteristicas_imovel AS c ON i.id_imovel = c.id_imovel
WHERE 
    i.status_imovel = 'Disponivel';
";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    public function getFiltrar($tipo = null)
    {
        $sql = "SELECT 
        i.id_imovel, 
        i.nome_imovel, 
        i.endereco_imovel, 
        i.preco_imovel, 
        f.url_foto_imovel,
        i.tipo_anuncio_imovel,
        i.foto_imovel,
        i.descricao_imovel,
        i.complemento_imovel,
        i.bairro_imovel,
        p.nome_proprietario
    FROM 
        tbl_imovel AS i
    INNER JOIN 
        tbl_foto_imovel AS f ON i.id_imovel = f.id_imovel
    INNER JOIN 
        tbl_proprietario AS p ON i.id_proprietario = p.id_proprietario WHERE status_imovel = 'Disponivel'";

        if ($tipo) {
            $sql .= " WHERE i.tipo_anuncio_imovel = :tipo_anuncio_imovel";
        }

        $stmt = $this->db->prepare($sql);

        if ($tipo) {
            $stmt->bindValue(':tipo_anuncio_imovel', $tipo);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getFiltrarImovel($tipo)
    {
        $sql = "SELECT * FROM tbl_imovel
                WHERE tipo_anuncio_imovel LIKE :tipo_anuncio_imovel";

        $stmt = $this->db->prepare($sql);

        $tipo = '%' . $tipo . '%';
        $stmt->bindParam(':tipo_anuncio_imovel', $tipo, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getFiltrarAvancado($filtros)
    {
        $sql = "SELECT 
                    i.id_imovel, 
                    i.nome_imovel, 
                    i.endereco_imovel, 
                    i.preco_imovel, 
                    f.url_foto_imovel,
                    i.tipo_anuncio_imovel,
                    i.foto_imovel,
                    i.descricao_imovel,
                    i.complemento_imovel,
                    i.bairro_imovel,
                    t.descricao_tipo_imovel AS tipo_imovel,
                    i.quarto_imovel,
                    i.vagas_garagem_imovel,
                    i.condominio_fechado,
                    p.nome_proprietario
                FROM 
                
                    tbl_imovel AS i
                INNER JOIN 
                    tbl_foto_imovel AS f ON i.id_imovel = f.id_imovel
                INNER JOIN 
                    tbl_proprietario AS p ON i.id_proprietario = p.id_proprietario
                INNER JOIN
                    tbl_tipo_imovel AS t ON i.id_tipo_imovel = t.id_tipo_imovel
                WHERE 1=1";

        $params = [];

        if (!empty($filtros['tipo'])) {
            $sql .= " AND (
                i.tipo_anuncio_imovel LIKE :tipo
                OR i.nome_imovel LIKE :tipo
                OR i.piscina_imovel LIKE :tipo
            )";
            $params[':tipo'] = "%" . $filtros['tipo'] . "%";
        }

        if (!empty($filtros['valor'])) {
            list($min, $max) = explode('-', $filtros['valor']);
            $sql .= " AND i.preco_imovel BETWEEN :valormin AND :valormax";
            $params[':valormin'] = $min;
            $params[':valormax'] = $max;
        }

        if (!empty($filtros['condominio'])) {
            if ($filtros['condominio'] === 'sim') {
                $sql .= " AND i.condominio_fechado IS NOT NULL";
            } elseif ($filtros['condominio'] === 'nao') {
                $sql .= " AND (i.condominio_fechado IS NULL OR i.condominio_fechado = 0)";
            }
        }

        if (!empty($filtros['tipo_imovel'])) {
            $sql .= " AND t.descricao_tipo_imovel = :tipo_imovel";
            $params[':tipo_imovel'] = $filtros['tipo_imovel'];
        }

        if (!empty($filtros['quartos'])) {
            $sql .= " AND i.quarto_imovel >= :quartos";
            $params[':quartos'] = $filtros['quartos'];
        }

        if (!empty($filtros['vagas'])) {
            $sql .= " AND i.vagas_garagem_imovel >= :vagas";
            $params[':vagas'] = $filtros['vagas'];
        }

        // Filtros das comodidades
        $comodidades = [
            'piscina_imovel',
            'academia_imovel',
            'salao_festas_imovel',
            'churrasqueira_imovel',
            'quadra_esportes_imovel',
            'espaco_gourmet_imovel',
            'brinquedoteca_imovel',
            'playground_imovel',
            'portaria_24h_imovel',
            'seguranca_imovel',
            'bicicletario_imovel',
            'elevador_imovel',
            'vaga_visitante_imovel',
            'gerador_energia_imovel'
        ];

        foreach ($comodidades as $comodidade) {
            if (!empty($filtros[$comodidade])) {
                $sql .= " AND i.$comodidade = 1";
            }
        }


        $stmt = $this->db->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function postNovoTipo($titulo)
    {
        $sql = "INSERT INTO tbl_tipo_imovel(descricao_tipo_imovel) VALUES(:desc)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":desc", $titulo);
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function editarImovel($dados)
    {
        // Atualiza os dados do imóvel
        $sql = "UPDATE tbl_imovel SET 
                nome_imovel             = :nome_imovel, 
                tipo_anuncio_imovel     = :tipo_anuncio_imovel,
                endereco_imovel         = :endereco_imovel,
                bairro_imovel           = :bairro_imovel,
                cep_imovel              = :cep_imovel,
                estado_imovel           = :estado_imovel,
                complemento_imovel      = :complemento_imovel,
                descricao_imovel        = :descricao_imovel,
                preco_imovel            = :preco_imovel,
                data_publicacao_imovel  = :data_publicacao_imovel,
                data_atualizacao_imovel = :data_atualizacao_imovel,
                status_imovel           = :status_imovel
         WHERE id_imovel = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome_imovel', $dados['nome_imovel']);
        $stmt->bindValue(':tipo_anuncio_imovel', $dados['tipo_anuncio_imovel']);
        $stmt->bindValue(':endereco_imovel', $dados['endereco_imovel']);
        $stmt->bindValue(':bairro_imovel', $dados['bairro_imovel']);
        $stmt->bindValue(':cep_imovel', $dados['cep_imovel']);
        $stmt->bindValue(':estado_imovel', $dados['estado_imovel']);
        $stmt->bindValue(':complemento_imovel', $dados['complemento_imovel']);
        $stmt->bindValue(':descricao_imovel', $dados['descricao_imovel']);
        $stmt->bindValue(':preco_imovel', $dados['preco_imovel']);
        $stmt->bindValue(':data_publicacao_imovel', $dados['data_publicacao_imovel']);
        $stmt->bindValue(':data_atualizacao_imovel', $dados['data_atualizacao_imovel']);
        $stmt->bindValue(':status_imovel', $dados['status_imovel']);
        $stmt->bindValue(':id', $dados['id_imovel']);

        $resultado = $stmt->execute();

        // Atualizar ou inserir a foto se necessário
        if ($resultado && !empty($dados['url_foto_imovel'])) {
            // Verifica se já existe uma foto associada ao imóvel
            $sqlCheck = "SELECT COUNT(*) as total FROM tbl_foto_imovel WHERE id_imovel = :id_imovel";
            $stmtCheck = $this->db->prepare($sqlCheck);
            $stmtCheck->bindValue(':id_imovel', $dados['id_imovel']);
            $stmtCheck->execute();
            $existeFoto = $stmtCheck->fetch(PDO::FETCH_ASSOC);

            if ($existeFoto['total'] > 0) {
                // Atualiza a foto
                $sqlFoto = "UPDATE tbl_foto_imovel SET url_foto_imovel = :arquivo WHERE id_imovel = :id_imovel";
            } else {
                // Insere nova foto
                $sqlFoto = "INSERT INTO tbl_foto_imovel (id_imovel, url_foto_imovel) VALUES (:id_imovel, :arquivo)";
            }

            $stmtFoto = $this->db->prepare($sqlFoto);
            $stmtFoto->bindValue(':id_imovel', $dados['id_imovel']);
            $stmtFoto->bindValue(':arquivo', $dados['url_foto_imovel']);
            $stmtFoto->execute();
        }

        return $resultado;
    }


    public function atualizarFotoImovel($id_imovel, $novaFoto)
    {
        $sql = "UPDATE tbl_foto_imovel SET url_foto_imovel = :foto WHERE id_imovel = :id_imovel";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':foto', $novaFoto);
        $stmt->bindValue(':id_imovel', $id_imovel);
        return $stmt->execute();
    }


    public function buscarImoveis($termo)
    {
        $sql = "SELECT 
                i.*, 
                f.url_foto_imovel,
                c.qtd_quartos,
                c.qtd_vagas_garagem,
                c.qtd_suites
            FROM 
                tbl_imovel AS i
            LEFT JOIN 
                tbl_foto_imovel AS f ON i.id_imovel = f.id_imovel
            LEFT JOIN 
                tbl_caracteristicas_imovel AS c ON i.id_imovel = c.id_imovel
            WHERE 
                i.nome_imovel LIKE :termo
                OR i.bairro_imovel LIKE :termo
                OR i.endereco_imovel LIKE :termo OR status_imovel = 'Disponivel'";
        $stmt = $this->db->prepare($sql);
        $like = '%' . $termo . '%';
        $stmt->bindParam(':termo', $like);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function updateImovelByID(
        $id_imovel,
        $id_tipo_imovel,
        $id_proprietario,
        $cep_imovel,
        $endereco_imovel,
        $complemento_imovel,
        $bairro_imovel,
        $estado_imovel,
        $descricao_imovel,
        $preco_imovel,
        $status_imovel,
        $tipo_anuncio_imovel,
        $duracao_anuncio_imovel,
        $data_publicacao_imovel,
        $nome_imovel,
        $foto_imovel,
        $quarto_imovel,
        $metro_imovel,
        $condominio_fechado,
        $aceita_financiamento,
        $imovel_mobiliado,
        $aceita_pets,
        $possui_escritura,
        $tipo_imovel,
        $suite_imovel,
        $banheiro_imovel,
        $vagas_garagem_imovel,
        $data_atualizacao_imovel,
        $piscina_imovel,
        $academia_imovel,
        $salao_festas_imovel,
        $churrasqueira_imovel,
        $quadra_esportes_imovel,
        $espaco_gourmet_imovel,
        $brinquedoteca_imovel,
        $playground_imovel,
        $portaria_24h_imovel,
        $seguranca_imovel,
        $bicicletario_imovel,
        $elevador_imovel,
        $vaga_visitante_imovel,
        $gerador_energia_imovel,
        $wifi_comum_imovel,
        $coworking_imovel,
        $lavanderia_compartilhada_imovel,
        $pet_place_imovel
    ) {
        $sql = "UPDATE tbl_imovel SET
                id_tipo_imovel = :id_tipo_imovel,
                id_proprietario = :id_proprietario,
                cep_imovel = :cep_imovel,
                endereco_imovel = :endereco_imovel,
                complemento_imovel = :complemento_imovel,
                bairro_imovel = :bairro_imovel,
                estado_imovel = :estado_imovel,
                descricao_imovel = :descricao_imovel,
                preco_imovel = :preco_imovel,
                status_imovel = :status_imovel,
                tipo_anuncio_imovel = :tipo_anuncio_imovel,
                duracao_anuncio_imovel = :duracao_anuncio_imovel,
                data_publicacao_imovel = :data_publicacao_imovel,
                nome_imovel = :nome_imovel,
                foto_imovel = :foto_imovel,
                quarto_imovel = :quarto_imovel,
                metro_imovel = :metro_imovel,
                condominio_fechado = :condominio_fechado,
                aceita_financiamento = :aceita_financiamento,
                imovel_mobiliado = :imovel_mobiliado,
                aceita_pets = :aceita_pets,
                possui_escritura = :possui_escritura,
                tipo_imovel = :tipo_imovel,
                suite_imovel = :suite_imovel,
                banheiro_imovel = :banheiro_imovel,
                vagas_garagem_imovel = :vagas_garagem_imovel,
                data_atualizacao_imovel = :data_atualizacao_imovel,
                piscina_imovel = :piscina_imovel,
                academia_imovel = :academia_imovel,
                salao_festas_imovel = :salao_festas_imovel,
                churrasqueira_imovel = :churrasqueira_imovel,
                quadra_esportes_imovel = :quadra_esportes_imovel,
                espaco_gourmet_imovel = :espaco_gourmet_imovel,
                brinquedoteca_imovel = :brinquedoteca_imovel,
                playground_imovel = :playground_imovel,
                portaria_24h_imovel = :portaria_24h_imovel,
                seguranca_imovel = :seguranca_imovel,
                bicicletario_imovel = :bicicletario_imovel,
                elevador_imovel = :elevador_imovel,
                vaga_visitante_imovel = :vaga_visitante_imovel,
                gerador_energia_imovel = :gerador_energia_imovel,
                wifi_comum_imovel = :wifi_comum_imovel,
                coworking_imovel = :coworking_imovel,
                lavanderia_compartilhada_imovel = :lavanderia_compartilhada_imovel,
                pet_place_imovel = :pet_place_imovel
            WHERE id_imovel = :id_imovel";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':id_imovel', $id_imovel);
        $stmt->bindValue(':id_tipo_imovel', $id_tipo_imovel);
        $stmt->bindValue(':id_proprietario', $id_proprietario);
        $stmt->bindValue(':cep_imovel', $cep_imovel);
        $stmt->bindValue(':endereco_imovel', $endereco_imovel);
        $stmt->bindValue(':complemento_imovel', $complemento_imovel);
        $stmt->bindValue(':bairro_imovel', $bairro_imovel);
        $stmt->bindValue(':estado_imovel', $estado_imovel);
        $stmt->bindValue(':descricao_imovel', $descricao_imovel);
        $stmt->bindValue(':preco_imovel', $preco_imovel);
        $stmt->bindValue(':status_imovel', $status_imovel);
        $stmt->bindValue(':tipo_anuncio_imovel', $tipo_anuncio_imovel);
        $stmt->bindValue(':duracao_anuncio_imovel', $duracao_anuncio_imovel);
        $stmt->bindValue(':data_publicacao_imovel', $data_publicacao_imovel);
        $stmt->bindValue(':nome_imovel', $nome_imovel);
        $stmt->bindValue(':foto_imovel', $foto_imovel);
        $stmt->bindValue(':quarto_imovel', $quarto_imovel);
        $stmt->bindValue(':metro_imovel', $metro_imovel);
        $stmt->bindValue(':condominio_fechado', $condominio_fechado);
        $stmt->bindValue(':aceita_financiamento', $aceita_financiamento);
        $stmt->bindValue(':imovel_mobiliado', $imovel_mobiliado);
        $stmt->bindValue(':aceita_pets', $aceita_pets);
        $stmt->bindValue(':possui_escritura', $possui_escritura);
        $stmt->bindValue(':tipo_imovel', $tipo_imovel);
        $stmt->bindValue(':suite_imovel', $suite_imovel);
        $stmt->bindValue(':banheiro_imovel', $banheiro_imovel);
        $stmt->bindValue(':vagas_garagem_imovel', $vagas_garagem_imovel);
        $stmt->bindValue(':data_atualizacao_imovel', $data_atualizacao_imovel);
        $stmt->bindValue(':piscina_imovel', $piscina_imovel);
        $stmt->bindValue(':academia_imovel', $academia_imovel);
        $stmt->bindValue(':salao_festas_imovel', $salao_festas_imovel);
        $stmt->bindValue(':churrasqueira_imovel', $churrasqueira_imovel);
        $stmt->bindValue(':quadra_esportes_imovel', $quadra_esportes_imovel);
        $stmt->bindValue(':espaco_gourmet_imovel', $espaco_gourmet_imovel);
        $stmt->bindValue(':brinquedoteca_imovel', $brinquedoteca_imovel);
        $stmt->bindValue(':playground_imovel', $playground_imovel);
        $stmt->bindValue(':portaria_24h_imovel', $portaria_24h_imovel);
        $stmt->bindValue(':seguranca_imovel', $seguranca_imovel);
        $stmt->bindValue(':bicicletario_imovel', $bicicletario_imovel);
        $stmt->bindValue(':elevador_imovel', $elevador_imovel);
        $stmt->bindValue(':vaga_visitante_imovel', $vaga_visitante_imovel);
        $stmt->bindValue(':gerador_energia_imovel', $gerador_energia_imovel);
        $stmt->bindValue(':wifi_comum_imovel', $wifi_comum_imovel);
        $stmt->bindValue(':coworking_imovel', $coworking_imovel);
        $stmt->bindValue(':lavanderia_compartilhada_imovel', $lavanderia_compartilhada_imovel);
        $stmt->bindValue(':pet_place_imovel', $pet_place_imovel);

        return $stmt->execute();
    }

    public function agendamentoImovel($id_imovel, $id_cliente, $data_visita, $status_agendamento)
    {
        $sql = "INSERT INTO tbl_agendamento (id_imovel, id_cliente, data_visita, status_agendamento)
                VALUES (:id_imovel, :id_cliente, :data_visita, :status_agendamento)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_imovel', $_POST['id_imovel']);
        $stmt->bindValue(':id_cliente', $_POST['id_cliente']);
        $stmt->bindValue(':data_visita', $_POST['data_visita']);
        $stmt->bindValue(':status_agendamento', 'pendente');

        return $stmt->execute();
    }


    public function carregarDados($id)
    {
        $sql = "SELECT 
                    i.*, 
                    t.descricao_tipo_imovel,
                    f.url_foto_imovel
                FROM 
                    tbl_imovel AS i
                INNER JOIN 
                    tbl_tipo_imovel AS t ON i.id_tipo_imovel = t.id_tipo_imovel
                LEFT JOIN 
                    tbl_foto_imovel AS f ON i.id_imovel = f.id_imovel
                WHERE 
                    i.id_imovel = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getImoveisPorProprietario($idProprietario)
    {
        $sql = "SELECT i.*, f.url_foto_imovel, t.id_tipo_imovel
                FROM tbl_imovel i
                INNER JOIN tbl_foto_imovel f ON f.id_imovel = i.id_imovel
                INNER JOIN tbl_tipo_imovel t ON t.id_tipo_imovel = i.id_tipo_imovel
                WHERE i.id_proprietario = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $idProprietario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function addImovel($dados)
    {
        $sql = "INSERT INTO tbl_imovel (
            nome_imovel, 
            tipo_anuncio_imovel, 
            endereco_imovel, 
            bairro_imovel, 
      
            complemento_imovel, 
            estado_imovel, 
            descricao_imovel, 
            preco_imovel, 
            cep_imovel,
            data_publicacao_imovel, 
            data_atualizacao_imovel,
            status_imovel,
            id_tipo_imovel
        ) VALUES (
            :nome_imovel, 
            :tipo_anuncio_imovel, 
            :endereco_imovel, 
            :bairro_imovel, 
            :complemento_imovel, 
            :estado_imovel, 
            :descricao_imovel, 
            :preco_imovel, 
            :cep_imovel,
            :data_publicacao_imovel, 
            :data_atualizacao_imovel,
            :status_imovel,
            :id_tipo_imovel

        )";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_imovel', $dados['nome_imovel']);
        $stmt->bindValue(':tipo_anuncio_imovel', $dados['tipo_anuncio_imovel']);
        $stmt->bindValue(':endereco_imovel', $dados['endereco_imovel']);
        $stmt->bindValue(':bairro_imovel', $dados['bairro_imovel']);
        $stmt->bindValue(':status_imovel', $dados['status_imovel']);
        $stmt->bindValue(':complemento_imovel', $dados['complemento_imovel']);
        $stmt->bindValue(':estado_imovel', $dados['estado_imovel']);
        $stmt->bindValue(':descricao_imovel', $dados['descricao_imovel']);
        $stmt->bindValue(':preco_imovel', $dados['preco_imovel']);
        $stmt->bindValue(':cep_imovel', $dados['cep_imovel']);

        $stmt->bindValue(':data_publicacao_imovel', $dados['data_publicacao_imovel']);
        $stmt->bindValue(':data_atualizacao_imovel', $dados['data_atualizacao_imovel']);
        $stmt->bindValue(':status_imovel', $dados['status_imovel']);
        $stmt->bindValue(':id_tipo_imovel', $dados['id_tipo_imovel']);

        $stmt->execute();
        return $this->db->lastInsertId();
    }
    public function addImovelProprietario($dados)
    {
        $sql = "INSERT INTO tbl_imovel (
            nome_imovel, 
            tipo_anuncio_imovel, 
            endereco_imovel, 
            bairro_imovel, 
      
            complemento_imovel, 
            estado_imovel, 
            descricao_imovel, 
            preco_imovel, 
            cep_imovel,
            data_publicacao_imovel, 
            data_atualizacao_imovel,
            id_tipo_imovel,
            id_proprietario
        ) VALUES (
            :nome_imovel, 
            :tipo_anuncio_imovel, 
            :endereco_imovel, 
            :bairro_imovel, 
            :complemento_imovel, 
            :estado_imovel, 
            :descricao_imovel, 
            :preco_imovel, 
            :cep_imovel,
            :data_publicacao_imovel, 
            :data_atualizacao_imovel,

            :id_tipo_imovel,
            :id_proprietario
        )";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_imovel', $dados['nome_imovel']);
        $stmt->bindValue(':tipo_anuncio_imovel', $dados['tipo_anuncio_imovel']);
        $stmt->bindValue(':endereco_imovel', $dados['endereco_imovel']);
        $stmt->bindValue(':bairro_imovel', $dados['bairro_imovel']);

        $stmt->bindValue(':complemento_imovel', $dados['complemento_imovel']);
        $stmt->bindValue(':estado_imovel', $dados['estado_imovel']);
        $stmt->bindValue(':descricao_imovel', $dados['descricao_imovel']);
        $stmt->bindValue(':preco_imovel', $dados['preco_imovel']);
        $stmt->bindValue(':cep_imovel', $dados['cep_imovel']);

        $stmt->bindValue(':data_publicacao_imovel', $dados['data_publicacao_imovel']);
        $stmt->bindValue(':data_atualizacao_imovel', $dados['data_atualizacao_imovel']);

        $stmt->bindValue(':id_tipo_imovel', $dados['id_tipo_imovel']);
        $stmt->bindValue(':id_proprietario', $dados['id_proprietario']);

        $stmt->execute();
        return $this->db->lastInsertId();
    }
    public function salvarFoto($id_imovel, $foto)
    {
        $sql = "INSERT INTO tbl_foto_imovel (id_imovel, url_foto_imovel) VALUES (:id, :foto)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id_imovel);
        $stmt->bindValue(':foto', $foto);
        $stmt->execute();
    }
    public function excluirImovel($id)
    {
        $sql = "DELETE FROM tbl_imovel WHERE id_imovel = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
    public function atualizarStatus($id, $status)
    {
        $sql = "UPDATE tbl_imovel SET  status_imovel = :status_imovel WHERE id_imovel = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status_imovel', $status);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
    public function incrementarVisualizacoes($id)
    {
        $sql = "UPDATE tbl_imovel SET visualizacoes = visualizacoes + 1 WHERE id_imovel = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
    }
}
