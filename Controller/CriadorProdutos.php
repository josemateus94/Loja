<?php

class CriadorProdutos{
    private $class  = array('LivroFisico', 'Ebook');  
 
    public function criaPor($tipoProduto, $params, $categoria){
        $nome = $params['nome'];
        $preco = $params['preco'];
        $descricao = $params['descricao'];
        $usado = isset($params['usado']) ? $params['usado']: 0;       
        if (in_array($tipoProduto, $this->class)) {
            return new $tipoProduto($nome, $preco, $descricao, $categoria, $usado, $tipoProduto);
        }else{
            return new LivroFisico($nome, $preco, $descricao, $categoria, $usado, $tipoProduto);
        }
    }
}

?>