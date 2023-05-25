<?php

class BD {
    private $host = "localhost";
    private $dbname = "db_atividade";
    private $port = 3306;
    private $usuario = "root";
    private $senha = "";
    private $db_charset = "utf8";


    public function conn(){
        $conn = "mysql:host=$this->host;dbname=$this->dbname;port=$this->port";

        return new PDO(
            $conn,
            $this->usuario,
            $this->senha,
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ". $this->db_charset]
        );
    }

    public function inserir($dados){
        $conn = $this->conn();
        $sql = "INSERT INTO atividade (nome, hora, dia, descricao) VALUES (?, ?, ?, ?);";
        $st = $conn->prepare($sql);
        $st->execute([$dados['nome'], $dados['hora'],$dados['dia'],$dados['descricao']]);
    }

    public function select(){
        $conn = $this->conn();
        $sql = "SELECT * FROM atividade;";
        $st = $conn->prepare($sql);
        $st->execute();

        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function deletar($id) {
        $conn = $this->conn();
        $sql = "DELETE FROM atividade WHERE id=?";
        $st = $conn->prepare($sql);
        $st->execute([$id]);
    }

    public function buscar($id){
        $conn = $this->conn();
        $sql = "SELECT * FROM atividade WHERE id=?";
        $st = $conn->prepare($sql);
        $st->execute([$id]);

        return $st->fetchObject();
    }

    public function atualizar($dados){
        $id = $dados["id"];
        $conn = $this->conn();
        $sql = "UPDATE atividade SET nome=?, hora=?, dia=?, descricao=? WHERE id=$id";
        $st = $conn->prepare($sql);
        $st->execute([$dados['nome'], $dados['hora'],$dados['dia'],$dados['descricao']]);
    }
}