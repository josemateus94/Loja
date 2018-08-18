<?php 
require_once("../Dao/UsuarioDao.php");
require_once("../Filters/UsuarioFilters.php");
require_once("../Lang/Mensagens.php");

$bu = new BancoUsuario();

$usuario =$bu->buscaUsuario( $_POST["email"], $_POST["senha"]);
if ($usuario) { 
    UsuarioFilters::setSessionUsuario($usuario['email']);        
    $_SESSION['success'] = Mensagens::$login;
}else{
    $_SESSION['danger'] = Mensagens::$erroLogin;    
}
header("Location: ../View/Index.php");
?>