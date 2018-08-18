<?php

require_once('Conexao.php');
require_once('../Model/Produto.php');
require_once('../Model/Categoria.php');

class ProdutoDao{

    private $conexao;
    private $pdo;

    public function __construct(){
        $this->conexao = new Conexao();
        $this->pdo = $this->conexao->conectar();
    }

    function listaProdutos($id=""){        

        if (!empty ($id)) {
            $comparacao = "where lp.id = $id";
        }else{
            $comparacao = "";
        }
        try {
            $lista = $this->pdo->prepare("SELECT lp.*, lc.nome as categoria_nome 
                                        FROM loja.produtos as lp join loja.categorias as lc on lc.id =
                                        lp.categoria_id $comparacao;");
            $lista->execute();            
            if (!empty ($id)) {
                $listaproduto = $lista->fetch();

                $nome = $listaproduto['nome'];
                $preco = $listaproduto['preco'];
                $descricao = $listaproduto['descricao'];
                $usado = $listaproduto['usado'];
                
                $categoria = new Categoria();
                $categoria->setId($listaproduto['categoria_id']);
                $produto = new Produto($nome, $preco, $descricao, $categoria, $usado);
                $produto->setId($listaproduto['id']);

                return $produto; 
            }else{
                $produtos = array();
                $listaprodutos = $lista->fetchAll();               
                foreach($listaprodutos as $listaproduto){ 
                    $nome = $listaproduto['nome'];                     
                    $preco = $listaproduto['preco'];
                    $descricao = $listaproduto['descricao'];
                    $usado = $listaproduto['usado'];
                    
                    $categoria = new Categoria();
                    $categoria->setNome($listaproduto['categoria_nome']);
                    $produto = new Produto($nome, $preco, $descricao, $categoria, $usado);
                    $produto->setId($listaproduto['id']);
                    array_push($produtos, $produto);
                }
                return $produtos;
            }

        } catch (Exception $e) {
            echo ($e->getMessage());
        }
    }

    function insereProduto(Produto $produto){
        try {
            $pdt = $this->pdo->prepare("INSERT INTO produtos (nome,preco,descricao,categoria_id, usado)
                                        VALUES (:nome,:preco,:descricao,:categoria_id,:usado)");
            $pdt->bindParam(":nome", $produto->getNome(), PDO::PARAM_STR);
            $pdt->bindParam(":preco",  $produto->getPreco(), PDO::PARAM_STR);
            $pdt->bindParam(":descricao",  $produto->getDescricao(), PDO::PARAM_STR);
            $pdt->bindParam(":categoria_id",  $produto->getCategoria()->getId(), PDO::PARAM_STR);
            $pdt->bindParam(":usado",  $produto->getUsado(), PDO::PARAM_BOOL);

            if($pdt->execute()){
                return true;    
            } else{
                return false;
            }       

        } catch (PDOException $exc) {
            echo "" . ($exc->getMessage());
        }     
    }
    function removeProduto($id){
        try {
            $produto = $this->pdo->prepare("DELETE FROM produtos WHERE produtos.id = :id;");
            $produto->bindParam(":id", $id, PDO::PARAM_INT);
            if($produto->execute()){
                return true;    
            } else{
                return false;
            } 

        } catch (PDOException $exc) {
            echo "" . ($exc->getMessage());
        }
    }


    function updade_produto(Produto $produto){
        
        try {
            $pdt = $this->pdo->prepare("UPDATE produtos SET nome = :nome, preco = :preco, 
                                            descricao = :descricao, categoria_id = :categoria_id, usado = :usado WHERE id = :id;");
            $pdt->bindParam(":nome", $produto->getNome(), PDO::PARAM_STR);
            $pdt->bindParam(":preco", $produto->getPreco(), PDO::PARAM_STR);
            $pdt->bindParam(":descricao", $produto->getDescricao(), PDO::PARAM_STR);
            $pdt->bindParam(":categoria_id", $produto->getCategoria()->getId(), PDO::PARAM_INT);
            $pdt->bindParam(":usado", $produto->getUsado(), PDO::PARAM_BOOL);
            $pdt->bindParam(":id", $produto->getId(), PDO::PARAM_INT);

            if ($pdt->execute()) {
                return true;
            }else{
                return false;
            }

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }   
}

?>