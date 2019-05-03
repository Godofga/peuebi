<!DOCTYPE html>
<html>

	<head>

		<title> Compra de produtos - Prata Shop</title>
		<meta charset="utf-8" name='viewport' content='width-device-width, initial-scale-1.0'/>
		<link href='css/bootstrap.min.css' rel ='stylesheet' type='text/css'/>
		<link rel ='stylesheet' type='text/css' href='css/formmenu.css'>
		<script type= 'text/javascript' src='js/jquery-3.4.1.min.js'></script>
		<script type= 'text/javascript' src='js/bootstrap.min.js'></script>

    <?php
      	require 'login.php';

      	if(!isset($_SESSION))
    	   {
        	session_start();
    	   }
				 checkLogin();
        if(!isset($_GET["id"]))
        {
          header('location:produtos.php');
        }

    ?>

	</head>

	<body>
				<section class = "container-fluid">
					<section class= "row justify-content-center">
							<form class='form-container' action="compras.php?id=<?php echo $_GET["id"]?>" method="POST">
								<div class="form-group">
									<label for="quantidade">Quantidade</label>
									<input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="Unidades do produtos">
								</div>


								<?php
									if(isset($_GET["id"])&&isset($_POST['quantidade'])){
											$produtos = new pedidoitens($_SESSION["usuario"],$_POST["quantidade"],$_GET["id"]);
											if($produtos->cadastrarPedidoItens())
												echo "
													<div class='alert alert-success' role='alert'>
														Pedido efetuado!
													</div>";
											else
												echo "
													<div class='alert alert-warning' role='alert'>
														Tente outro valor
													</div>";
									}

								?>

								<button type="submit" class="btn btn-outline-dark btn-block">Realizar compra</button><br>
								<a href = "main.php" class="alert-link" id="cadastroLink"> Voltar à tela inicial </a>
							</form>
						</section>
				</section>

	</body>

</html>
