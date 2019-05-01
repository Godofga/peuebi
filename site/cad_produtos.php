<!DOCTYPE html>
<html>

	<head>

		<title> Cadastro de produtos - Prata Shop</title>
		<meta charset="utf-8"/>

    <?php
      	require 'login.php';

      	if(!isset($_SESSION)) 
    	{ 
        	session_start(); 
    	}

      	checkLogin();

				if(!checkRoot())
					header('location:main.php');

        else if(isset($_POST['categoria'])&&isset($_POST['nome'])&&isset($_POST['descricao'])&&isset($_POST['arquivo'])&&isset($_POST['preco'])&&isset($_POST['quantidade'])){
        	$destino = 'imagens/' . $_FILES['arquivo']['name'];
        	$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
			move_uploaded_file($arquivo_tmp, $destino);
          $product = new produto($_POST['categoria'],$_POST['nome'],$_POST['descricao'],$destino,$_POST['preco'],$_POST['quantidade'] );	
          if($product->cadastrarProduto())
          	echo "feito";
          else
          	echo "nao feito";
		}
    ?>

	</head>

	<body>

		<div>
			<form action = "cad_produtos.php" method="POST" enctype="multipart/form-data">
				Categoria:<br/>	
				<input type="text" name="categoria"></input><br/>
				Nome:<br/>
				<input type="text" name="nome"></input><br/>
				Descricao:<br/>
				<input type="text" name="descricao"></input><br/>
				Imagem:<br/>
				<input type="file" name="arquivo"></input><br/>
				Preco:<br/>
				<input type="number" name="preco"></input><br/>
				Quantidade:<br/>
				<input type="number" name="quantidade"></input><br/>
				<input type="submit" value= "Realizar cadastro da categoria"/><br/>
			</form>

				<a href = "main.php"> Voltar à tela inicial </a>
		</div>

	</body>

</html>
