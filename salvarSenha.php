<?php
    session_start();
    // iniciar sessao no arquivo que chama a consulta
    include 'acoes/conexao.php';
    require_once 'acoes/verifica-logado.php';
    require_once 'assets/classes/Usuario.php';
    require_once 'autoload.php';
  
    use assets\classes\Usuario;
    use acoes\CriadorConexao;

    if(isset($_POST['bt_editar'])) {

        $id_logado = $_SESSION['idusuario'];

        $conexao = CriadorConexao::criarConexao();

        $objetoUsuario = new Usuario($conexao);
        $objetoUsuario->setUsuarioCodigo($id_logado);
        $objetoUsuario->setUsuarioSenha(md5($_POST['nova_senha']));
        $objetoUsuario->alteraSenha();
        
        $_SESSION['mensagem'] = "Senha alterada com sucesso!";
        unset($_SESSION['idusuario']); // para evitar acessos sem fazer login
        header('Location: index.php');
    }
