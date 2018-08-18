<?php  
error_reporting(E_ALL ^ E_NOTICE);
require_once("../Mensagem/MensagemAlerta.php"); 
?>
<html>
<head>
    <title>Minha loja</title>   
    <meta charset="utf-8">
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/main.css" rel="stylesheet" />
</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="Index.php" class="navbar-brand">Minha Loja</a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <li><a href="ProdutoFormulario.php">Adiciona Produto</a></li>
                    <li><a href="ProdutoLista.php">Produtos</a></li>
                    <!--<li><a href="Teste.php">Teste</a></li>-->
                    <li><a href="FaqFinanceiro.php">Faq Financeiro</a></li>
                    <li><a href="FaqPlanejamento.php">Faq Planejamento</a></li>
                    <li><a href="Contato.php">Contato</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
    <div class="principal">
<?php
MensagemAlerta::mostraAlerta("success");
MensagemAlerta::mostraAlerta("danger");
?>