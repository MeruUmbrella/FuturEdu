<?php
class Mensagem extends Model {
    public function listar() {
        $sql = "SELECT m.*, c.nome_cliente, p.nome_proprietario, i.nome_imovel
                FROM tbl_mensagem m
                INNER JOIN tbl_cliente c ON m.id_cliente = c.id_cliente
                INNER JOIN tbl_proprietario p ON m.id_proprietario = p.id_proprietario
                INNER JOIN tbl_imovel i ON m.id_imovel = i.id_imovel
                ORDER BY m.data_envio DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM tbl_mensagem WHERE id_mensagem = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserir($dados) {
        $stmt = $this->db->prepare("INSERT INTO tbl_mensagem (id_cliente, id_proprietario, id_imovel, mensagem, data_envio)
            VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([
            $dados['id_cliente'],
            $dados['id_proprietario'],
            $dados['id_imovel'],
            $dados['mensagem']
        ]);
    }

    public function atualizar($dados) {
        $stmt = $this->db->prepare("UPDATE tbl_mensagem SET id_cliente = ?, id_proprietario = ?, id_imovel = ?, mensagem = ?
            WHERE id_mensagem = ?");
        $stmt->execute([
            $dados['id_cliente'],
            $dados['id_proprietario'],
            $dados['id_imovel'],
            $dados['mensagem'],
            $dados['id_mensagem']
        ]);
    }

    public function excluir($id) {
        $stmt = $this->db->prepare("DELETE FROM tbl_mensagem WHERE id_mensagem = ?");
        $stmt->execute([$id]);
    }

    public function listarClientes() {
        return $this->db->query("SELECT id_cliente, nome_cliente FROM tbl_cliente")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarProprietarios() {
        return $this->db->query("SELECT id_proprietario, nome_proprietario FROM tbl_proprietario")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarImoveis() {
        return $this->db->query("SELECT id_imovel, nome_imovel FROM tbl_imovel")->fetchAll(PDO::FETCH_ASSOC);
    }



}