<?php    
    require_once("../Filters/UsuarioFilters.php"); 
    require_once("../Lang/Mensagens.php");
    UsuarioFilters::logout();
    session_start();
    $_SESSION['success'] = Mensagens::$logoff;
    header("Location: ../View/Index.php");           
    die();

?>