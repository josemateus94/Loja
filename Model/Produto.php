<?php

class Produto{
    
    private $id;
    private $nome;
    private $preco;
    private $descricao;
    private $categoria;
    private $usado;
    private $isbn;
    private $tipoProduto;
    
    function __construct($nome, $preco, $descricao, Categoria $categoria, $usado, $tipoProduto){
        $this->nome = $nome;
        $this->preco = $preco;
        $this->descricao = $descricao;
        $this->categoria = $categoria;
        $this->usado = $usado;
        $this->tipoProduto = $tipoProduto;
    }

    public function precoDesconto($desconto=0.1){
        if ($desconto>0 && $desconto <= 0.5) {            
            $this->preco -= $this->preco * $desconto;            
        }
        return $this->preco;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function getID(){
        return $this->id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getPreco(){
        return $this->preco;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function setUsado($usado){
        $this->usado = $usado;
    }
    public function getUsado(){
        return $this->usado;
    }

    public function setIsbn($isnb){
        $this->isnb = $isnb;
    }
    public function getIsbn(){
        return $this->isnb;
    }
   
    public function getTipoProduto(){
        return $this->tipoProduto;
    }
}

?>