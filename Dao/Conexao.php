<?php

class Conexao {

    private $usuario;
    private $senha;
    private $banco;
    private $servidor;
    private $dsn;
    private static $pdo;
    private $ch;

    function __construct() {
        $this->usuario = "root";
        $this->ch = "utf8";
        $this->senha = "";
        $this->banco = "loja";
        $this->servidor = "localhost";
        $this->dsn = "mysql:host=" . $this->servidor . ";dbname=" . $this->banco.";charset=".$this->ch;
    }

    public function conectar() {
        try {
            if (is_null(self::$pdo)) {
                self::$pdo = new PDO($this->dsn, $this->usuario, $this->senha);
            }
            return self::$pdo;
        } catch (PDOException $exc) {
            echo "Erro" . ($exc->getMessage());
        }
    }
}

?>
