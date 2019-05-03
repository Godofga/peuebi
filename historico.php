<!DOCTYPE html>
<html>

	<head>

		<title> Histórico - Prata Shop</title>
		<meta charset="utf-8" name='viewport' content='width-device-width, initial-scale-1.0'/>
		<link href='css/bootstrap.min.css' rel ='stylesheet' type='text/css'/>

		<link rel ='stylesheet' type='text/css' href='css/form.css'>
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


		<section class = "container-fluid">
			<section class= "row justify-content-center">

				<table class="table table-hover" >

					<tr>
						<th>SITUAÇÃO</th>
						<th>MOMENTO</th>
						<th>PRODUTO</th>
						<th>QUANTIDADE</th>
						<th>VALOR</th>
						<th>TOTAL</th>
					</tr>
						<?php

							$con = new conexaoDao();
							$usuario = $_SESSION["usuario"];
							$query = "SELECT pedido.situacao, pedido.momento, pedidoitens.produto, pedidoitens.quantidade, pedidoitens.valor, pedidoitens.total from pedidoitens inner join pedido on(pedido.id=pedidoitens.id_pedido) inner join usuario on(pedido.cpf_cliente=usuario.cpf) where usuario.nome_usuario = '$usuario'";
							$resultado =$con->exeSql($query);
							if($con->exeSql($query,true)){
								while($row = $resultado->fetch_assoc()){
									echo "<tr><td>". $row["situacao"]."</td><td>".$row["momento"]."</td><td>".$row["produto"]."</td><td>". $row["quantidade"]."</td><td>". $row["valor"]."</td><td>".$row["total"]."</td></tr>";
								}

							}

						 ?>
					</table>
						<a href = "main.php" class="alert-link" id="cadastroLinkblack"> Voltar à tela inicial </a>
				</section>
		</section>

	</body>

</html>
