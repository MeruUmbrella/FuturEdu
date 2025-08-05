<?php

class Filtro extends Model
{
    public function getFiltrarImovel($tipo)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE tipo_anuncio_imovel LIKE :tipo_anuncio_imovel";
    
        $stmt = $this->db->prepare($sql);
    
        $tipo = '%' . $tipo . '%';
        $stmt->bindParam(':tipo_anuncio_imovel', $tipo, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAcademia($academia)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE academia_imovel LIKE :academia";
    
        $stmt = $this->db->prepare($sql);
    
        $academia = '%' . $academia . '%';
        $stmt->bindParam(':academia', $academia, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBanheiroImovel($banheiro)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel WHERE banheiro_imovel = :banheiros";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':banheiros', $banheiro, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function gerAreaImovel($area)
    {
        preg_match('/\d+/', $area, $match);
        $areaLimpa = isset($match[0]) ? (int) $match[0] : 0;

        if ($areaLimpa < 25 || $areaLimpa > 125) {
            return [];
        }

        $sql = "SELECT * FROM tbl_caracteristicas_imovel 
                WHERE metro_imovel BETWEEN =>25 AND 125<= 
                AND metro_imovel >= :metro";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':metro' => $areaLimpa]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getImovelPorAreaExata($areaExp)
    {
        preg_match('/\d+/', $areaExp, $match);
        $areaLimpa = isset($match[0]) ? (int)$match[0] : 0;

        if ($areaLimpa < 25 || $areaLimpa > 125) {
            return [];
        }

        $sql = "SELECT * FROM tbl_caracteristicas_imovel WHERE metro_imovel = :metro LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':metro' => $areaLimpa]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getBicicletario($resultado)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE bicicletario_imovel LIKE :bicicletario";
    
        $stmt = $this->db->prepare($sql);
    
        $resultado = '%' . $resultado . '%';
        $stmt->bindParam(':bicicletario', $resultado, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBrinquedoteca($resultado)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE brinquedoteca_imovel LIKE :brinquedoteca";
    
        $stmt = $this->db->prepare($sql);
    
        $resultado = '%' . $resultado . '%';
        $stmt->bindParam(':brinquedoteca', $resultado, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChurrasqueira($resultado)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE churrasqueira_imovel LIKE :churrasqueira";
    
        $stmt = $this->db->prepare($sql);
    
        $resultado = '%' . $resultado . '%';
        $stmt->bindParam(':churrasqueira', $resultado, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getCondominioFechado($valor)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel WHERE condominio_fechado like :valor";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':valor' => $valor]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCoworking($resultado)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE coworking_imovel LIKE :coworking";
    
        $stmt = $this->db->prepare($sql);
    
        $resultado = '%' . $resultado . '%';
        $stmt->bindParam(':coworking', $resultado, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getElevador($resultado)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE elevador_imovel LIKE :elevador";
    
        $stmt = $this->db->prepare($sql);
    
        $resultado = '%' . $resultado . '%';
        $stmt->bindParam(':elevador', $resultado, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPossuiEscritura($valor)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel WHERE possui_escritura = :valor";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':valor' => $valor]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGourmet($resultado)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE espaco_gourmet_imovel LIKE :goumet";
    
        $stmt = $this->db->prepare($sql);
    
        $resultado = '%' . $resultado . '%';
        $stmt->bindParam(':goumet', $resultado, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAceitaFinanciamento($valor)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel WHERE aceita_financiamento LIKE :valor";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':valor' => "%$valor%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVagasGararemImovel($vagas)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel WHERE vagas_garagem_imovel = :vagas";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':vagas', $vagas, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getGeradorEnergia($resultado)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE gerador_energia_imovel LIKE :gerador";
    
        $stmt = $this->db->prepare($sql);
    
        $resultado = '%' . $resultado . '%';
        $stmt->bindParam(':gerador', $resultado, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getImovelMobiliado($valor)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel WHERE imovel_mobiliado = :valor";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':valor' => $valor]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLavanderia($resultado)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE lavanderia_compartilhada_imovel LIKE :lavanderia";
    
        $stmt = $this->db->prepare($sql);
    
        $resultado = '%' . $resultado . '%';
        $stmt->bindParam(':lavanderia', $resultado, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getBairroImovel($bairro)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
        WHERE bairro_imovel LIKE :bairro_imovel";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([':bairro_imovel' => "%$bairro%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEnderecoImovel($endereco)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
        WHERE endereco_imovel LIKE :endereco_imovel;";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([':endereco_imovel' => "%$endereco%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEstadoImovel($estado)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
        WHERE estado_imovel LIKE :estado_imovel;";

        $stmt = $this->db->prepare($sql);

        var_dump('Ta passando Aqui'); 

        $stmt->execute([':estado_imovel' => "%$estado%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPetPlace($resultado)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE pet_place_imovel LIKE :pet_place";
    
        $stmt = $this->db->prepare($sql);
    
        $resultado = '%' . $resultado . '%';
        $stmt->bindParam(':pet_place', $resultado, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAceitaPets($valor)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel WHERE aceita_pets = :valor";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':valor' => $valor]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getPiscina($piscina)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel WHERE piscina_imovel LIKE :piscina";
        $stmt = $this->db->prepare($sql);

        $piscina = '%' . $piscina . '%';
        $stmt->bindParam(':piscina', $piscina, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPlayground($resultado)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE playground_imovel LIKE :playground";
    
        $stmt = $this->db->prepare($sql);
    
        $resultado = '%' . $resultado . '%';
        $stmt->bindParam(':playground', $resultado, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPortaria24($resultado)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE portaria_24h_imovel LIKE :portaria24";
    
        $stmt = $this->db->prepare($sql);
    
        $resultado = '%' . $resultado . '%';
        $stmt->bindParam(':portaria24', $resultado, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQuadraEsporte($resultado)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE quadra_esportes_imovel LIKE :quadra";
    
        $stmt = $this->db->prepare($sql);
    
        $resultado = '%' . $resultado . '%';
        $stmt->bindParam(':quadra', $resultado, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getImovelPorQuarto($quarto) {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel WHERE quarto_imovel = :quartos";
    
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':quartos', $quarto, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSalaoFesta($salao)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE salao_festas_imovel LIKE :salao";
    
        $stmt = $this->db->prepare($sql);
    
        $salao = '%' . $salao . '%';
        $stmt->bindParam(':salao', $salao, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSeguranca($resultado)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE seguranca_imovel LIKE :seguranca";
    
        $stmt = $this->db->prepare($sql);
    
        $resultado = '%' . $resultado . '%';
        $stmt->bindParam(':seguranca', $resultado, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSuitesPorQuarto($suite)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel WHERE suite_imovel = :suites";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':suites', $suite, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTipoImovel($valor)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel WHERE tipo_imovel = :valor";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':valor' => $valor]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVisitantes($resultado)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE vaga_visitante_imovel LIKE :vaga";
    
        $stmt = $this->db->prepare($sql);
    
        $resultado = '%' . $resultado . '%';
        $stmt->bindParam(':vaga', $resultado, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getValorImovel($valor)
    {
        if ($valor < 10000 || $valor > 900000) {
            return [];
        }

        $sql = "SELECT * FROM tbl_caracteristicas_imovel 
                WHERE preco_imovel BETWEEN 10000 AND 900000 
                AND preco_imovel >= :valor";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':valor' => $valor]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWifiComum($resultado)
    {
        $sql = "SELECT * FROM tbl_caracteristicas_imovel
                WHERE wifi_comum_imovel LIKE :wifi";
    
        $stmt = $this->db->prepare($sql);
    
        $resultado = '%' . $resultado . '%';
        $stmt->bindParam(':wifi', $resultado, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}

