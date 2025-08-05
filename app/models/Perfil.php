<?php

class Perfil extends Model
{
    public function getPerfils()
    {
        $sql = "SELECT * FROM tbl_cliente";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Busca perfil pelo ID do cliente
public function getPerfilById($id)
{
    $sql = "SELECT * FROM tbl_cliente WHERE id_cliente = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
    // Atualiza dados do perfil
    public function atualizarPerfil($id_cliente, $dados)
    {
        $sql = "UPDATE tbl_cliente SET 
                    nome_cliente = :nome_cliente,
                    email_cliente = :email_cliente,
                    foto_cliente = :foto_cliente
                WHERE id_cliente = :id_cliente";
        $stmt = $this->db->prepare($sql);
        $dados['id_cliente'] = $id_cliente;
        return $stmt->execute($dados);
    }
}
