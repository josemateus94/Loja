<?php 
require_once("Cabecalho.php");
require_once("../Filters/UsuarioFilters.php");
require_once("../Controller/ProdutoController.php");

$produtoController = new ProdutoController();
?>

<table class="table table-striped table-bordered">
    <tr>
        <th>Nome</th>
        <th>Preço</th>
        <th>Desconto</th>
        <th>Descrição</th>
        <th>Categoria</th>
        <th>Novo/Usado</th>       
        <th>Tipo Produto</th>
        <th>Isbn</th>
        <?php if(UsuarioFilters::usuarioEstaLogado()): ?>
            <th colspan="2">Ação</th>
        <?php endif ?>
    <tr>
    <?php
        foreach($produtoController->lista() as $produto) :
    ?>
            <tr class='listaCategoria'>
                <td><?= $produto->getNome(); ?></td>
                <td>R$ <?= $produto->getPreco(); ?></td>
                <td><?= $produto->precoDesconto();  ?></td>
                <td><?= substr($produto->getDescricao(), 0, 40) ?></td>
                <td><?= $produto->getCategoria()->getNome(); ?></td>
                <td><?= ($produto->getUsado() == 1) ? "usado" : "novo"; ?></td>
                <td><?= $produto->getTipoProduto(); ?></td>
                <td><?php if($produto->isIsbn()){ echo($produto->getIsbn());} ?></td>
                <?php if(UsuarioFilters::usuarioEstaLogado()): ?>
                    <td>
                        <form action="ProdutoFormulario.php" method="post">
                            <input type="hidden" name="id" value="<?= $produto->getId(); ?>"/>
                            <button class="btn btn-primary">Alterar</button>
                        </form>
                    </td> 
                    <td>
                        <form action="../Routes/Routes.php" method="post">
                            <input type="hidden" name="tipo" value="remover"/> 
                            <input type="hidden" name="id" value="<?= $produto->getId(); ?>"/>                        
                            <button class="btn btn-danger">Remover</button>
                        </form>
                    </td>
                <?php endif ?>  
            </tr>
        <?php
    endforeach;
    ?>
</table>

<?php require_once("Rodape.php"); ?>
