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
				} else {
					return $result;
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

					if(mysqli_num_rows($result) > 0){
						$array = mysqli_fetch_assoc($result);
						$valor=$array['id'];
					}

			} catch (Exception $e) {

				print_r($e);

			}
			$this->desconectar();

			return $valor;


		}
		function returnCpfSql($query){

			$this->conectar();
			$valor = 0;
			try
			{

				$result = mysqli_query($this->connection, $query);

					if(mysqli_num_rows($result) > 0){
						$array = mysqli_fetch_assoc($result);
						$valor=$array['cpf'];
					}

			} catch (Exception $e) {

				print_r($e);

			}
			$this->desconectar();

			return $valor;


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
			if(!$con->exeSql("SELECT * FROM categoria where categoria = '$this->categoria'",true))
				$con->exeSql("insert into categoria(categoria) values('$this->categoria')");
			else
				echo "categoria ja existente<br>";

		}

		function getId(){
			$con = new conexaoDao();
			return $con->returnIdSql("select categoria.id from categoria where categoria = '$this->categoria'");
		}
	}

	class produto{
		private $id_categoria;
		private $bancoDao;
		private $categoria;
		function produto($categoria, $produto, $descricao, $imagem_produto, $preco, $quantidade){
			$this->bancoDao = new conexaoDao();
			$this->categoria = new categoria();
			$this->id_categoria = $this->categoria->getId();
			if ($this->getId($produto)==0) {
				$this->cadastrarProduto($this->id_categoria,$produto,$descricao,$imagem_produto,$preco,$quantidade);
			}
		}

		function cadastrarProduto($id_categoria,$produto,$descricao,$imagem_produto,$preco,$quantidade){
			$this->bancoDao->exeSql("INSERT INTO produto(id_categoria,produto,descricao,imagem_produto,preco,quantidade) VALUES ($id_categoria,'$produto','$descricao',$imagem_produto,$preco,$quantidade)");
		}

		function getId($produto){
			return $this->bancoDao->returnIdSql("SELECT produto.id from produto where produto='$produto'");
		}

	}

	class pedidoitens{
		private  $pedido;
		private  $bancoDao;
		private  $id_produto;
		private  $id_pedido;

		function pedidoitens($cpf_cliente, $produto, $quantidade, $valor)
		{
			$this->bancoDao = new conexaoDao();
			if ($this->getIdProduto($produto)!=0) {
				$this->pedido = new pedido($cpf_cliente);
				$this->id_produto = $this->getIdProduto($produto);
				$this->id_pedido = $this->pedido->getId();
				$this->cadastrarPedidoItens($this->id_produto, $this->id_pedido, $produto, $quantidade, $valor, $valor*$quantidade);
			}
		}

		function getIdProduto($produto){
			return $this->bancoDao->returnIdSql("select produto.id from produto where produto = '$produto'");
		}

		function cadastrarPedidoItens($id_produto, $id_pedido, $produto, $quantidade, $valor, $total){
			$this->bancoDao->exeSql("insert into pedidointes(id_produto, id_pedido, produto, quantidade, valor, total) values($id_produto, $id_pedido, '$produto', $quantidade, $valor, $total)");
		}
	}

	class pedido{
		private $cpf_cliente;
		private $momento;// = new DateTime();//da uma olhadinha aqui depois
		private $situacao;
		private $bancoDao;

		function pedido($cpf_cliente){
			$this->bancoDao = new conexaoDao();
			$this->cpf_cliente = $cpf_cliente;
			$this->situacao = "pendente";
			date_default_timezone_set('America/Sao_Paulo');
	  		$this->momento =  date('d/m/Y \à\s H:i:s');
			if(verificarCpf!=0)
			{
				$this->cadastrarPedido($this->cpf_cliente,$this->momento,$this->situacao);
			}
		}
		function getId(){
			return $this->bancoDao->returnIdSql("select pedido.id from pedido where cpf_cliente='$this->cpf_cliente'");
		}
		function verificarCpf($cpf_cliente){
			$comando = "select usuario.cpf from usuario where cpf= '$cpf_cliente' ";
			return $this->bancoDao->returnCpfSql($comando);
		}
		function cadastrarPedido($cpf_cliente,$momento,$situacao){
			$comando = "insert into pedido(cpf_cliente,momento,situacao) values('$cpf_cliente','$momento','$situacao')";
			$this->bancoDao->exeSql($comando);
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
		private  $feito=false;
		private  $endereco;
		private  $bancoDao;
		private  $veficador;

		function usuario( $cpf, $nome, $e_mail, $nome_usuario, $senha, $root,$estado,$cidade,$bairro)
		{
			$this->bancoDao = new conexaoDao();
			$this->verificador = new verificar();
			if($this->verificarUsuario($nome_usuario,$cpf)&&$this->verificador->validaCPF($cpf)){				
				$this->endereco = new endereco($estado,$cidade,$bairro);
				$this->cpf = $cpf;
				$this->id_endereco = $this->endereco->getId();
				$this->nome = $nome;
				$this->e_mail = $e_mail;
				$this->nome_usuario = $nome_usuario;
				$this->senha = $senha;
				$this->root = $root;
				$this->feito=true;
			}
		}

		function salvar(){// SE LEMBRAR DE MUDAR O NULL PARA O ID DO ENDEREÇO PROPRIAMENTE!!!!
			if($this->feito){
				$this->bancoDao->exeSql("insert into usuario(cpf,id_endereco,nome_cliente,e_mail,nome_usuario,senha,root) values('$this->cpf',$this->id_endereco,'$this->nome','$this->e_mail','$this->nome_usuario','$this->senha',$this->root)");
				return true;
			} else 
				return false;
		}

		function verificarUsuario($nome_usuario,$cpf){
			if($this->bancoDao->exeSql("select * from usuario where nome_usuario = '$nome_usuario'",true))
				return false;
			else if($this->bancoDao->exeSql("select * from usuario where cpf = '$cpf'",true))
				return false;
			else
				return true;
		}
	}

	class endereco{
		private  $id_bairro;
		private  $bairro;
		private  $bancoDao;

		function endereco($estado,$cidade,$bairro){
			$this->bancoDao = new conexaoDao();
			$this->bairro = new bairro($estado,$cidade,$bairro);
			$this->id_bairro = $this->bairro->getId();
			if($this->getId()==0){
				$this->cadastrarEndereco($this->id_bairro);
			}
		}

		function getId(){
			return $this->enviarId($this->id_bairro);
		}

		function enviarId($id_bairro){
				$comando = "select endereco.id from endereco where id_bairro= $id_bairro ";
				return $this->bancoDao->returnIdSql($comando);
		}

		function cadastrarEndereco($id_bairro){
			$comando = "insert into endereco (id_bairro) values('$id_bairro')";
			$this->bancoDao->exeSql($comando);
		}
	}

	class bairro{
		private $bairro;
		private $id_cidade;
		private $cidade;
		private  $bancoDao;

		function bairro($estado,$cidade,$bairro)
		{
			$this->bancoDao = new conexaoDao();
			$this->cidade = new cidade($estado,$cidade);
			$this->id_cidade = $this->cidade->getId();
			$this->bairro = $bairro;
			if($this->getId()==0){
				$this->cadastrarBairro($this->id_cidade);
			}

		}

		function getId(){
			return $this->enviarId($this->id_cidade);

		}

		function enviarId($id_cidade){
				$comando = "select bairro.id from bairro where bairro='$this->bairro' and id_cidade=$id_cidade";
				return $this->bancoDao->returnIdSql($comando);
		}

		function cadastrarBairro($id_cidade){
			$comando = "insert into bairro (id_cidade,bairro) values($id_cidade,'$this->bairro')";
			$this->bancoDao->exeSql($comando);
		}
	}

	class cidade{
		private  $id_estado;
		private  $cidade;
		private  $estado;
		private  $bancoDao;

		function cidade( $estado, $cidade){
			$this->bancoDao = new conexaoDao();
			$this->estado = new estado($estado);
			$this->id_estado = $this->estado->getId();
			$this->cidade = $cidade;
			if($this->getId()==0){
				$this->cadastrarCidade($this->id_estado);
			}
		}

		function getId(){
				return $this->enviarId($this->id_estado);
		}
		function enviarId($id_estado){
				$comando = "select cidade.id from cidade where cidade='$this->cidade' and id_estado=$id_estado";
				return $this->bancoDao->returnIdSql($comando);
		}

		function cadastrarCidade($id_estado){
			$comando = "insert into cidade (id_estado,cidade) values($id_estado,'$this->cidade')";
			$this->bancoDao->exeSql($comando);
		}

	}

	class estado{
		private  $estado;
		private  $bancoDao;

		function estado($estado)
		{
			$this->bancoDao = new conexaoDao();
			$this->estado = $estado;
			if($this->getId()==0)
			{
				$this->cadastrarEstado();
			}
		}

		function getId(){
			$comando = "select estado.id from estado where estado='$this->estado'";
			return $this->bancoDao->returnIdSql($comando);
		}

		function cadastrarEstado(){
			$comando = "insert into estado (estado) values('$this->estado')";
			$this->bancoDao->exeSql($comando);
		}
	}
	class verificar{
		function validaCPF($cpf = null) {

			// Verifica se um número foi informado
			if(empty($cpf)) {
				return false;
			}

			// Elimina possivel mascara
			$cpf = preg_replace("/[^0-9]/", "", $cpf);
			$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
			
			// Verifica se o numero de digitos informados é igual a 11 
			if (strlen($cpf) != 11) {
				return false;
			}
			// Verifica se nenhuma das sequências invalidas abaixo 
			// foi digitada. Caso afirmativo, retorna falso
			else if ($cpf == '00000000000' || 
				$cpf == '11111111111' || 
				$cpf == '22222222222' || 
				$cpf == '33333333333' || 
				$cpf == '44444444444' || 
				$cpf == '55555555555' || 
				$cpf == '66666666666' || 
				$cpf == '77777777777' || 
				$cpf == '88888888888' || 
				$cpf == '99999999999') {
				return false;
			 // Calcula os digitos verificadores para verificar se o
			 // CPF é válido
			 } else {   
				
				for ($t = 9; $t < 11; $t++) {
					
					for ($d = 0, $c = 0; $c < $t; $c++) {
						$d += $cpf{$c} * (($t + 1) - $c);
					}
					$d = ((10 * $d) % 11) % 10;
					if ($cpf{$c} != $d) {
						return false;
					}
				}

				return true;
			}
		}
	}
?>
