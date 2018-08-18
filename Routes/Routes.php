<?php
require_once("../Controller/ProdutoController.php");

$produto = new ProdutoController();
switch ($_POST['tipo']) {
    case 'remover':
        $produto->remover();
        break;
    case 'Alterar':
        $produto->alterar();
        break;
    case 'Cadastro':
        $produto->adicionar();
        break;   
}
?>