<!DOCTYPE html>
<html>

	<head>

		<title> Prata shop </title>
		<meta charset="utf-8"/>

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
						echo "<a href = 'produtos.php'> Compra de produtos </a> <br>
						<a href = 'historico.php'> Visualizar compras realizadas </a> <br>";
				?>




				<a href = "login.php?exits=true"> Sair da sessão</a> <br>
		</div>

	</body>

</html>
