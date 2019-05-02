<!DOCTYPE html>
<html>

	<head>

		<title> Visualização de produtos - Prata Shop</title>
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
				<th>CATEGORIA</th>
				<th>NOME</th>
				<th>DESCRICAO</th>
				<th>IMAGEM</th>
				<th>PREÇO</th>
				<th>QUANTIDADE EM ESTOQUE</th>
			</tr>
			<?php

				$con = new conexaoDao();
				$query = "SELECT * from produto inner join categoria on (categoria.id=produto.id_categoria)";
				$resultado =$con->exeSql($query);
				if($con->exeSql($query,true)){
					while($row = $resultado->fetch_assoc()){
						$aux = $row[`imagem_produto`];
						echo "<tr><td>". $row["categoria"]."</td><td>".$row["nome"]."</td><td>".$row["descricao"]."</td><td>".`<img src="$aux">`."</td onclick='compras.php?id=$row["id"]'><td>". $row["preco"]."</td><td>".$row["quantidade"]."</td></tr>";
					}

				}

			 ?>
		</table>

		<div>


				<a href = "main.php"> Voltar à tela inicial </a>
		</div>

	</body>

</html>
