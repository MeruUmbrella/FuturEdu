<?php
class Login extends Model
{

    public function addCliente($dados)
    {
        $sql = "INSERT INTO tbl_cliente (
            nome_cliente, cpf_cliente, email_cliente, senha_cliente, data_criacao
        ) VALUES (
            :nome, :cpf, :email, :senha, :data_criacao
        )";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':cpf', $dados['cpf']);
        $stmt->bindValue(':email', $dados['email']);
        $stmt->bindValue(':senha', password_hash($dados['senha'], PASSWORD_DEFAULT));
        $stmt->bindValue(':data_criacao', date('Y-m-d H:i:s'));

        $stmt->execute();
        return $this->db->lastInsertId();
    }
    public function addProprietario($dados)
    {
        $sql = "INSERT INTO tbl_proprietario (
            nome_proprietario, cpf_proprietario, email_proprietario, senha_proprietario, data_criacao
        ) VALUES (
            :nome, :cpf, :email, :senha, :data_criacao
        )";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':cpf', $dados['cpf']);
        $stmt->bindValue(':email', $dados['email']);
        $stmt->bindValue(':senha', password_hash($dados['senha'], PASSWORD_DEFAULT));
        $stmt->bindValue(':data_criacao', date('Y-m-d H:i:s'));

        $stmt->execute();
        return $this->db->lastInsertId();
    }
}
