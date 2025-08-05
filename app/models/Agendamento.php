<?php

class Agendamento extends Model
{


    public function listarComRelacionamentos()
    {
        $sql = "SELECT 
            a.id_agendamento,
            a.data_visita,
            a.status_agendamento,
            c.id_cliente,
            c.nome_cliente,
            c.email_cliente,
            c.senha_cliente,
            c.cep_cliente,
            c.foto_cliente,
            i.id_imovel,
            i.nome_imovel
        FROM tbl_agendamento a
        JOIN tbl_cliente c ON a.id_cliente = c.id_cliente
        JOIN tbl_imovel i ON a.id_imovel = i.id_imovel
        WHERE a.status_agendamento != 'Cancelado'
        ORDER BY c.nome_cliente ASC";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Desativa um agendamento (altere conforme sua regra de negócio)
     */
    public function desativar($id)
    {
        $sql = "UPDATE agendamento SET status_agendamento != 'Cancelado' WHERE id_agendamento = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getAgendamentos()
    {
        $sql = "SELECT 
            a.id_agendamento,
            a.id_cliente,
            a.id_imovel,
            a.id_proprietario,
            a.data_visita,
            a.status_agendamento,   
            c.nome_cliente,
            i.nome_imovel,
            i.preco_imovel,
            p.nome_proprietario
        FROM tbl_agendamento a
        JOIN tbl_cliente c ON a.id_cliente = c.id_cliente
        JOIN tbl_imovel i ON a.id_imovel = i.id_imovel
        JOIN tbl_proprietario p ON i.id_proprietario = p.id_proprietario
        WHERE a.status_agendamento != 'Cancelado'";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function atualizarStatus($id, $status)
    {
        $sql = "UPDATE tbl_agendamento SET status_agendamento = :status_agendamento WHERE id_agendamento = :id_agendamento";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status_agendamento', $status);
        $stmt->bindValue(':id_agendamento', $id);
        return $stmt->execute();
    }

    public function editarAgendamento($carregarDadosAgendamento)
    {
        $sql = "UPDATE tbl_agendamento SET
        id_cliente         = :id_cliente,
        id_imovel          = :id_imovel,
        id_proprietario    = :id_proprietario,
        data_visita        = :data_visita,
        status_agendamento = :status_agendamento
    WHERE id_agendamento   = :id_agendamento";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':id_cliente', $carregarDadosAgendamento['id_cliente'], PDO::PARAM_INT);
        $stmt->bindValue(':id_imovel', $carregarDadosAgendamento['id_imovel'], PDO::PARAM_INT);
        $stmt->bindValue(':id_proprietario', $carregarDadosAgendamento['id_proprietario'], PDO::PARAM_INT);
        $stmt->bindValue(':data_visita', $carregarDadosAgendamento['data_visita']);
        $stmt->bindValue(':status_agendamento', $carregarDadosAgendamento['status_agendamento']);
        $stmt->bindValue(':id_agendamento', $carregarDadosAgendamento['id_agendamento'], PDO::PARAM_INT);


        return $stmt->execute();
    }

    public function carregarDados($id)
    {
        $sql = "SELECT 
    a.*, 
    c.nome_cliente, 
    i.nome_imovel,
    p.nome_proprietario
    FROM tbl_agendamento a
    JOIN tbl_cliente c ON a.id_cliente = c.id_cliente
    JOIN tbl_imovel i ON a.id_imovel = i.id_imovel
    JOIN tbl_proprietario p ON i.id_proprietario = p.id_proprietario
    WHERE a.status_agendamento != 'cancelado' AND a.id_agendamento = :id
    ORDER BY c.nome_cliente ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Exemplo para o ImovelModel
    public function atualizarNomeImovel($id_imovel, $nome_imovel)
    {
        $sql = "UPDATE tbl_imovel SET nome_imovel = :nome_imovel WHERE id_imovel = :id_imovel";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_imovel', $nome_imovel);
        $stmt->bindValue(':id_imovel', $id_imovel, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function atualizarNomeProprietario($id_proprietario, $nome_proprietario)
    {
        $sql = "UPDATE tbl_proprietario SET nome_proprietario = :nome_proprietario WHERE id_proprietario = :id_proprietario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_proprietario', $nome_proprietario);
        $stmt->bindValue(':id_proprietario', $id_proprietario, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function listar()
    {
        $sql = "SELECT m.*, c.nome_cliente, p.nome_proprietario, i.nome_imovel
                FROM tbl_agendamento m
                INNER JOIN tbl_cliente c ON m.id_cliente = c.id_cliente
                INNER JOIN tbl_proprietario p ON m.id_proprietario = p.id_proprietario
                INNER JOIN tbl_imovel i ON m.id_imovel = i.id_imovel
                ORDER BY m.data_visita DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tbl_agendamento WHERE id_agendamento = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarClientes()
    {
        return $this->db->query("SELECT id_cliente, nome_cliente FROM tbl_cliente")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarProprietarios()
    {
        return $this->db->query("SELECT id_proprietario, nome_proprietario FROM tbl_proprietario")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarImoveis()
    {
        return $this->db->query("SELECT id_imovel, nome_imovel FROM tbl_imovel")->fetchAll(PDO::FETCH_ASSOC);
    }



    public function inserir($dados)
    {
        $sql = "INSERT INTO tbl_agendamento 
        (id_cliente, id_imovel, id_proprietario, data_visita, status_agendamento)
            VALUES (:id_cliente, :id_imovel, :id_proprietario, :data_visita, :status_agendamento)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':id_cliente', $dados['id_cliente'], PDO::PARAM_INT);
        $stmt->bindValue(':id_imovel', $dados['id_imovel'], PDO::PARAM_INT);
        $stmt->bindValue(':id_proprietario', $dados['id_proprietario'], PDO::PARAM_INT);
        $stmt->bindValue(':data_visita', $dados['data_visita']);
        $stmt->bindValue(':status_agendamento', $dados['status_agendamento']);
        $stmt->execute();

        return $this->db->lastInsertId();
    }


    public function atualizar($dados)
    {
        $sql = "UPDATE tbl_agendamento SET
                    id_cliente         = :id_cliente,
                    id_proprietario    = :id_proprietario,
                    id_imovel          = :id_imovel,
                    data_visita        = :data_visita,
                    status_agendamento = :status_agendamento
                WHERE id_agendamento   = :id_agendamento";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente',         $dados['id_cliente']);
        $stmt->bindValue(':id_proprietario',    $dados['id_proprietario']);
        $stmt->bindValue(':id_imovel',          $dados['id_imovel']);
        $stmt->bindValue(':data_visita',        $dados['data_visita']);
        $stmt->bindValue(':status_agendamento', $dados['status_agendamento']);
        $stmt->bindValue(':id_agendamento',     $dados['id_agendamento']);

        return $stmt->execute();
    }


    public function excluir($id)
    {
        $stmt = $this->db->prepare("DELETE FROM tbl_agendamento WHERE id_agendamento = ?");
        $stmt->execute([$id]);
    }
}
