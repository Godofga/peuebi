<!DOCTYPE html>
<html>

	<head>

		<title> Cadastro de produtos - Prata Shop</title>
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

		<div>
      <form action ="<?php echo "cadastro.php?id=$_POST['id']"; ?>" method="POST">

        Quantidade:<br/>
				<input type="number" name="quantidade" value="digite a quantidade de itens"></input><br/>
				<input type="submit" value= "Realizar cadastro"/><br/>
			</form>
      <?php

        $con = new conexaoDao();
        $query = "SELECT * from produto inner join categoria on (categoria.id=produto.id_categoria) where produto.id = $_POST['id']";
        $resultado =$con->exeSql($query);
        if($con->exeSql($query,true)){
          while($row = $resultado->fetch_assoc()){
            $aux = $row[`imagem_produto`];
            echo "<tr><td>". $row["categoria"]."</td><td>".$row["nome"]."</td><td>".$row["descricao"]."</td><td>".`<img src="$aux" onclick='compras.php'>`."</td><td>". $row["preco"]."</td><td>".$row["total"]."</td></tr>";
          }

        }

       ?>
     </div>

				<a href = "main.php"> Voltar à tela inicial </a>
		</div>

	</body>

</html>
