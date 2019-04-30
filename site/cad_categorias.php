<!DOCTYPE html>
<html>

	<head>

		<title> Cadastro de categorias - Prata Shop</title>
		<meta charset="utf-8"/>

    <?php
      	require 'login.php';

      	session_start();

      	checkLogin();

		if(!checkUser(true))
			header('location:main.php');


        if(isset($_POST['categoria'])){

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

				<a href = "index.php"> Voltar à tela de login </a>
		</div>

	</body>

</html>
