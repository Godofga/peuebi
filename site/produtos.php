<!DOCTYPE html>
<html>

	<head>

		<title> Visualização de produtos - Prata Shop</title>
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

		<table>
			<tr>
				<th>CATEGORIA</br></th>
				<th>NOME</th>
				<th>DESCRICAO</th>
				<th>IMAGEM</th>
				<th>PREÇO</th>
				<th>QUANTIDADE EM ESTOQUE</th>
			</tr>
			<?php

				$con = new conexaoDao();
				$query = "SELECT produto.*, categoria.categoria from produto inner join categoria on (categoria.id=produto.id_categoria)";
				$resultado =$con->exeSql($query);
				if($con->exeSql($query,true)){
					while($row = $resultado->fetch_assoc()){
						$aux = "imagens/".$row["imagem_produto"];
						$id = $row["id"];
						echo "<tr><td>". $row["categoria"]."</td><td>".$row["produto"]."</td><td>".$row["descricao"]."</td><td>"."<a href='compras.php?id=$id'>"."<img src='$aux' alt='é para aparecer' height='100' width='100'>"."</a>"."</td><td>". $row["preco"]."</td><td>".$row["quantidade"]."</td></tr>";
					}

				}

			 ?>
		</table>

		<div>


				<a href = "main.php"> Voltar à tela inicial </a>
		</div>

	</body>

</html>
