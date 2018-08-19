<?php

abstract class Livro extends Produto{

    private $isbn;

    public function getIsbn(){
        return $this->isbn;
    }
    public function setIsbn($isbn){
        $this->isbn = $isbn;
    }

    public function impostoSobreItem(){
        return round($this->getPreco() * 0.065,2);
    }
}

?>