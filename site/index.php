<!DOCTYPE html>
<html>

	<head>

		<title> Prata shop </title>
		<meta charset="utf-8"/>

		<?php

			session_start();

			if(isset($_SESSION['usuario']) && isset($_SESSION['senha']))
			  header('location:main.php');

		?>

	</head>

	<body>

		<div>
			<form action="login.php?do=true" method="POST">

				Usuário:<br/>
				<input type="text" name="usuario"></input><br/>
				Senha:<br/>
				<input type="password" name="senha"></input><br/>
				<input type="submit" value= "Realizar login"/><br/>
			</form>

				<?php
					if(isset($_GET['log']) && $_GET['log'])
						echo "Usuário ou senha incorreta <br>";
				?>

				<a href = "cadastro.php"> Cadastrar-se </a>
		</div>

	</body>

</html>
