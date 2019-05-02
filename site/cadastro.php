<!DOCTYPE html>
<html>

	<head>

		<title> Cadastro - Prata Shop</title>
		<meta charset="utf-8" name='viewport' content='width-device-width, initial-scale-1.0'/>
		<link href='css/bootstrap.min.css' rel ='stylesheet' type='text/css'/>
		<link rel ='stylesheet' type='text/css' href='css/formcad.css'>
		<script type= 'text/javascript' src='js/jquery-3.4.1.min.js'></script>
		<script type= 'text/javascript' src='js/bootstrap.min.js'></script>



	</head>

	<body>


		<section class = "container-fluid">
			<section class= "row justify-content-center">
					<form class='form-container' action="cadastro.php" method="POST">
					  <div class="form-group">
					    <label for="nome">Nome</label>
					    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do indivíduo">
					  </div>
						<div class="form-group">
					    <label for="usuario">Usuário</label>
					    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nome de usuário">
					  </div>
						<div class="form-group">
					    <label for="senha">Senha</label>
					    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
					  </div>
						<div class="form-group">
					    <label for="e_mail">Email</label>
					    <input type="email" class="form-control" id="e_mail" name="email" placeholder="E-mail">
					  </div>
						<div class="form-group">
					    <label for="cpf">CPF</label>
					    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF do indivíduo">
					  </div>
						<div class="form-group">
					    <label for="estado">Estado</label>
					    <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado">
					  </div>
						<div class="form-group">
					    <label for="cidade">Cidade</label>
					    <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade">
					  </div>
						<div class="form-group">
					    <label for="bairro">Bairro</label>
					    <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
					  </div>

						<?php
				      require 'conexao.php';

				        if(isset($_POST['nome'])&&isset($_POST['usuario'])&&isset($_POST['senha'])&&isset($_POST['email'])&&isset($_POST['cpf'])&&isset($_POST['cidade'])&&isset($_POST['estado'])&&isset($_POST['bairro'])){

				          $user = new usuario($_POST['cpf'],$_POST['nome'],$_POST['email'],$_POST['usuario'],$_POST['senha'],0,$_POST['estado'],$_POST['cidade'],$_POST['bairro']);
				          if($user->salvar())
				          	echo "
											<div class='alert alert-success' role='alert'>
											  Cadastro concluído!
											</div>";
				          else
				          	echo "
											<div class='alert alert-warning' role='alert'>
											  Algo de errado ocorreu!
											</div>";

				        }

				    ?>

					  <button type="submit" class="btn btn-outline-dark btn-block">Cadastrar-se</button><br>
						<a href = "index.php" class="alert-link" id="cadastroLink"> Voltar à tela de login </a>
					</form>
				</section>
		</section>


	</body>

</html>
