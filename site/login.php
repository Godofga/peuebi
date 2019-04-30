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

    $con = new conexaoDao();
    $con->exeSql("select * from usuario where nome_usuario = '$usuario' and senha = '$senha'", true);

    if($con->found) {

      $_SESSION['usuario'] = $usuario;
      $_SESSION['senha'] = $senha;

      header('location:main.php');

    } else {

      unsetSession();-
      header('location:index.php?log=false');

    }
  }

  function checkLogin(){

    if(!isset($_SESSION['usuario']) || !isset($_SESSION['senha'])){

      unsetSession();
      header('location:index.php');

    }
  }

  function exitSession(){

    unsetSession();
    header('location:index.php');

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
