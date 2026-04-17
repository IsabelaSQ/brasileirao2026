<?php
require_once __DIR__ . '/../config/database.php';

class SelecaoModel {
    private $conexao;

    public function __construct() {
        $database = new database();
        $this->conexao = $database->conectar();
    }

    public function cadastrarSelecao($nome, $grupo, $titulos, $criado_em) {
        $sql = "INSERT INTO selecao (nome, grupo, titulos, criado_em) VALUES (:nome, :grupo, :titulos, :criado_em)";
        $stmt = $this->conexao->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':grupo' => $grupo,
            ':titulos' => $titulos,
            ':criado_em' => $criado_em
        ]);
    }

    public function listarSelecoes() {
        $sql = "SELECT * FROM selecao";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarSelecaoPorId($id) {
        $sql = "SELECT * FROM selecao WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarSelecao($id, $nome, $titulos){
        $sql = "UPDATE selecao SET nome = :nome, titulos = :titulos WHERE id = :id";
        $stmt = $this ->conexao->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':titulos' => $titulos,
            ':id' => $id
        ]);
        return true;
    }
    
    public function deletarSelecao($id){
        $sql = "DELETE FROM selecao WHERE id = :id ";
        $stmt = $this ->conexao->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>