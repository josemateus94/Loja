<?php 

require_once("Cabecalho.php");
require_once("../Dao/CategoriaDao.php");
require_once("../Dao/ProdutoDao.php");
require_once("../Filters/UsuarioFilters.php");
require_once("../Model/Produto.php");
require_once("../Model/Categoria.php");

$bd = new BancoCategoria();
$bp = new ProdutoDao();   

?>
<?php
Usuario::verificaUsuario(); 

$id = isset($_POST['id'])? $_POST['id']: false;
$action = "../Routes/Routes.php"; 

$categoria = new Categoria();
$categoria->setId(1); 
$produto = new Produto(null, null, null, $categoria, null);

$usado="";
if ($id) {  
    $pdt = $bp->listaProdutos($id);

    $nome = $pdt->getNome();
    $preco = $pdt->getPreco();
    $descricao = $pdt->getDescricao();
    $categoria = $pdt->getCategoria();
    $usado = $pdt->getUsado() ? "checked='checked'":""; 
           
    $produto = new Produto($nome, $preco, $descricao, $categoria, $usado);    
}
?>

<h1><?php echo $id? "Edição":"Cadastro";  ?></h1>
<form action="<?php echo($action); ?>" method="post">
    <table class="table">
        <tr>
            <td>Nome</td>
            <td><input class="form-control" type="text" name="nome" id="valor" value="<?= $produto->getNome(); ?>" /></td>
        </tr>
        <tr>
            <td>Preço</td>
            <td><input class="form-control" type="number" name="preco" step="0.01" value="<?= $produto->getPreco(); ?>" /></td>
        </tr>
        <tr>
            <td>Descrição</td>
            <td><textarea class="form-control" name="descricao" ><?= $produto->getDescricao(); ?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="checkbox" name="usado" <?= $produto->getUsado(); ?> value="1" id="usado"><label for="usado">Usado</label></td>
        </tr>
        <tr> 
            <td>Categoria</td>
            <td>                
                <select name="categoria_id">
                    <?php foreach($bd->listaCategoria() as $categorias): 
                        $categoria = $categorias['id'] == $produto->getCategoria()->getId();
                    ?>
                        <option <?php echo ($categoria ? "selected='selected'":""); ?> value="<?= $categorias['id']; ?>">   
                            <?= $categorias['nome']?>
                        </option>
                    <?php endforeach; ?>
                </select>                          
            </td>
        </tr>
        <tr> 
            <input type="hidden" name="id" value="<?php echo($id); ?>"> 
            <input type="hidden" name="tipo" value="<?php echo $id? "Alterar":"Cadastro";  ?>"/>          
            <td><button class="btn btn-primary" type="submit"><?php echo $id? "Alterar":"Cadastro";  ?></button></td>
        </tr>       
    </table>
</form>

<?php require_once("Rodape.php"); ?>
