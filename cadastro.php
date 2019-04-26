<html>
<head>
<!------------------------------------Configuration Bootstrap--------------------------->	
	<meta charset="utf-8"> <!--Acentuação-->
	<meta name="viewport" content="width=device-width, initial-scale=1"><!--Responsividade(tamanho tela celular)-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"><!--Modelo CSS-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!------------------------------------Style CSS-------------------------------------------->
	<style>
		table,th,td,span,div{border:0px solid black;}
		.logo{height:70px}	
	</style>
</head>
<!--**********************************************Verificão de Formulario****************************************-->
<?php
	if( isset($_POST['inputnome'])){	//Condição de primeira visita à pagina para rodar o php
		$conexao = mysqli_connect("localhost","root","790084","repositorio") or die("Não conectado!");	//Conexão banco de dados especificamente pagin
		
		//Query de inserção na tabela usuarios, pegando para cada valor a ser adicionado na estrutura as variaveis de formularios atravez de $_POST
		$insert = "insert into usuario (nome_usuario,cidade_usuario,email_usuario,senha_usuario) values	
		('$_POST[inputnome]','$_POST[inputcidade]','$_POST[inputemail]','$_POST[inputsenha]')";
		
		//verifica se cada formulario tem um tamanho maior que 1 caractere para validar o cadastro
		if(strlen($_POST['inputnome']) > 0 && strlen($_POST['inputcidade']) > 0 && strlen($_POST['inputemail']) >0 && strlen($_POST['inputsenha']) > 0){
			if(mysqli_query($conexao,$insert)){
				echo("<script language='javascript' type='text/javascript'> alert('Cadastro Concluido!'); window.location.href = 'index.php'</script>");
			}
			else{
				echo("<script language='javascript' type='text/javascript'> alert('Falha no cadastro!'); window.location.href = 'index.php'</script>");
			}
		}
		else{echo "<script language='javascript' type='text/javascript'> alert('Dados informados Invalidos!'); window.location.href = 'index.php'</script>";}
	}
?>
<!--******************************************************Conteudo Pagina***************************************-->
<body class="text-center">
	<div class="jumbotron">
	<table width="100%">
		<tbody><tr height="500px" style="padding-left:500px" align="center">
			<td>
				<div width="200px" style="width:300px">
					<form action="cadastro.php" target="_self" method="post">
					<img src="http://www.stickpng.com/assets/images/5847faf6cef1014c0b5e48cd.png" class="logo"><img><br>
						<h2>Realizar Cadastro<br><br>
						<input type="text" name="inputnome" class="form-control" placeholder="Nome">
						<input type="text" name="inputcidade" class="form-control" placeholder="Cidade">
						<input type="email" name="inputemail" class="form-control" placeholder="Endereço de Email">
						<input type="password" name="inputsenha" class="form-control" placeholder="Senha"><br>
						<button type="submit" class="btn btn-primary btn-block btn-lg">Requisitar Cadastro</button>
					
				</h2></form></div>
			</td>
		</tr>
	</tbody></table>
	</div>

</body></html>