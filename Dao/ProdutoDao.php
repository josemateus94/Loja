<?php

require_once('Conexao.php');
require_once('../Model/Produto.php');

class ProdutoDao{

    private $conexao;
    private $pdo;

    public function __construct(){
        $this->conexao = new Conexao();
        $this->pdo = $this->conexao->conectar();
    }

    function listaProdutos($id=null){        

        if (!empty ($id)) {
            $comparacao = "where lp.id = $id";
        }else{
            $comparacao = "";
        }
        try {
            $lista = $this->pdo->prepare("SELECT lp.*, lc.nome as categoria_nome, tp.nome as tipoNome 
                                            FROM loja.produtos as lp 
                                            join loja.categorias as lc on lc.id = lp.categoria_id 
                                            join tipoProduto as tp on tp.id = lp.tipoProduto 
                                            $comparacao;");
            $lista->execute();                                        
            return $lista->fetchAll();              
        } catch (Exception $e) {
            echo ($e->getMessage());
        }
    }

    function insereProduto(Produto $produto){
    
        if ($produto->isTaxaImpressao()) {
            $taxaImpressao = $produto->getTaxaImpressoa();
        }else{
            $taxaImpressao = null;
        }

        if ($produto->isWaterMark()) {
            $waterMark = $produto->getWaterMark();
        }else{
            $waterMark = null;
        }
        
        try {
            $pdt = $this->pdo->prepare("INSERT INTO produtos (nome,preco,descricao,categoria_id, 
                                        usado, isbn, tipoProduto, waterMark, taxaImpressao)
                                        VALUES (:nome,:preco,:descricao,:categoria_id,:usado, :isbn, 
                                        :tipoProduto, :waterMark, :taxaImpressao)");
            $pdt->bindParam(":nome", $produto->getNome(), PDO::PARAM_STR);
            $pdt->bindParam(":preco",  $produto->getPreco(), PDO::PARAM_STR);
            $pdt->bindParam(":descricao",  $produto->getDescricao(), PDO::PARAM_STR);
            $pdt->bindParam(":categoria_id",  $produto->getCategoria()->getId(), PDO::PARAM_STR);
            $pdt->bindParam(":usado",  $produto->getUsado(), PDO::PARAM_BOOL);
            $pdt->bindParam(":isbn", $produto->getIsbn(), PDO::PARAM_STR);
            $pdt->bindParam(":tipoProduto", $produto->getTipoProduto()->getId(), PDO::PARAM_STR);
            $pdt->bindParam(":waterMark", $waterMark, PDO::PARAM_STR);
            $pdt->bindParam(":taxaImpressao", $taxaImpressao, PDO::PARAM_STR);

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

        if ($produto->isTaxaImpressao()) {
            $taxaImpressao = $produto->getTaxaImpressoa();
        }else{
            $taxaImpressao = null;
        }

        if ($produto->isWaterMark()) {
            $waterMark = $produto->getWaterMark();
        }else{
            $waterMark = null;
        }

        try {
            $pdt = $this->pdo->prepare("UPDATE produtos SET nome = :nome, preco = :preco, 
                                        descricao = :descricao, categoria_id = :categoria_id, 
                                        usado = :usado , isbn = :isbn, tipoProduto = :tipoProduto,
                                        waterMark = :waterMark, taxaImpressao = :taxaImpressao 
                                        WHERE id = :id;");
            $pdt->bindParam(":nome", $produto->getNome(), PDO::PARAM_STR);
            $pdt->bindParam(":preco", $produto->getPreco(), PDO::PARAM_STR);
            $pdt->bindParam(":descricao", $produto->getDescricao(), PDO::PARAM_STR);
            $pdt->bindParam(":categoria_id", $produto->getCategoria()->getId(), PDO::PARAM_INT);
            $pdt->bindParam(":usado", $produto->getUsado(), PDO::PARAM_BOOL);
            $pdt->bindParam(":id", $produto->getId(), PDO::PARAM_INT);
            $pdt->bindParam(":isbn", $produto->getIsbn(), PDO::PARAM_STR);
            $pdt->bindParam(":tipoProduto", $produto->getTipoProduto()->getId(), PDO::PARAM_STR);
            $pdt->bindParam(":waterMark", $waterMark, PDO::PARAM_STR);
            $pdt->bindParam(":taxaImpressao", $taxaImpressao, PDO::PARAM_STR);

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