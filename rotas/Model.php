

<?php
class Model {
    protected $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);

        } catch (PDOException $e) {

                echo "Erro na conexão com o banco de dados: " . $e->getMessage();

        }
    }
     protected function conexao() {
        return $this->db;
    }
}