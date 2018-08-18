<?php 
require_once("Cabecalho.php"); 
require_once("../Filters/UsuarioFilters.php");
require_once("../Lang/Mensagens.php");
require_once("../Mensagem/MensagemAlerta.php");
?>
<h1>Bem vindo!</h1>	
<?php if(Usuario::usuarioEstaLogado()) { ?>			
	<p class='text-success'>Você esta logado com <?= Usuario::usuarioLogado(); ?> <a href="../Controller/Logout.php">Deslogar</a></p>			
<?php }else { ?>
	<h2>Login</h2>		
	<form method="post" action="../Controller/Login.php">
		<table class="table">		
			<tr>
				<td>Email</td>
				<td><input class="form-control" type="email" name="email"></td>
			</tr>
			<tr>
				<td>Senha</td>
				<td><input class="form-control" type="password" name="senha"></td>
			</tr>
			<tr>
				<td><button type="submit" class="btn btn-primaty">Login</button></td>
			</tr>
		</table>
	</form> 	
<?php } ?>
<?php require_once("Rodape.php"); ?>