<!DOCTYPE html>
<html>

	<head>

		<title> Cadastro de categorias - Prata Shop</title>
		<meta charset="utf-8" name='viewport' content='width-device-width, initial-scale-1.0'/>
		<link href='css/bootstrap.min.css' rel ='stylesheet' type='text/css'/>
		<link rel ='stylesheet' type='text/css' href='css/formmenu.css'>
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
					<form class='form-container' action = "cad_categorias.php" method="POST">
						<div class="form-group">
							<label for="categoria">Categoria</label>
							<input type="text" class="form-control" id="categoria" name="categoria" placeholder="Nome da categoria">
						</div>


						<?php

							if(isset($_POST['categoria'])){

									$categ = new categoria($_POST['categoria']);
									if($categ->salvar())
										echo "
											<div class='alert alert-success' role='alert'>
												Categoria cadastrada!
											</div>";
									else
										echo "
											<div class='alert alert-warning' role='alert'>
												A categoria já existe!
											</div>";

								}

						?>

						<button type="submit" class="btn btn-outline-dark btn-block">Cadastrar categoria</button><br>
						<a href = "main.php" class="alert-link" id="cadastroLink"> Voltar à tela inicial </a>
					</form>
				</section>
		</section>

	</body>

</html>
