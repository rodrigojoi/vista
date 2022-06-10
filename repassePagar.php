<?php
  session_start();
  include 'acoes/conexao.php';
  require_once 'acoes/verifica-logado.php';
  require_once 'autoload.php';

  use assets\classes\Repasse;
  use acoes\CriadorConexao;

  $conexao = CriadorConexao::criarConexao();

  if($_POST['repasseCodigo'] AND $_POST['repasseDataEfetuado']) {
    
    $objetoRepasse = new Repasse($conexao);
    $objetoRepasse->setRepasseCodigo($_POST['repasseCodigo']);
    $objetoRepasse->setRepasseDataEfetuado($_POST['repasseDataEfetuado']);
    $objetoRepasse->pagarRepasse();

    header('Location: repasseAlterar.php?contratoCodigo='.$_POST['contratoCodigo']);
  }
  
