<?php
  session_start();
  include 'acoes/conexao.php';
  require_once 'autoload.php';

  use assets\classes\Usuario;
  use acoes\CriadorConexao;

  $conexao = CriadorConexao::criarConexao();

  if($_POST['bt_cadastrar']) {
    
    $objetoUsuario = new Usuario($conexao);
    $objetoUsuario->setUsuarioNome($_POST['usuarioNome']);
    $objetoUsuario->setUsuarioEmail($_POST['usuarioEmail']);
    $objetoUsuario->setUsuarioCelular($_POST['usuarioCelular']);
    $objetoUsuario->setUsuarioSenha(md5($_POST['usuarioSenha']));
    $objetoUsuario->insereUsuario();

    $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
    $_SESSION['status']   = "success";

    header('Location: index.php');
}