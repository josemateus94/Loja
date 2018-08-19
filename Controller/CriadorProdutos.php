<?php

class CriadorProdutos{
    private $class  = array('Produto', 'Livro Fisico', 'Ebook');  
 
    public function criaPor($tipoProduto, $params, $categoria){
        $class = array('Produto', 'LivroFisico', 'Ebook');  
        $nome = $params['nome'];
        $preco = $params['preco'];
        $descricao = $params['descricao'];
        $usado = isset($params['usado']) ? $params['usado']: 0;       
        if (in_array($tipoProduto, $class)) {
            return new $tipoProduto($nome, $preco, $descricao, $categoria, $usado, $tipoProduto);
        }else{
            return new Produto($nome, $preco, $descricao, $categoria, $usado, $tipoProduto);
        }
    }

    public function atualizaDados($produto, $isbn, $waterMark, $impostoSobreItem){
        if ($produto->isIsbn()) {          
            $produto->setIsbn($isbn);            
        }
        if ($produto->isWaterMark()) {                        
            $produto->setWaterMark($waterMark);
        }
        if($produto->isTaxaImpressao()){
            $produto->setTaxaImpressao($impostoSobreItem);
        }
    }
}

?>