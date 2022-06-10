<?php
  session_start();
  include 'acoes/conexao.php';
  require_once 'acoes/verifica-logado.php';
  require_once 'autoload.php';

  use assets\classes\Mensalidade;
  use acoes\CriadorConexao;

  $conexao = CriadorConexao::criarConexao();

  if($_POST['mensalidadeCodigo'] AND $_POST['mensalidadeDataPagamento']) {
    
    $objetoMensalidade = new Mensalidade($conexao);
    $objetoMensalidade->setMensalidadeCodigo($_POST['mensalidadeCodigo']);
    $objetoMensalidade->setMensalidadeDataRecebimento($_POST['mensalidadeDataPagamento']);
    $objetoMensalidade->pagarMensalidade();

    header('Location: mensalidadeAlterar.php?contratoCodigo='.$_POST['contratoCodigo']);
  }
  
