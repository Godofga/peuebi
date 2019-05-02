<!DOCTYPE html>
<html>

	<head>

		<title> Cadastro de produtos - Prata Shop</title>
		<meta charset="utf-8" name='viewport' content='width-device-width, initial-scale-1.0'/>
		<link href='css/bootstrap.min.css' rel ='stylesheet' type='text/css'/>
		<script type= 'text/javascript' src='js/jquery-3.4.1.min.js'></script>
		<script type= 'text/javascript' src='js/bootstrap.min.js'></script>

    <?php
      	require 'login.php';

      	if(!isset($_SESSION))
    	{
        	session_start();
    	}

      	checkLogin();
    ?>

	</head>

	<body>

		<div>
			<form action = "cad_produtos.php" method="POST" >
				<?php
					echo "<img src='imagens/pequeno.jpg' height='250' width='250'  alt='oie'>";
				?>
				<br/><input type="submit" value= "Vamos pensar um pouco"/><br/>
			</form>

				<a href = "main.php"> Voltar à tela inicial </a>
		</div>

	</body>

</html>
