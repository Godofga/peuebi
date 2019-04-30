<?php
	class conexaoDao{
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

			try
			{

				$result = mysqli_query($this->connection, $query);

				if($res){
					
					if(mysqli_num_rows($result) > 0)
						return true;
					else
					return false;
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

		function categoria($categoria){
			$this->categoria = $categoria;
		}

		function salvar(){
			$con = new conexaoDao();
			$con->exeSql("insert into categoria(categoria) values('$this->categoria')");

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
		private  $id_bairro;
		private  $bairro;

		function endereco($estado,$cidade,$bairro){
			$this->bairro = new bairro($estado,$cidade,$bairro);
			$this->id_bairro = $this->bairro.getId();
			if($this->get_id()==0){
				$this->cadastrarEndereco();
			}
		}

		function getId($id_bairro=null){
			if($id_bairro){
				$comando = "select endereco.id from bairro where id_bairro=$this->id_bairro";
				return $this->bancoDao.returnIdSql($comando);
			} else
				$this->getId($this->id_bairro);
		}

		function cadastrarEndereco($id_bairro){
			$comando = "insert into endereco (id_bairro) values($this->bairro)";
			$this->bancoDao.exeSql($comando);
		}
	}

	class bairro{
		private $bairro;
		private $id_cidade;
		private $cidade;

		function bairro($estado,$cidade,$bairro)
		{
			$this->cidade = new cidade($estado,$cidade);
			$this->id_cidade = $this->cidade.getId();
			$this->bairro = $bairro;
			if($this->getId()==0){
				$this->cadastrarBairro($this->id_cidade);
			}

		}

		function getId($id_cidade=null){
			if($id_cidade){
				$comando = "select bairro.id from bairro where bairro=$this->bairro and id_cidade=$id_cidade";
				return $this->bancoDao.returnIdSql($comando);
			} else
				$this->getId($this->id_cidade);	
		}

		function cadastrarBairro($id_cidade){
			$comando = "insert into bairro (id_cidade,bairro) values($id_cidade,$this->bairro)";
			$this->bancoDao.exeSql($comando);
		}
	}

	class cidade{
		private  $id_estado;
		private  $cidade;
		private  $estado;

		function cidade( $estado, $cidade){
			$this->estado = new estado($estado);
			$this->id_estado = $this->estado.getId();
			$this->cidade = $cidade;
			if($this->getId()){
				$this->cadastrarCidade($id_estado);
			}
		}

		function getId($id_estado=null){
			if($id_estado){
				$comando = "select cidade.id from cidade where cidade=$this->cidade and id_estado=$id_estado";
				return $this->bancoDao.returnIdSql($comando);
			} else 
				$this->getId($this->id_estado);
		}

		function cadastrarCidade($id_estado){
			$comando = "insert into cidade (id_estado,cidade) values($id_estado,$this->cidade)";
			$this->bancoDao.exeSql($comando);
		}

	}

	class estado{
		private  $estado;
		private  $bancoDao = new conexaoDao();

		function estado($estado)
		{			
			$this->estado = $estado;
			if($this->getId()==0)
			{				
				$this->cadastrarEstado();
			}
		}

		function getId(){
			$comando = "select estado.id from estado where estado=$this->estado";
			return $this->bancoDao.returnIdSql($comando);
		}

		function cadastrarEstado(){
			$comando = "insert into estado (estado) values($estado)";
			$this->bancoDao.exeSql($comando);
		}
	}




?>
