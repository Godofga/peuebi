<!DOCTYPE html>
<html>

	<head>

		<title> Alteração de status - Prata Shop</title>
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

    		if(!checkRoot())
    			header('location:main.php');


        else if(isset($_POST['pedido']) && isset($_POST['estado'])){

          $con = new conexaoDao();
					$id = $_POST['pedido'];
					$status = $_POST['estado'];
					if($con->exeSql("select * from pedido where id = $id",true)){
						$con->exeSql("update pedido set situacao = '$status' where id = $id");
          	echo 'Feito!<br/>';
					}
					else {
						echo 'Id não existente!<br/>';
					}

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
				$resultado =$con->exeSql($query);
				if($con->exeSql($query,true)){
					while($row = $resultado->fetch_assoc()){
						echo "<tr><td>". $row["id"]."</td><td>".$row["cpf_cliente"]."</td><td>".$row["momento"]."</td><td>".$row["situacao"]."</td></tr>";
					}

				}

			 ?>
		</table>

		<div>
			<form action = "status.php" method="POST">
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
