<?php 

require_once('Conexao.php'); 

class BancoCategoria{
	private $conexao;
	private $pdo;

	public function __construct(){
		$this->conexao = new Conexao();
		$this->pdo = $this->conexao->conectar();
	}

	function listaCategoria(){
        try {
            $categorias = $this->pdo->prepare("SELECT * FROM categorias");
            if ($categorias->execute()) {
                return $categorias->fetchAll();
            }else{
                return false;
            }
        } catch (Exception $exc) {
            echo "". ($exc->getMessage());
        }
    }
}

 ?>