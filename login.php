<?php session_start(); ?>
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
	if(isset($_POST["inputemail"])){	//Condição de primeira visita à pagina para rodar o php
		$conex = mysqli_connect("localhost","root","790084","repositorio") or die("fail connect"); #Tenta conectar à base de dados e ao banco 'pagin'
		
		$select = "select * from usuario";	//consulta sql da tabela users(usuarios do sistema) pegando o email e password para comparação com os inseridos pelo usuario no sistema
		$select = mysqli_query($conex,$select);	//estabelece a query com o banco de dados

		if (mysqli_num_rows($select) > 0) {	//conta o numero de linhas retornadas da consulta, se for maior que 0 linhas, um loop é feito mostrando o resultado
		// output data of each row
			while($row = mysqli_fetch_assoc($select)) {	//enquanto houver linhas da consulta ainda não exibidas, a var row assume o conteudo dessas linhas de forma associativa, combinando os resultados em vetores com posições(com nomes dos atributos) da tabela
				//echo "Email: ".$row["email"]."<br>-Password: ".$row["password"]."<br><br>";	//Mostra o output dos dados dp bd
				if ($_POST["inputemail"]==$row["email_usuario"] && $_POST["inputpassword"] == $row["senha_usuario"]) //faz a comparação dos dados em formulario(identificados pelos names=input...) obtidos atravez da supervariavel $_GET com os dados retornados do bd, caso um dê match, é exibido a mensagem
				{
					//Guarda os dados do usuario autenticado em variaveis de sessão
					$_SESSION['id_usuario'] = $row['id_usuario'];
					$_SESSION['nome_usuario'] = $row['nome_usuario'];
					$_SESSION['cidade_usuario'] = $row['cidade_usuario'];
					$_SESSION['email_usuario'] = $row['email_usuario'];
					$_SESSION['senha_usuario'] = $row['senha_usuario'];
					//Redireciona à pagina de usuario
					echo("<script language='javascript' type='text/javascript'> alert('Logado com Sucesso!'); window.location.href = 'usuario.php'</script>");
				}
			}
			echo("<script language='javascript' type='text/javascript'> alert('login e/ou senha incorretos'); window.location.href = 'login.php'</script>");
		}
		else {
			echo "0 results";
		}
	}
	?>
<!--******************************************************Conteudo Pagina***************************************-->
<body class="text-center">
	<div class="jumbotron">
	<table width="100%">
		<tr height="500px" style="padding-left:500px" align="center">
			<td>
				<div width="200px" style="width:300px">
					<form action="login.php" target="_self" method="post">
						<img src="http://www.stickpng.com/assets/images/5847faf6cef1014c0b5e48cd.png" class="logo"></img><br>
						<h2>Acesso ao Sistema<br><br>
						<input type="email" name="inputemail" class="form-control" placeholder="Endereço de Email"></input>
						<input type="password" name="inputpassword" class="form-control" placeholder="Senha"></input><br>
						<button type="submit" class="btn btn-primary btn-block btn-lg">Acessar</button>
					</form>
				</div>
			</td>
		</tr>
	</table>
	</div>
</body>
</html>