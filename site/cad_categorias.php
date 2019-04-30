<!DOCTYPE html>
<html>

	<head>

		<title> Cadastro - Prata Shop</title>
		<meta charset="utf-8"/>

    <?php
      require 'conexao.php';

        if(isset($_POST['categoria'])){
          $categ = new categoria($_POST['categoria']);
          $categ->salvar();
          echo 'Cadastrado com sucesso!<br>';
        }

    ?>

	</head>

	<body>

		<div>
			<form action = "cad_categorias.php" method="POST">
				Categoria:<br/>
				<input type="text" name="categoria"></input><br/>

				<input type="submit" value= "Realizar cadastro da categoria"/><br/>
			</form>

				<a href = "index.php"> Voltar à tela de login </a>
		</div>

	</body>

</html>
