<?php

class LivroFisico extends Livro{

    private $taxaImpressoa;

    public function getTaxaImpressoa(){
        return $this->taxaImpressoa;
    }
    public function setTaxaImpressao($taxaImpressao){
        $this->taxaImpressoa = $taxaImpressao;
    }
    
}

?>