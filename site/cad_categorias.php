<!DOCTYPE html>
<html>

	<head>

		<title> Cadastro de categorias - Prata Shop</title>
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


      else  if(isset($_POST['categoria'])){

          $categ = new categoria($_POST['categoria']);
          $categ->salvar();
          echo 'Feito!<br>';

        }

    ?>

	</head>

	<body>

		<div>
			<form action = "cad_categorias.php" method="POST">
				Categoria:<br/>
				<input type="text" name="categoria"></input><br/>

				<input type="submit" value= "Realizar cadastro da categoria"/><br/>
			</form>

				<a href = "main.php"> Voltar à tela inicial </a>
		</div>

	</body>

</html>
