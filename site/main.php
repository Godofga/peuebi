<!DOCTYPE html>
<html>

	<head>

		<title> Prata shop </title>
		<meta charset="utf-8" name='viewport' content='width-device-width, initial-scale-1.0'/>
		<link href='css/bootstrap.min.css' rel ='stylesheet' type='text/css'/>
		<script type= 'text/javascript' src='js/jquery-3.4.1.min.js'></script>
		<script type= 'text/javascript' src='js/bootstrap.min.js'></script>

		<?php

      require 'login.php';

			checkLogin();
			$root = checkRoot();

		?>

	</head>

	<body>

		<div>
				<?php
					if($root)
						echo "
						<a href = 'cad_produtos.php'> Cadastro de produtos </a> <br>
						<a href = 'cad_categorias.php'> Cadastro de categorias </a> <br>
						<a href = 'status.php'> Alterar status dos pedidos </a> <br>";
					else
						echo "<a href = 'compras.php'> Compra de produtos </a> <br>
						<a href = 'historico.php'> Visualizar compras realizadas </a> <br>";
				?>



				<a href = "produtos.php"> Produtos</a> <br>
				<a href = "login.php?exits=true"> Sair da sessão</a> <br>
		</div>

	</body>

</html>
