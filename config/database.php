<?php
class Database{
    private $host = 'localhost';
    private $dbname = 'brasileirao2026';
    private $username = 'root';
    private $password = 'alunolab';
    public $conexao;

    public function conectar(){
        $this->conexao = null;
        try{
        $this->conexao = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
        $this->conexao->exec("set names utf8");
        } catch(PDOException $exception){
        echo "Erro de conexão: " . $exception->getMessage();
        }
        return $this->conexao;
    }
}
?>