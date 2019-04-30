<?php
	class conexaoDao{
		public $found;
		private $servidor;
		private $database;
		private $senha;
		private $usuario;
		private $connection;

		function conexaoDao(){
			$this->servidor = "localhost";
			$this->senha = "";
			$this->usuario = "root";
			$this->database = "alencar";
		}

		function conectar(){
			try
			{

				$this->connection = mysqli_connect($this->servidor,$this->usuario,$this->senha,$this->database);

			} catch (Exception $e) {

				print_r($e);

			}

		}

		function desconectar(){
			try
			{

				mysqli_close($this->connection);

			} catch (Exception $e) {

				print_r($e);

			}
		}

		function exeSql($query, $res=false){

			$this->conectar();
			$this->found = false;

			try
			{

				$result = mysqli_query($this->connection, $query);

				if($res)
					if(mysqli_num_rows($result) > 0){
						$this->found = true;
					}

			} catch (Exception $e) {

				print_r($e);

			}

			$this->desconectar();

		}

		function returnIdSql($query){

			$this->conectar();
			$valor = 0;
			try
			{

				$result = mysqli_query($this->connection, $query);

				if($res)
					if(mysqli_num_rows($result) > 0){
						$valor=$result['id'];
					}

			} catch (Exception $e) {

				print_r($e);

			}
			$this->desconectar();

			return $valor;


		}

		function check($query){

		}


	}

	class categoria{
		private $id;
		private $categoria;

		function categoria($id , $categoria){
			$this->id = $id;
			$this->categoria = $categoria;
		}
	}

	class produto{
		private $id;
		private $id_categoria;
		private $produto;
		private $descricao;
		private $imagem_produto;
		private $preco;
		private $quantidade;

		function produto($id, $id_categoria, $produto, $descricao, $imagem_produto, $preco, $quantidade){
			$this->id = $id;
			$this->id_categoria = $id_categoria;
			$this->produto = $produto;
			$this->descricao = $descricao;
			$this->imagem_produto = $imagem_produto;
			$this->preco = $preco;
			$this->quantidade = $quantidade;
		}

	}

	class pedidoitens{
		private  $id;
		private  $id_produto;
		private  $id_pedido;
		private  $produto;
		private  $quantidade;
		private  $valor;
		private  $total;

		function pedidoitens( $id, $id_produto, $id_pedido, $produto, $quantidade, $valor, $total)
		{
			$this->id = $id;
			$this->id_categoria = $id_categoria;
			$this->produto = $produto;
			$this->descricao = $descricao;
			$this->imagem_produto = $imagem_produto;
			$this->preco = $preco;
			$this->quantidade = $quantidade;
		}
	}

	class pedido{
		private $id;
		private $cpf_cliente;
		private $momento;// = new DateTime();//da uma olhadinha aqui depois
		private  $situacao;

		function pedido( $id,  $cpf_cliente, $momento,  $situacao){
			$this->id = $id;
			$this->cpf_cliente = $cpf_cliente;
			$this->momento = $momento;
			$this->situacao = $situacao;
		}
	}

	class usuario{
		private  $cpf;
		private  $id_endereco;
		private  $nome;
		private  $e_mail;
		private  $nome_usuario;
		private  $senha;
		private  $root;

		function usuario( $cpf, $id_endereco, $nome, $e_mail, $nome_usuario, $senha, $root)
		{
			$this->cpf = $cpf;
			$this->id_endereco = $id_endereco;
			$this->nome = $nome;
			$this->e_mail = $e_mail;
			$this->nome_usuario = $nome_usuario;
			$this->senha = $senha;
			$this->root = $root;
		}

		function salvar(){// SE LEMBRAR DE MUDAR O NULL PARA O ID DO ENDEREÇO PROPRIAMENTE!!!!
			$con = new conexaoDao();
			$con->exeSql("insert into usuario(cpf,id_endereco,nome_cliente,e_mail,nome_usuario,senha,root) values('$this->cpf',			null     ,'$this->nome','$this->e_mail','$this->nome_usuario','$this->senha',$this->root)");

		}

	}

	class endereco{
		private  $id;
		private  $id_bairro;

		function endereco( $id, $id_bairro){
			$this->id = $id;
			$this->id_bairro = $id_bairro;
		}
	}

	class bairro{
		private  $id;
		private  $id_cidade;
		private  $bairro;

		function bairro( $id, $id_cidade, $bairro)
		{
			$this->id = $id;
			$this->id_cidade = $id_cidade;
			$this->id_bairro = $id_bairro;
		}
	}

	class cidade{
		private  $id;
		private  $id_estado;
		private  $cidade;

		function cidade( $id, $id_estado, $cidade){
			$this->id = $id;
			$this->id_estado = $id_estado;
			$this->cidade = $cidade;

		}
	}

	class estado{
		private  $estado;
		private  $bancoDao = new conexaoDao();

		function estado($estado)
		{			
			$this->estado = $estado;
			if($this->getId==0)
			{				
				$this->cadastrarCidade();
			}
		}

		function getId(){
			$comando = "select estado.id from estado where estado='$estado'"
			$this->bancoDao.returnIdSql($comando);
			return $id;
		}

		function cadastrarCidade(){
			$comando = "insert into categoria (categoria) values($estado)";
			$this->bancoDao.exeSql($comando);
		}
	}




?>
