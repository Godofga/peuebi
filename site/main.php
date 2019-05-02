<!DOCTYPE html>
<html>

	<head>

		<title> Prata shop </title>
		<meta charset="utf-8" name='viewport' content='width-device-width, initial-scale-1.0'/>
		<link href='css/bootstrap.min.css' rel ='stylesheet' type='text/css'/>
		<link rel ='stylesheet' type='text/css' href='css/formmenu.css'>
		<script type= 'text/javascript' src='js/jquery-3.4.1.min.js'></script>
		<script type= 'text/javascript' src='js/bootstrap.min.js'></script>

		<?php

      require 'login.php';

			checkLogin();
			$root = checkRoot();

		?>

	</head>

	<body>


		<section class = "container-fluid">
			<section class= "row justify-content-center">
					<form class='form-container' action="cadastro.php" method="POST">

						<?php
							if($root)
								echo "
								<a href = 'cad_produtos.php' class='alert-link' id='cadastroLink'> Cadastro de produtos </a> <br>
								<a href = 'cad_categorias.php' class='alert-link' id='cadastroLink'> Cadastro de categorias </a> <br>
								<a href = 'status.php' class='alert-link' id='cadastroLink'> Alterar status dos pedidos </a> <br>";
							else
								echo "<a href = 'compras.php' class='alert-link' id='cadastroLink'> Compra de produtos </a> <br>
								<a href = 'historico.php' class='alert-link' id='cadastroLink'> Visualizar compras realizadas </a> <br>";
						?>
						<a href = "produtos.php" class="alert-link" id="cadastroLink"> Produtos</a> <br>
						<a href = "login.php?exits=true" class="alert-link" id="cadastroLink"> Sair da sessão</a> <br>
					</form>
				</section>
		</section>
	</body>

</html>
