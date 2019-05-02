<!DOCTYPE html>
<html>

	<head>

		<title> Compra de produtos - Prata Shop</title>
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
        if(!isset($_GET["id"]))
        {
          header('location:produtos.php');
        } else{
          echo $_GET['id'];
          echo $_SESSION['usuario'];
        }

      	checkLogin();

    ?>

	</head>

	<body>

     </div>
        <form action="compras.php?id=<?php echo $_GET["id"]?>" method="POST">

          Quantidade:<br/>
          <input type="number" name="quantidade"></input><br/>
          <input type="submit" value= "Realizar compra"/><br/>
        </form>

        <?php
          if(isset($_GET['log']) && $_GET['log'])
            echo "Usuário ou senha incorreta <br>";
        ?>
				<a href = "main.php"> Voltar à tela inicial </a>
		</div>

	</body>

</html>
