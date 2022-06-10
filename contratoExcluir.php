<?php
  session_start();
  include 'acoes/conexao.php';
  require_once 'acoes/verifica-logado.php';
  require_once 'autoload.php';

  use assets\classes\Contrato;
  use acoes\CriadorConexao;

  $conexao = CriadorConexao::criarConexao();

  if($_POST['contratoCodigoApagar']) {
    
    $objetoContrato = new Contrato($conexao);
    $objetoContrato->setContratoCodigo($_POST['contratoCodigoApagar']);
    $objetoContrato->excluiContrato();

    header('Location: contratoIndex.php');
  }
  
