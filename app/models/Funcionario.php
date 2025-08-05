<?php

class Funcionario extends Model
{
    public function getFuncionarioById($id)
    {
        $sql = "SELECT * FROM tbl_funcionario WHERE id_funcionario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function postLoginFuncionario($email, $senha)
    {
        $sql = "SELECT * FROM tbl_funcionario WHERE email_funcionario = :email AND senha_funcionario = :senha";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha); // Ideal usar hash para senha!
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

