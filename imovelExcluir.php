<?php
  session_start();
  include 'acoes/conexao.php';
  require_once 'acoes/verifica-logado.php';
  require_once 'autoload.php';

  use assets\classes\Imovel;
  use acoes\CriadorConexao;

  $conexao = CriadorConexao::criarConexao();

  if($_POST['imovelCodigoApagar']) {
    
    $objetoImovel = new Imovel($conexao);
    $objetoImovel->setImovelCodigo($_POST['imovelCodigoApagar']);
    $objetoImovel->excluiImovel();

    header('Location: imovelIndex.php');
  }
  
