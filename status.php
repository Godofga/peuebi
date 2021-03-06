<!DOCTYPE html>
<html>

	<head>

		<title> Alteração de status - Prata Shop</title>
		<meta charset="utf-8" name='viewport' content='width-device-width, initial-scale-1.0'/>
		<link href='css/bootstrap.min.css' rel ='stylesheet' type='text/css'/>

		<link rel ='stylesheet' type='text/css' href='css/formopt.css'>
		<script type= 'text/javascript' src='js/jquery-3.4.1.min.js'></script>
		<script type= 'text/javascript' src='js/bootstrap.min.js'></script>

    <?php
      	require 'login.php';

				if(!isset($_SESSION))
	    	{
	        	session_start();
	    	}

      	checkLogin();

    		if(!checkRoot()){
    			header('location:main.php');
				} else if(isset($_POST['pedido']) && isset($_POST['gender'])){

						$con = new conexaoDao();
						$id = $_POST['pedido'];
						$status = $_POST['gender'];
						if($_POST['gender']!="Negado"){
							$quant1;
							$quant2;
							$ide;
							$queri = "select produto.id,produto.quantidade, pedidoitens.quantidade 'arroz' from pedido inner join pedidoitens on (pedido.id = pedidoitens.id_pedido)
								inner join produto on(produto.id = pedidoitens.id_produto) where pedido.id = $id";
							$resultado =$con->exeSql($queri);
							if($con->exeSql($queri,true)){
								while($row = $resultado->fetch_assoc()){
									$quant1 = $row["quantidade"];
									$quant2 = $row["arroz"];
									$ide = $row["id"];
								}
							}
							if($quant1>=$quant2){
								if($con->exeSql("select * from pedido where id = $id",true)){
									$total = $quant1-$quant2;
									$con->exeSql("update pedido set situacao = '$status' where id = $id");
									$con->exeSql("update produto set quantidade = $total where id = $ide");
									echo "
										<div class='alert alert-success' role='alert'>
											Mudança efetuada!
										</div>";
								}
								else {
									echo "
										<div class='alert alert-warning' role='alert'>
											O id não existe!
										</div>";
								}
							} else
							echo "
								<div class='alert alert-warning' role='alert'>
									Quantidade limite ultrapassada!
								</div>";
							} else
							if($con->exeSql("select * from pedido where id = $id",true)){
								$con->exeSql("update pedido set situacao = '$status' where id = $id");
								echo "
									<div class='alert alert-success' role='alert'>
										Mudança efetuada!
									</div>";
							}
					}


    ?>

	</head>

	<body>

		<section class = "container-fluid">
			<section class= "row justify-content-center">

				<table class="table table-hover" >

					<tr>
						<th>ID</th>
						<th>CPF</th>
						<th>MOMENTO</th>
						<th>SITUAÇÃO</th>
					</tr>
					<?php

						$con = new conexaoDao();
						$query = "SELECT * from pedido where situacao = 'pendente'";
						$resultado =$con->exeSql($query);
						if($con->exeSql($query,true)){
							while($row = $resultado->fetch_assoc()){
								echo "<tr><td>". $row["id"]."</td><td>".$row["cpf_cliente"]."</td><td>".$row["momento"]."</td><td>".$row["situacao"]."</td></tr>";
							}

						}

					 ?>
				</table>
				</section>
		</section>

		<section class = "container-fluid">
			<section class= "row justify-content-center">
					<form class='form-container' action = "status.php" method="POST">
						<div class="form-group">
							<label for="pedido">Id do pedido</label>
							<input type="number" class="form-control" id="pedido" name="pedido" placeholder="Id do pedido para alteração">
						</div>
						<div class="btn-group btn-group-toggle" data-toggle="buttons">
						  <label class="btn btn-secondary">
						    <input type="radio" name="gender" id="option1" autocomplete="off" value = "Aprovado"> Aprovar
						  </label>
						  <label class="btn btn-secondary">
						    <input type="radio" name="gender" id="option2" autocomplete="off" value = "Negado"> Negativar
						  </label>
						</div>
						<br>
						<br>
						
						<button type="submit" class="btn btn-outline-dark btn-block">Realizar alteração</button><br>
						<a href = "main.php" class="alert-link" id="cadastroLink"> Retornar à tela inicial </a>
					</form>
				</section>
		</section>
	</body>

</html>
