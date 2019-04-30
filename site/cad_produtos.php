<!DOCTYPE html>
<html>

	<head>

		<title> Cadastro de produtos - Prata Shop</title>
		<meta charset="utf-8"/>

    <?php
      	require 'login.php';

        session_start();

      	checkLogin();

		if(!checkUser(true))
			header('location:main.php');

        if(isset($_POST['categoria'])&&isset($_POST['nome'])&&isset($_POST['descricao'])&&isset($_POST['imagem'])&&isset($_POST['preco'])&&isset($_POST['quantidade'])){
        	
          $product = new produto($_POST['categoria'],$_POST['nome'],$_POST['descricao'],$_POST['imagem'],$_POST['preco'],$_POST['quantidade'] );

          echo 'Feito!<br>';
        }

    ?>

	</head>

	<body>

		<div>
			<form action = "cad_produtos.php" method="POST">
				Categoria:<br/>
				<input type="text" name="categoria"></input><br/>
				Nome:<br/>
				<input type="text" name="nome"></input><br/>
				Descricao:
				<input type="text" name="descricao"></input><br/>
				Imagem:
				<input type="file" name="imagem"></input><br/>
				Preco:
				<input type="number" name="preco"></input><br/>
				Quantidade:
				<input type="number" name="quantidade"></input><br/>
				<input type="submit" value= "Realizar cadastro da categoria"/><br/>
			</form>

				<a href = "index.php"> Voltar à tela de login </a>
		</div>

	</body>

</html>
