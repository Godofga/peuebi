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
				<th>CPF</th>
				<th>MOMENTO</th>
				<th>SITUAÇÃO</th>
			</tr>
			<?php
				$con = new conexaoDao();
				$query = "SELECT * from pedido";
				if($con->exeSql($query,true)){
					while($row = $con->exeSql($query)->fetch_assoc()){
						echo "<tr><td>". $row["id"]."</td><td>".$row["cpf_cliente"]."</td><td>".$row["momento"]."</td><td>".$row["situacao"]."</td></tr>";
					}

				}

			 ?>
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
