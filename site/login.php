<?php

  require "conexao.php";

  session_start();

  function login(){


    if(!isset($_POST['usuario'])||!isset($_POST['senha']))
    {
      unsetSession();
      header('location:index.php');
    }

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    if(checkUser($usuario,$senha)) {

      $_SESSION['usuario'] = $usuario;
      $_SESSION['senha'] = $senha;

      header('location:main.php');

    } else {

      unsetSession();-
      header('location:index.php?log=false');

    }
  }

  function checkLogin(){

    if(!isset($_SESSION['usuario']) || !isset($_SESSION['senha']))
      exitSession();

  }

  function exitSession(){

    unsetSession();
    header('location:index.php');

  }

  function checkUser($usuario, $senha, $checkRoot = false){
    $con = new conexaoDao();
    $query = "select * from usuario where nome_usuario = '$usuario' and senha = '$senha'";
    $query += $checkRoot?" and root = true":"";
    return $con->exeSql(query, true);
    
  }

  function unsetSession(){
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
  }

  if(isset($_GET['do']) && $_GET['do'])
    login();

  if(isset($_GET['exits']) && $_GET['exits'])
    exitSession();

?>
