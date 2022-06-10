<?php
  session_start();
  include 'acoes/conexao.php';
  require_once 'acoes/verifica-logado.php';
  require_once 'autoload.php';

  use assets\classes\Locatario;
  use acoes\CriadorConexao;

  $conexao = CriadorConexao::criarConexao();

  if($_POST['locatarioCodigoApagar']) {
    
    $objetoLocatario = new Locatario($conexao);
    $objetoLocatario->setLocatarioCodigo($_POST['locatarioCodigoApagar']);
    $objetoLocatario->excluiLocatario();

    header('Location: locatarioIndex.php');
  }
  
