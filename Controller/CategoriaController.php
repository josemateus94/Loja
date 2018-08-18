<?php

require_once("../Dao/CategoriaDao.php");

class CategoriaController{

    public static function lista(){
        $cd = new CategoriaDao();     
        return $cd->listaCategoria();        
    }
}

?>