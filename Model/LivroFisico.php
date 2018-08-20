<?php

class LivroFisico extends Livro{

    private $taxaImpressoa;

    public function getTaxaImpressoa(){
        return $this->taxaImpressoa;
    }
    public function setTaxaImpressao($taxaImpressao){
        $this->taxaImpressoa = $taxaImpressao;
    }

    public function atualizaDados($produto, $isbn, $dados){ 
        $produto->setIsbn($isbn);            
        $produto->setTaxaImpressao($dados['impostoSobreItem']);
    } 
}

?>