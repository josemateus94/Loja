<?php

require_once("TipoProdutoController.php");

class CriadorProdutos{
    
    public function criaPor($tipoProduto, $params, $categoria){
        $nome = $params['nome'];
        $preco = $params['preco'];
        $descricao = $params['descricao'];
        $usado = isset($params['usado']) ? $params['usado']: 0; 
        
        foreach(TipoProdutoController::lista() as $class){            
            if ($tipoProduto->getId() == $class->getId()) {
                $tipoNome = $class->getNome();
                return new $tipoNome($nome, $preco, $descricao, $categoria, $usado, $tipoProduto);
            }      
        }
        return new LivroFisico($nome, $preco, $descricao, $categoria, $usado, $tipoProduto);
    }
}

?>