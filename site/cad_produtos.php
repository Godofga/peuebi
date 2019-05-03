<!DOCTYPE html>
<html>

	<head>

		<title> Cadastro de produtos - Prata Shop</title>
		<meta charset="utf-8" name='viewport' content='width-device-width, initial-scale-1.0'/>
		<link href='css/bootstrap.min.css' rel ='stylesheet' type='text/css'/>
		<link rel ='stylesheet' type='text/css' href='css/form.css'>
		<script type= 'text/javascript' src='js/jquery-3.4.1.min.js'></script>
		<script type= 'text/javascript' src='js/bootstrap.min.js'></script>

    <?php
      	require 'login.php';

      	if(!isset($_SESSION))
    	{
        	session_start();
    	}

      	checkLogin();

				if(!checkRoot())
					header('location:main.php');


    ?>

	</head>

	<body>


		<section class = "container-fluid">
			<section class= "row justify-content-center">
					<form class='form-container' action = "cad_produtos.php" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="categoria">Categoria</label>
							<input type="text" class="form-control" id="categoria" name="categoria" placeholder="Nome da categoria">
						</div>
						<div class="form-group">
							<label for="nome">Nome</label>
							<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do produto">
						</div>
						<div class="form-group">
							<label for="descricao">Descrição</label>
							<input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição">
						</div>
						<div class="form-group">
							<label for="arquivo">Imagem</label>
							<input type="file" class="form-control" id="arquivo" name="arquivo" placeholder="Imagem da mercadoria">
						</div>
						<div class="form-group">
							<label for="preco">Preço</label>
							<input type="number" class="form-control" id="preco" name="preco" placeholder="Preço">
						</div>
						<div class="form-group">
							<label for="quantidade">Quantidade</label>
							<input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Quantidade em estoque">
						</div>

						<?php

								if(isset($_POST['categoria'])&&isset($_POST['nome'])&&isset($_POST['descricao'])&&isset($_FILES['arquivo']['name'])&&isset($_POST['preco'])&&isset($_POST['quantidade'])){

								$imagem   = $_FILES['arquivo']['name'];
								$tmp_name = $_FILES['arquivo']['tmp_name'];
								$pasta    = 'C:\xampp\htdocs\peuebi\site\imagens';
								if(move_uploaded_file($tmp_name, $pasta.'/'.$imagem)){
									$product = new produto($_POST['categoria'],$_POST['nome'],$_POST['descricao'],$imagem,$_POST['preco'],$_POST['quantidade'] );
												if($product->cadastrarProduto())
												echo "
													<div class='alert alert-success' role='alert'>
														Produto cadastrado!
													</div>";
										} else
												echo "
													<div class='alert alert-warning' role='alert'>
														Algo de errado ocorreu!
													</div>";
										$destino = 'imagens/' . $_FILES['arquivo']['name'];
										$product = new produto($_POST['categoria'],$_POST['nome'],$_POST['descricao'],$destino,$_POST['preco'],$_POST['quantidade'] );
										if($product->cadastrarProduto())
											echo "
												<div class='alert alert-success' role='alert'>
													Produto cadastrado!
												</div>";
										else
											echo "
												<div class='alert alert-warning' role='alert'>
													Algo de errado ocorreu!
												</div>";
							}
						?>

						<button type="submit" class="btn btn-outline-dark btn-block">Cadastrar produto</button><br>
						<a href = "main.php" class="alert-link" id="cadastroLink"> Voltar à tela inicial </a>
					</form>
				</section>
		</section>









	</body>

</html>
