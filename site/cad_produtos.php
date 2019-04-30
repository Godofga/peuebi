<!DOCTYPE html>
<html>

	<head>

		<title> Cadastro de produtos - Prata Shop</title>
		<meta charset="utf-8"/>

    <?php
      require 'conexao.php';

        if(isset($_POST['categoria'])){
          $categ = new categoria($_POST['categoria']);
          $categ->salvar();
          echo 'Feito!<br>';
        }

    ?>

	</head>

	<body>

		<div>
			<form action = "cad_produtos.php" method="POST">
				Categoria:<br/>
				<input type="text" name="categoria"></input><br/>
				Nome:<br/>
				<input type="text" name="nome"></input><br/>
				Descricao:
				<input type="text" name="descricao"></input><br/>
				Link da imagem:
				<input type="file" name="imagem"></input><br/>
				Preco:
				<input type="number" name="preco"></input><br/>
				Quantidade:
				<input type="number" name="quantidade"></input><br/>
				<input type="submit" value= "Realizar cadastro da categoria"/><br/>
			</form>

				<a href = "index.php"> Voltar à tela de login </a>
		</div>

	</body>

</html>
