<!DOCTYPE html>
<html>

	<head>

		<title> Cadastro - Prata Shop</title>
		<meta charset="utf-8"/>

    <?php
      require 'conexao.php';

        if(isset($_POST['nome'])&&isset($_POST['usuario'])&&isset($_POST['senha'])&&isset($_POST['email'])&&isset($_POST['cpf'])&&isset($_POST['endereco'])){
          $user = new usuario($_POST['cpf'],$_POST['endereco'],$_POST['nome'],$_POST['email'],$_POST['usuario'],$_POST['senha'],0);
          $user->salvar();
          echo 'Cadastrado com sucesso!<br>';
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
        Id do endereço:<br/>
				<input type="text" name="endereco"></input><br/>

				<input type="submit" value= "Realizar cadastro"/><br/>
			</form>

				<a href = "index.php"> Voltar à tela de login </a>
		</div>

	</body>

</html>
