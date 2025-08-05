<?php

class Proprietario extends Model
{
    public function buscarProp($email, $senha)
    {
        $sql = "SELECT * FROM tbl_proprietario 
        WHERE email_proprietario = :email 
        AND senha_proprietario = :senha 
        AND status_proprietario = 'ATIVO'";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProprietario(){

        $sql = "SELECT * FROM tbl_proprietario 
        WHERE status_proprietario != 'Desativar' ORDER BY nome_proprietario ASC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);

    }
    public function getById($id)
{
    $stmt = $this->db->prepare("SELECT * FROM tbl_proprietario WHERE id_proprietario = :id");
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function atualizarProprietario($id, $dados)
{
    $sql = "UPDATE tbl_proprietario SET 
                cep_proprietario = :cep,
                endereco_proprietario = :endereco,
                complemento_proprietario = :complemento,
                bairro_proprietario = :bairro,
                estado_proprietario = :estado,
                foto_proprietario = :foto,
                alt_proprietario = :alt,
                doc_identidade_proprietario = :doc_identidade,
                nome_proprietario = :nome,
                senha_proprietario = :senha,
                email_proprietario = :email,
                cpf_proprietario = :cpf,
                status_proprietario = :status,
                data_atualizacao = NOW()
            WHERE id_proprietario = :id";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':cep', $dados['cep_proprietario']);
    $stmt->bindValue(':endereco', $dados['endereco_proprietario']);
    $stmt->bindValue(':complemento', $dados['complemento_proprietario']);
    $stmt->bindValue(':bairro', $dados['bairro_proprietario']);
    $stmt->bindValue(':estado', $dados['estado_proprietario']);
    $stmt->bindValue(':foto', $dados['foto_proprietario']);
    $stmt->bindValue(':alt', $dados['alt_proprietario'] ?? '');
    $stmt->bindValue(':doc_identidade', $dados['doc_identidade_proprietario']);
    $stmt->bindValue(':nome', $dados['nome_proprietario']);
    $stmt->bindValue(':senha', $dados['senha_proprietario']);
    $stmt->bindValue(':email', $dados['email_proprietario']);
    $stmt->bindValue(':cpf', $dados['cpf_proprietario']);
    $stmt->bindValue(':status', $dados['status_proprietario']);

    return $stmt->execute();
}



public function atualizarStatus($id, $status)
{
    $sql = "UPDATE tbl_proprietario SET status_proprietario = :status, data_atualizacao = NOW() WHERE id_proprietario = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':status', $status);
    $stmt->bindValue(':id', $id);

    return $stmt->execute();
}
public function excluir($id)
{
    $stmt = $this->db->prepare("DELETE FROM tbl_proprietario WHERE id_proprietario = :id");
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
}

public function inserirProprietario($dados)
{
    $sql = "INSERT INTO tbl_proprietario 
        (nome_proprietario, email_proprietario, senha_proprietario, cep_proprietario, endereco_proprietario, complemento_proprietario, bairro_proprietario, estado_proprietario, doc_identidade_proprietario, cpf_proprietario, foto_proprietario, alt_proprietario, status_proprietario)
        VALUES (:nome, :email, :senha, :cep, :endereco, :complemento, :bairro, :estado, :doc, :cpf, :foto, :alt, :status)";

    $stmt = $this->db->prepare($sql);

    $stmt->bindValue(':nome', $dados['nome_proprietario']);
    $stmt->bindValue(':email', $dados['email_proprietario']);
    $stmt->bindValue(':senha', password_hash($dados['senha_proprietario'], PASSWORD_DEFAULT));
    $stmt->bindValue(':cep', $dados['cep_proprietario']);
    $stmt->bindValue(':endereco', $dados['endereco_proprietario']);
    $stmt->bindValue(':complemento', $dados['complemento_proprietario']);
    $stmt->bindValue(':bairro', $dados['bairro_proprietario']);
    $stmt->bindValue(':estado', $dados['estado_proprietario']);
    $stmt->bindValue(':doc', $dados['doc_identidade_proprietario']);
    $stmt->bindValue(':cpf', $dados['cpf_proprietario']);
    $stmt->bindValue(':foto', $dados['foto_proprietario'] ?? null);
    $stmt->bindValue(':alt', $dados['alt_proprietario'] ?? '');
    $stmt->bindValue(':status', $dados['status_proprietario'] ?? 'Ativo');

    return $stmt->execute();
}


}
