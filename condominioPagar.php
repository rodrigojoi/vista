<?php
  session_start();
  include 'acoes/conexao.php';
  require_once 'acoes/verifica-logado.php';
  require_once 'autoload.php';

  use assets\classes\Condominio;
  use acoes\CriadorConexao;

  $conexao = CriadorConexao::criarConexao();

  if($_POST['condominioCodigo'] AND $_POST['condominioDataEfetuado']) {
    
    $objetoCondominio = new Condominio($conexao);
    $objetoCondominio->setCondominioCodigo($_POST['condominioCodigo']);
    $objetoCondominio->setCondominioDataEfetuado($_POST['condominioDataEfetuado']);
    $objetoCondominio->pagarCondominio();

    header('Location: condominioAlterar.php?contratoCodigo='.$_POST['contratoCodigo']);
  }
  
