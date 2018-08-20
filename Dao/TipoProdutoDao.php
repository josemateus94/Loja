<?php

require_once('Conexao.php'); 

class TipoProdutoDao{
    private $conexao;
	private $pdo;

	public function __construct(){
		$this->conexao = new Conexao();
		$this->pdo = $this->conexao->conectar();
    }
    
    public function lista(){
        
        try{
            $tipos = $this->pdo->prepare("SELECT * FROM tipoProduto");
            if ($tipos->execute()) {
                return $tipos->fetchAll();
            }else{
                return false;
            }
        }catch(Exception $exc) {
            echo "". ($exc->getMessage());
        }
        
    }
}

?>