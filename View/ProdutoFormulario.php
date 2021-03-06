<?php 

require_once("Cabecalho.php");
require_once("../Controller/CategoriaController.php");
require_once("../Controller/ProdutoController.php");
require_once("../Controller/TipoProdutoController.php");
require_once("../Filters/UsuarioFilters.php");

?>
<?php
UsuarioFilters::verificaUsuario(); 

$id = isset($_POST['id'])? $_POST['id']: false;
$action = "../Routes/Routes.php"; 

$categoria = new Categoria();
$tipo = new TipoProduto();
$categoria->setId(1); 
$produto = array(new LivroFisico(null, null, null, $categoria, null, $tipo));

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
            <td><input type="checkbox" name="usado" <?= ($produto[0]->getUsado()== 1)? "checked":""; ?> value="1" id="usado"><label for="usado">Usado</label></td>
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
                                              
                        foreach(TipoProdutoController::lista() as $key=>$tipo):
                        $tipoProduto = $produto[0]->getTipoProduto()->getNome() == $tipo->getNome();
                    ?>
                    <option <?php echo ($tipoProduto ? "selected='selected'":""); ?> value="<?= $tipo->getId(); ?>">   
                        <?= $tipo->getNome(); ?>
                    </option>
                    <?php endforeach; ?>
                </select>                        
            </td>
        </tr>
        <tr id = "isbn">        
            <td>Isbn</td>
            <td>
                <input class="form form-control" name="isbn" value="<?php if($produto[0]->isIsbn()){ echo($produto[0]->getIsbn());} ?>" id="isbn">
            </td>
        <tr>
        <tr id = "taxaImpressao" class="ativo">        
            <td>TaxaImpressao</td>
            <td>
                <input type="number" class="form form-control" name="taxaImpressao" min="1" max="20" value="<?php if($produto[0]->isTaxaImpressao()){ echo($produto[0]->getTaxaImpressoa());} ?>" id="taxaImpressao">
            </td>
        <tr>
        <tr id = "waterMark" class="ativo">        
            <td>WaterMark</td>
            <td>
                <input type="number" class="form form-control" name="waterMark" min="1" max="20" value="<?php if($produto[0]->isWaterMark()){ echo($produto[0]->getWaterMark());} ?>" id="waterMark">
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
        if ($("#tipoProduto").val() == 1) {//LivroFisico
            $("#taxaImpressao").removeClass("ativo");
            $("#waterMark").addClass("ativo");
        } else {
            $("#waterMark").removeClass("ativo");
            $("#taxaImpressao").addClass("ativo");
        }
    }
    if ($("#tipoProduto").val() == 1) { //LivroFisico
        $("#taxaImpressao").removeClass("ativo");
        $("#waterMark").addClass("ativo");
    } else {
        $("#waterMark").removeClass("ativo");
        $("#taxaImpressao").addClass("ativo");
    }
</script>