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

      unsetSession();
      header('location:index.php?log=false');

    }
  }

  function checkLogin(){

    if(!isset($_SESSION['usuario']) || !isset($_SESSION['senha'])){
      exitSession();
      header('location:index.php');
    }

  }

  function exitSession(){

    unsetSession();
    header('location:index.php');

  }

  function checkUser($checkRoot = false){
    $usuario= $_SESSION['usuario'];
    $senha= $_SESSION['senha'];
    $con = new conexaoDao();
    $queryy = "select * from usuario where nome_usuario = '$usuario' and senha = '$senha'";
    $queryy = $checkRoot?$queryy." and root = true":$queryy;
    return $con->exeSql($queryy, true);
    
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
