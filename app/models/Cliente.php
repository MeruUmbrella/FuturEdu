<?php

class Cliente extends Model
{

    public function getClientes()
    {

        $sql = "SELECT * FROM tbl_cliente 
        WHERE status_cliente != 'Desativar' ORDER BY nome_cliente ASC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public function patchAtualizarCliente($id, $nome, $email, $senha, $cpf, $cep, $endereco, $bairro, $estado, $foto, $alt, $status, $dataCriacao)
    {
        $sql = "UPDATE tbl_cliente
            SET nome_cliente = :nome,
                email_cliente = :email,
                senha_cliente = :senha,
                cpf_cliente = :cpf,
                cep_cliente = :cep,
                endereco_cliente = :endereco,
                bairro_cliente = :bairro,
                estado_cliente = :estado,
                foto_cliente = :foto,
                alt_cliente = :alt,
                status_cliente = :status,
                data_criacao = :dataCriacao
            WHERE id_cliente = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha); // Ideal: use password_hash antes de passar
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':cep', $cep);
        $stmt->bindValue(':endereco', $endereco);
        $stmt->bindValue(':bairro', $bairro);
        $stmt->bindValue(':estado', $estado);
        $stmt->bindValue(':foto', $foto);
        $stmt->bindValue(':alt', $alt);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':dataCriacao', $dataCriacao);

        return $stmt->execute();
    }

    public function inserirCliente($nome, $email, $senha, $cpf, $cep, $endereco, $bairro, $estado, $foto, $alt, $status, $dataCriacao)
    {
        $sql = "INSERT INTO tbl_cliente (
                nome_cliente, email_cliente, senha_cliente, cpf_cliente,
                cep_cliente, endereco_cliente, bairro_cliente, estado_cliente,
                foto_cliente, alt_cliente, status_cliente, data_criacao
            ) VALUES (
                :nome, :email, :senha, :cpf,
                :cep, :endereco, :bairro, :estado,
                :foto, :alt, :status, :dataCriacao
            )";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':cep', $cep);
        $stmt->bindValue(':endereco', $endereco);
        $stmt->bindValue(':bairro', $bairro);
        $stmt->bindValue(':estado', $estado);
        $stmt->bindValue(':foto', $foto);
        $stmt->bindValue(':alt', $alt);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':dataCriacao', $dataCriacao);

        return $stmt->execute();
    }

    public function desativarCliente($id)
    {

        $sql = "UPDATE tbl_cliente SET status_cliente = :status_cliente WHERE id_cliente = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status_cliente', 'Desativar');
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function carregarDados($id)
    {
        $sql = "SELECT * FROM tbl_cliente WHERE id_cliente = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editarCliente($dados)
    {
        $sql = "UPDATE tbl_cliente SET
            nome_cliente      = :nome_cliente,
            email_cliente     = :email_cliente,
            senha_cliente     = :senha_cliente,
            cpf_cliente       = :cpf_cliente,
            cep_cliente       = :cep_cliente,
            endereco_cliente  = :endereco_cliente,
            bairro_cliente    = :bairro_cliente,
            estado_cliente    = :estado_cliente,
            foto_cliente      = :foto_cliente,
            alt_cliente       = :alt_cliente,
            status_cliente    = :status_cliente,
            data_criacao      = :data_criacao
        WHERE id_cliente      = :id_cliente";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_cliente', $dados['nome_cliente']);
        $stmt->bindValue(':email_cliente', $dados['email_cliente']);
        $stmt->bindValue(':senha_cliente', $dados['senha_cliente']);
        $stmt->bindValue(':cpf_cliente', $dados['cpf_cliente']);
        $stmt->bindValue(':cep_cliente', $dados['cep_cliente']);
        $stmt->bindValue(':endereco_cliente', $dados['endereco_cliente']);
        $stmt->bindValue(':bairro_cliente', $dados['bairro_cliente']);
        $stmt->bindValue(':estado_cliente', $dados['estado_cliente']);
        $stmt->bindValue(':foto_cliente', $dados['foto_cliente']);
        $stmt->bindValue(':alt_cliente', $dados['alt_cliente']);
        $stmt->bindValue(':status_cliente', $dados['status_cliente']);
        $stmt->bindValue(':data_criacao', $dados['data_criacao']);
        $stmt->bindValue(':id_cliente', $dados['id_cliente']);

        return $stmt->execute();
    }

    public function atualizarFoto($id, $foto)
    {

        $sql  = "UPDATE tbl_cliente SET foto_cliente = :foto WHERE id_cliente = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':foto', $foto);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function addCliente($dados)
    {

        $sql = "INSERT INTO tbl_cliente(
            nome_cliente, 
            email_cliente, 
            senha_cliente, 
            cpf_cliente, 
            cep_cliente, 
            endereco_cliente, 
            bairro_cliente, 
            estado_cliente, 
            foto_cliente, 
            alt_cliente, 
            data_criacao, 
            data_atualizacao, 
            status_cliente
        ) VALUES(
            :nome_cliente, 
            :email_cliente, 
            :senha_cliente, 
            :cpf_cliente, 
            :cep_cliente, 
            :endereco_cliente, 
            :bairro_cliente, 
            :estado_cliente, 
            :foto_cliente, 
            :alt_cliente, 
            :data_criacao, 
            :data_atualizacao, 
            :status_cliente
        )";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome_cliente', $dados['nome_cliente']);
        $stmt->bindValue(':email_cliente', $dados['email_cliente']);
        $stmt->bindValue(':senha_cliente', $dados['senha_cliente']);
        $stmt->bindValue(':cpf_cliente', $dados['cpf_cliente']);
        $stmt->bindValue(':cep_cliente', $dados['cep_cliente']);
        $stmt->bindValue(':endereco_cliente', $dados['endereco_cliente']);
        $stmt->bindValue(':bairro_cliente', $dados['bairro_cliente']);
        $stmt->bindValue(':estado_cliente', $dados['estado_cliente']);
        $stmt->bindValue(':foto_cliente', $dados['foto_cliente']);
        $stmt->bindValue(':alt_cliente', $dados['alt_cliente']);
        $stmt->bindValue(':data_criacao', $dados['data_criacao']);
        $stmt->bindValue(':data_atualizacao', $dados['data_atualizacao']);
        $stmt->bindValue(':status_cliente', $dados['status_cliente']);

        $stmt->execute();

        return $this->db->lastInsertId();
    }


    public function postLoginCliente($email, $senha)
    {

        $sql = "SELECT * FROM tbl_cliente WHERE email_cliente = :email_cliente 
        AND senha_cliente = :senha_cliente AND status_cliente = 'ATIVO' ORDER BY id_cliente DESC LIMIT 1"; //caso tenha dois emails cadastrados, serve para travar e pegar o primeiro login 
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email_cliente', $email);
        $stmt->bindParam(':senha_cliente', $senha);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarStatus($id, $status)
    {
        $sql = "UPDATE tbl_cliente SET status_cliente = :status_cliente WHERE id_cliente = :id_cliente";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status_cliente', $status);
        $stmt->bindValue(':id_cliente', $id);
        return $stmt->execute();
    }   
    public function getClienteById($id)
    {
        $sql = "SELECT * FROM tbl_cliente WHERE id_cliente = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
