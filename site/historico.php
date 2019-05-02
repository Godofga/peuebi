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
				$query = "SELECT pedido.situacao, pedido.momento, pedidoitens.produto, pedidoitens.quantidade, pedidoitens.valor, pedidoitens.total from pedidoitens inner join pedido on(pedido.id=pedidoitens.id_pedido) inner join usuario on(pedido.cpf_cliente=usuario.cpf) where usuario.nome_usuario = '$_SESSION['usuario']'";
				$resultado =$con->exeSql($query);
				if($con->exeSql($query,true)){
					while($row = $resultado->fetch_assoc()){
						echo "<tr><td>". $row["situacao"]."</td><td>".$row["momento"]."</td><td>".$row["produto"]."</td><td>". $row["quantidade"]."</td><td>". $row["valor"]."</td><td>".$row["total"]."</td></tr>";
					}

				}

			 ?>
		</table>

		<div>


				<a href = "main.php"> Voltar à tela inicial </a>
		</div>

	</body>

</html>
