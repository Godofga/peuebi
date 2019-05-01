<!DOCTYPE html>
<html>

	<head>

		<title> Alteração de status - Prata Shop</title>
		<meta charset="utf-8"/>

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

		<table>
			<tr>
				<th>ID</th>
				<th>CPF</th>
				<th>MOMENTO</th>
				<th>SITUAÇÃO</th>
			</tr>
			<?php

				$con = new conexaoDao();
				$query = "SELECT * from pedidoitens inner ";
				$resultado =$con->exeSql($query);
				if($con->exeSql($query,true)){
					while($row = $resultado->fetch_assoc()){
						echo "<tr><td>". $row["id"]."</td><td>".$row["cpf_cliente"]."</td><td>".$row["momento"]."</td><td>".$row["situacao"]."</td></tr>";
					}

				}

			 ?>
		</table>

		<div>


				<a href = "main.php"> Voltar à tela inicial </a>
		</div>

	</body>

</html>
