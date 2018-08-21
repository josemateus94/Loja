<?php
session_start();
require_once("../Dao/ProdutoDao.php");
require_once("../Lang/Mensagens.php");
require_once("../Model/Produto.php");
require_once("../Model/Categoria.php");
require_once("../Model/Livro.php");
require_once("../Model/LivroFisico.php");
require_once("../Model/Ebook.php");
require_once("../Model/TipoProduto.php");
require_once("CriadorProdutos.php");

class ProdutoController{
    
    private $produtoDao;
    private $categoria;
    private $tipoProduto;
    public function __construct(){        
        $this->produtoDao = new ProdutoDao();
        $this->categoria = new Categoria();
        $this->tipoProduto = new TipoProduto();
    }
    
    public function remover(){
        $id = $_POST['id'];
        $this->produtoDao->removeProduto($id);
        $_SESSION['success'] = Mensagens::$removeProduto;
        header("Location: ../View/ProdutoLista.php");
        die();
    }
    
    public function alterar(){
        $isbn =  !empty($_POST['isbn']) ? $_POST['isbn'] : null;
        $tipoProduto = $_POST['tipoProduto'];
        $this->categoria->setId($_POST["categoria_id"]);
        $waterMark =  !empty($_POST['waterMark']) ? $_POST['waterMark'] : null;
        $impostoSobreItem =  !empty($_POST['taxaImpressao']) ? $_POST['taxaImpressao'] : null;
        $dados = array("waterMark"=>$waterMark, "impostoSobreItem"=>$impostoSobreItem);

        $criadorProdutos = new CriadorProdutos();
        $produto = $criadorProdutos->criaPor($tipoProduto, $_POST, $this->categoria);
        $produto->atualizaDados($produto, $isbn, $dados);
        
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
        $isbn =  !empty($_POST['isbn']) ? $_POST['isbn'] : null;
        $this->tipoProduto->setId($_POST['tipoProduto']);
        $this->categoria->setId($_POST["categoria_id"]);
        $waterMark =  !empty($_POST['waterMark']) ? $_POST['waterMark'] : null;
        $impostoSobreItem =  !empty($_POST['taxaImpressao']) ? $_POST['taxaImpressao'] : null;
        $dados = array("waterMark"=>$waterMark, "impostoSobreItem"=>$impostoSobreItem);
        
        $criadorProdutos = new CriadorProdutos();
        $produto = $criadorProdutos->criaPor($this->tipoProduto, $_POST, $this->categoria);
        $produto->atualizaDados($produto, $isbn, $dados);
        
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
            $isbn =  !empty($listaproduto['isbn']) ? $listaproduto['isbn'] : null;
            $this->tipoProduto->setId($listaproduto['tipoProduto']);
            $this->tipoProduto->setNome($listaproduto['tipoNome']);
            //var_dump($listaproduto['tipoNome']);
            $waterMark =  !empty($listaproduto['waterMark']) ? $listaproduto['waterMark'] : null;
            $impostoSobreItem =  !empty($listaproduto['taxaImpressao']) ? $listaproduto['taxaImpressao'] : null;
            $dados = array("waterMark"=>$waterMark, "impostoSobreItem"=>$impostoSobreItem);

            $this->categoria->setNome($listaproduto['categoria_nome']); 
            $itens = array("nome"=>$listaproduto['nome'], "preco"=> $listaproduto['preco'], "descricao"=> $listaproduto['descricao'], 
                            "usado"=> $listaproduto['usado']);
            $criadorProdutos = new CriadorProdutos();
            $produto = $criadorProdutos->criaPor($this->tipoProduto, $itens, $this->categoria);
            $produto->atualizaDados($produto, $isbn, $dados);   
            
            $produto->setId($listaproduto['id']);
            array_push($produtos, $produto);
            $this->categoria = new Categoria();
        }
        return $produtos;
    }
}

?>