<!DOCTYPE html>
<html>

	<head>

		<title> Alteração de status - Prata Shop</title>
		<meta charset="utf-8"/>

    <?php
      	require 'login.php';

      	session_start();

      	checkLogin();

    		if(!checkRoot())
    			header('location:main.php');


        else if(isset($_POST['pedido'])){

          $categ = new categoria($_POST['categoria']);
          $categ->salvar();
          echo 'Feito!<br>';

        }

    ?>

	</head>

	<body>

		<table>
			<tr>

			<th>ID</th>
		</tr>
		</table>

		<div>
			<form action = "cad_categorias.php" method="POST">
				Id do pedido para alteração:<br/>
				<input type="number" name="pedido"></input><br/>
        Novo estado do pedido:<br/>
				<input type="text" name="estado"></input><br/>

				<input type="submit" value= "Realizar alteração"/><br/>
			</form>

				<a href = "main.php"> Voltar à tela inicial </a>
		</div>

	</body>

</html>
