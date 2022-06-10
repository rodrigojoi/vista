<?php
  session_start();
  include 'acoes/conexao.php';
  require_once 'acoes/verifica-logado.php';
  require_once 'autoload.php';

  use assets\classes\Locador;
  use acoes\CriadorConexao;

  $conexao = CriadorConexao::criarConexao();

  if($_POST['locadorCodigoApagar']) {
    
    $objetoLocador = new Locador($conexao);
    $objetoLocador->setLocadorCodigo($_POST['locadorCodigoApagar']);
    $objetoLocador->excluiLocador();

    header('Location: locadorIndex.php');
  }
  
