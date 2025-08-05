<?php 


class Favorito extends Model
{
    public function adicionar($id_cliente, $id_imovel)
    {
        $sql = "INSERT INTO tbl_favoritos (id_cliente, id_imovel) VALUES (:id_cliente, :id_imovel)";
        $stmt = $this->conexao()->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->bindParam(':id_imovel', $id_imovel);
        return $stmt->execute();
    }

    public function remover($id_cliente, $id_imovel)
    {
        $sql = "DELETE FROM tbl_favoritos WHERE id_cliente = :id_cliente AND id_imovel = :id_imovel";
        $stmt = $this->conexao()->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->bindParam(':id_imovel', $id_imovel);
        return $stmt->execute();
    }
  public function listarFavoritosPorId($id_cliente)
{
    $sql = "SELECT im.*, fi.url_foto_imovel 
            FROM tbl_favoritos f
            INNER JOIN tbl_imovel im ON f.id_imovel = im.id_imovel
            INNER JOIN tbl_foto_imovel fi ON fi.id_imovel = im.id_imovel
            WHERE f.id_cliente = :id_cliente
            GROUP BY im.id_imovel"; // Garante que venha uma foto por imóvel

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id_cliente', $id_cliente, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function verificar($id_cliente, $id_imovel)
    {
        $sql = "SELECT * FROM tbl_favoritos WHERE id_cliente = :id_cliente AND id_imovel = :id_imovel";
        $stmt = $this->conexao()->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->bindParam(':id_imovel', $id_imovel);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarFavoritos($id_cliente)
    {
        $sql = "SELECT * FROM tbl_favoritos WHERE id_cliente = :id_cliente";
        $stmt = $this->conexao()->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        public function getFavoritos()
    {

        $sql = "SELECT * FROM tbl_favoritos";

        $stmt = $this->db->query($sql);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public function getFavoritosByCliente($id_cliente)
{
    $sql = "SELECT 
                c.nome_cliente, 
                i.nome_imovel, 
                f.data
            FROM 
                tbl_favoritos AS f
            INNER JOIN 
                tbl_imovel AS i ON f.id_imovel = i.id_imovel
            INNER JOIN 
                tbl_cliente AS c ON f.id_cliente = c.id_cliente
            WHERE 
                f.id_cliente = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$id_cliente]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
