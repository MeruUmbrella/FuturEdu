<?php
class Relatorio extends Model{

    public function getRelatorio()
    {

        $sql = "SELECT 
    r.*, 
    f.nome_funcionario 
FROM 
    tbl_relatorio r
INNER JOIN 
    tbl_funcionario f 
ON 
    r.id_funcionario = f.id_funcionario";

        $stmt = $this->db->query($sql);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public function getRelatorioById($id)
{
    $stmt = $this->db->prepare("SELECT * FROM tbl_relatorio WHERE id_relatorio = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function atualizarRelatorio($id, $tipo, $dados)
{
    $stmt = $this->db->prepare("UPDATE tbl_relatorio SET tipo_relatorio = ?, dados_relatorio = ? WHERE id_relatorio = ?");
    $stmt->execute([$tipo, $dados, $id]);
}

public function inserirRelatorio($tipo, $dadosRel, $idFuncionario)
{
    $stmt = $this->db->prepare("INSERT INTO tbl_relatorio (tipo_relatorio, dados_relatorio, id_funcionario, data_geracao_relatorio) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$tipo, $dadosRel, $idFuncionario]);
}

public function listarTodos()
{
    $stmt = $this->db->query("SELECT id_funcionario, nome_funcionario FROM tbl_funcionario ORDER BY nome_funcionario");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function desativarRelatorio($id)
{

    $sql = "UPDATE tbl_relatorio SET status_relatorio = :status_relatorio WHERE id_relatorio = :id";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':status_relatorio', 'Desativado');
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
}











}