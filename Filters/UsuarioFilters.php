<?php
session_start();
require_once("../Lang/Mensagens.php");
class Usuario{
    
    public static function usuarioEstaLogado(){
        return (isset($_SESSION['usuario_logado']));
    }
    
    public static function verificaUsuario(){
        if (!self::usuarioEstaLogado()) {
            $_SESSION['danger']= Mensagens::$naoLogado;
            header("Location: Index.php");
            die();    
        }
    }
    
    public static function usuarioLogado(){
        return ($_SESSION['usuario_logado']);
    }
    
    public static function setSessionUsuario($email){
        $_SESSION['usuario_logado'] = $email;
        //setcookie("usuario_logado", $email, time()+60);
    }
    
    public static function logout(){
        session_destroy();
    }
}

?>