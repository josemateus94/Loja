<?php 
require_once("Conexao.php");

class BancoUsuario{
	private $conexao;
	private $pdo;
	public function __construct(){
		$this->conexao = new Conexao();
		$this->pdo = $this->conexao->conectar();
	}

	function buscaUsuario($email, $senha){
		try {
			$senha = md5($senha);
			$usuario = $this->pdo->prepare("SELECT * FROM usuarios where email = :email and senha = :senha");
			$usuario->bindParam(":email", $email, PDO::PARAM_STR);
			$usuario->bindParam(":senha",$senha, PDO::PARAM_STR);

			if ($usuario->execute()) {
				return $usuario->fetch();
			}
		} catch (Exception $e) {
			return "".($e->getMessage());
		}
	}

	function editarUsuario($id, $email, $senha){
		try {

			$usuario = $this->pdo->prepare();
			$usuario->bindParam(":email", $email, POD::PARAM_STR);
			$usuario->bindParam(":senha", $senha, PDO::PARAM_STR);			
			if ($usuario->execute()) {
				return "true";
			}else{
				return "false";
			}
		} catch (Exception $e) {
			return "".($e->getMessage());
		}
	}
}

?>