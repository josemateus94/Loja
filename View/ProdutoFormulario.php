<?php 

require_once("Cabecalho.php");
require_once("../Controller/CategoriaController.php");
require_once("../Controller/ProdutoController.php");
require_once("../Filters/UsuarioFilters.php");

?>
<?php
UsuarioFilters::verificaUsuario(); 

$id = isset($_POST['id'])? $_POST['id']: false;
$action = "../Routes/Routes.php"; 

$categoria = new Categoria();
$categoria->setId(1); 
$produto = array(new Produto(null, null, null, $categoria, null, null));

$usado="";
if ($id) {
    $pc = new ProdutoController();  
    $produto = $pc->lista($id);   
}
?>

<h1><?php echo $id? "Edição":"Cadastro";  ?></h1>
<form action="<?php echo($action); ?>" method="post">
    <table class="table">
        <tr>
            <td>Nome</td>
            <td><input class="form-control" type="text" name="nome" id="valor" value="<?= $produto[0]->getNome(); ?>" /></td>
        </tr>
        <tr>
            <td>Preço</td>
            <td><input class="form-control" type="number" name="preco" step="0.01" value="<?= $produto[0]->getPreco(); ?>" /></td>
        </tr>
        <tr>
            <td>Descrição</td>
            <td><textarea class="form-control" name="descricao" ><?= $produto[0]->getDescricao(); ?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="checkbox" name="usado" <?= $produto[0]->getUsado(); ?> value="1" id="usado"><label for="usado">Usado</label></td>
        </tr>
        <tr> 
            <td>Categoria</td>
            <td>                
                <select name="categoria_id">
                    <?php foreach(CategoriaController::lista() as $categorias): 
                        $categoria = $categorias['id'] == $produto[0]->getCategoria()->getId();
                    ?>
                        <option <?php echo ($categoria ? "selected='selected'":""); ?> value="<?= $categorias['id']; ?>">   
                            <?= $categorias['nome']?>
                        </option>
                    <?php endforeach; ?>
                </select>                          
            </td>
        </tr>
        <tr> 
            <td>Tipo Produto</td>
            <td onclick="ativo()" onkeyup="ativo()">                
                <select name="tipoProduto" id="tipoProduto">                    
                    <?php
                        $tipos = array('produto', 'livro');                        
                        foreach($tipos as $key=>$tipo): 
                        $tipoProduto = $produto[0]->getTipoProduto() == $tipo;
                    ?>
                        <option <?php echo ($tipoProduto ? "selected='selected'":""); ?> value="<?= $tipo ?>">   
                            <?= $tipo ?>
                        </option>
                    <?php endforeach; ?>
                </select>                        
            </td>
        </tr>
        <tr id = "isbn" class="ativo">        
            <td>Isbn</td>
            <td>
                <input class="form form-control" name="isbn" value="<?= $produto[0]->getIsbn(); ?>" id="isbn">
            </td>
        <tr>
        <tr> 
            <input type="hidden" name="id" value="<?php echo($id); ?>"> 
            <input type="hidden" name="tipo" value="<?php echo $id? "Alterar":"Cadastro";  ?>"/>          
            <td><button class="btn btn-primary" type="submit"><?php echo $id? "Alterar":"Cadastro"; ?></button></td>
        </tr>       
    </table>
</form>

<?php require_once("Rodape.php"); ?>

<script>
    function ativo(){
        if ($("#tipoProduto").val() == "livro") {
            $("#isbn").removeClass("ativo");
        }else{
            $("#isbn").addClass("ativo");
        }
    }
    if ($("#tipoProduto").val() == "livro") {
            $("#isbn").removeClass("ativo");
    }
</script>