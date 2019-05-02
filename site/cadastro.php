<!DOCTYPE html>
<html>

	<head>

		<title> Cadastro - Prata Shop</title>
		<meta charset="utf-8" name='viewport' content='width-device-width, initial-scale-1.0'/>
		<link href='css/bootstrap.min.css' rel ='stylesheet' type='text/css'/>
		<script type= 'text/javascript' src='js/jquery-3.4.1.min.js'></script>
		<script type= 'text/javascript' src='js/bootstrap.min.js'></script>

    <?php
      require 'conexao.php';

        if(isset($_POST['nome'])&&isset($_POST['usuario'])&&isset($_POST['senha'])&&isset($_POST['email'])&&isset($_POST['cpf'])&&isset($_POST['cidade'])&&isset($_POST['estado'])&&isset($_POST['bairro'])){

          $user = new usuario($_POST['cpf'],$_POST['nome'],$_POST['email'],$_POST['usuario'],$_POST['senha'],0,$_POST['estado'],$_POST['cidade'],$_POST['bairro']);
          if($user->salvar())
          	echo 'Feito!<br>';
          else
          	echo "Não feito";

        }

    ?>

	</head>

	<body>

		<div>
			<form action = "cadastro.php" method="POST">

        		Nome:<br/>
				<input type="text" name="nome"></input><br/>
				Usuário:<br/>
				<input type="text" name="usuario"></input><br/>
				Senha:<br/>
				<input type="password" name="senha"></input><br/>
        		E-mail:<br/>
				<input type="email" name="email"></input><br/>
    		    CPF:<br/>
				<input type="text" name="cpf"></input><br/>
				Estado:<br/>
				<input type="text" name= "estado"></input><br/>
    		    Cidade:<br/>
				<input type="text" name="cidade"></input><br/>
				Bairro:<br/>
				<input type="text" name="bairro"></input><br/>

				<input type="submit" value= "Realizar cadastro"/><br/>
			</form>

				<a href = "index.php"> Voltar à tela de login </a>
		</div>

	</body>

</html>
