<?php
session_start();
require_once("../Dao/ProdutoDao.php");
require_once("../Lang/Mensagens.php");
require_once("../Model/Produto.php");
require_once("../Model/Categoria.php");
require_once("../Model/Livro.php");

class ProdutoController{
    
    private $produtoDao;
    private $categoria;
    public function __construct(){        
        $this->produtoDao = new ProdutoDao();
        $this->categoria = new Categoria();
    }
    
    public function remover(){
        $id = $_POST['id'];
        $this->produtoDao->removeProduto($id);
        $_SESSION['success'] = Mensagens::$removeProduto;
        header("Location: ../View/ProdutoLista.php");
        die();
    }
    
    public function alterar(){
        $nome = $_POST["nome"];
        $preco = $_POST["preco"];
        $descricao = $_POST["descricao"];
        $usado = (isset($_POST['usado']) ? $_POST['usado']: 0);
        $tipoProduto = $_POST['tipoProduto'];    
        $this->categoria->setId($_POST["categoria_id"]);            
        
        if ($tipoProduto == 'Produto') {
            $produto = new Produto($nome, $preco, $descricao, $this->categoria, $usado, $tipoProduto);
        }else{
            $produto = new Livro($nome, $preco, $descricao, $this->categoria, $usado, $tipoProduto);
            $produto->setIsbn($_POST['isbn']);
        }
        $produto->setId($_POST['id']);
        if ($this->produtoDao->updade_produto($produto)) {	
            $_SESSION['success'] = Mensagens::$alterarProduto;
            header("Location: ../View/ProdutoLista.php");
            die();
        }else{
            $_SESSION['danger'] = Mensagens::$erroalterarProduto;
            header("Location: ../View/ProdutoLista.php");
            die();
        }
    }
    
    public function adicionar(){
        $nome = $_POST["nome"];
        $preco = $_POST["preco"];
        $descricao = $_POST["descricao"];
        $usado = isset($_POST['usado']) ? $_POST['usado']: 0;
        $isbn =  !empty($_POST['isbn']) ? $_POST['isbn'] : null;
        $tipoProduto = $_POST['tipoProduto'];
        
        $this->categoria->setId($_POST["categoria_id"]);
        if ($tipoProduto == "Livro") {
            $produto = new Livro($nome, $preco, $descricao, $this->categoria, $usado, $tipoProduto);
            $produto->setIsbn($isbn);
        }else{
            $produto = new Produto($nome, $preco, $descricao, $this->categoria, $usado, $tipoProduto);
        }
        if($this->produtoDao->insereProduto($produto)) { 
            $_SESSION['success'] = Mensagens::$adicionarProduto."".$produto->getNome();
            header("Location: ../View/ProdutoLista.php").
            die();
        } else {
            $_SESSION['danger'] = Mensagens::$erroAddProduto."".$produto->getNome();
            header("Location: ../View/ProdutoLista.php").
            die();
        }
    }
    
    public function lista($id=null){
        $produtos = array();
        $listaprodutos = $this->produtoDao->listaProdutos($id);
        foreach($listaprodutos as $listaproduto){ 
            $nome = $listaproduto['nome'];                     
            $preco = $listaproduto['preco'];
            $descricao = $listaproduto['descricao'];
            $usado = $listaproduto['usado'];
            $tipoProduto = $listaproduto['tipoProduto'];
            $isbn = $listaproduto['isbn'];
            $this->categoria->setNome($listaproduto['categoria_nome']);            
            if ($tipoProduto == "Livro") {
                $produto = new Livro($nome, $preco, $descricao, $this->categoria, $usado, $tipoProduto);
                $produto->setIsbn($isbn);
            }else{
                $produto = new Produto($nome, $preco, $descricao, $this->categoria, $usado, $tipoProduto);
            }            
            $produto->setId($listaproduto['id']);
            array_push($produtos, $produto);
            $this->categoria = new Categoria();
        }
        return $produtos;
    }
}

?>