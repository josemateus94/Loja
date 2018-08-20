<?php

class Ebook extends Livro{

    private $waterMark;

    public function getWaterMark(){
        return $this->waterMark;
    }
    public function setWaterMark($waterMark){
        $this->waterMark = $waterMark;
    }

    public function atualizaDados($produto, $isbn, $dados){        
        $produto->setIsbn($isbn);                           
        $produto->setWaterMark($dados['waterMark']);
    }
}

?>