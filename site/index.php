<!DOCTYPE html>
<html>

	<head>

		<title> Prata shop </title>
		<meta charset="utf-8" name='viewport' content='width-device-width, initial-scale-1.0'/>
		<link href='css/bootstrap.min.css' rel ='stylesheet' type='text/css'/>
		<link rel ='stylesheet' type='text/css' href='css/form.css'>
		<script type= 'text/javascript' src='js/jquery-3.4.1.min.js'></script>
		<script type= 'text/javascript' src='js/bootstrap.min.js'></script>

		<?php

			session_start();

			if(isset($_SESSION['usuario']) && isset($_SESSION['senha']))
			  header('location:main.php');

		?>

	</head>

	<body>

		<section class = "container-fluid">
			<section class= "row justify-content-center">
					<form class='form-container' action="login.php?do=true" method="POST">
					  <div class="form-group">
					    <label for="user">Usuário</label>
					    <input type="text" class="form-control" id="user" name="usuario" placeholder="Nome de usuário">
					  </div>
					  <div class="form-group">
					    <label for="senha">Senha</label>
					    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
					  </div>
						<?php
							if(isset($_GET['log']) && $_GET['log'])
								echo "
									<div class='alert alert-danger' role='alert'>
									  Usuário ou senha incorreta!
									</div>";
						?>

					  <button type="submit" class="btn btn-outline-dark btn-block">Realizar login</button><br>
						<a href = "cadastro.php" class="alert-link" id="cadastroLink"> Cadastrar-se </a>
					</form>
				</section>
		</section>

	</body>

</html>
