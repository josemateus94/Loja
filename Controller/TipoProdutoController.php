<?php

require_once("../Dao/TipoProdutoDao.php");
require_once("../Model/TipoProduto.php");

class TipoProdutoController{

    public static function lista(){
        $tipos = array();
        $tipoC = new TipoProdutoDao();
        foreach ($tipoC->lista() as $value) {
            $tc = new TipoProduto();
            $tc->setNome($value['nome']);
            $tc->setId($value['id']);
            array_push($tipos, $tc);
        }        
        return $tipos;
    }
}

?>