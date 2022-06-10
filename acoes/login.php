<?php
    session_start();
    include 'conexao.php';
    //require_once 'verifica-logado.php';
    require_once '../assets/classes/Usuario.php';
    require_once '../autoload.php';
  
    use assets\classes\Usuario;
    use acoes\CriadorConexao;

    $conexao = CriadorConexao::criarConexao();
    
    if(isset($_POST['bt_entrar'])) {

        $objetoUsuario = new Usuario($conexao);
        $objetoUsuario->setUsuarioEmail($_POST['email']);
        $objetoUsuario->setUsuarioSenha(md5($_POST['senha']));
        $objetoUsuario->selecionaUsuario();
        $vetorUsuario = $objetoUsuario->getVetorUsuario();

        if(isset($vetorUsuario)) {

            foreach($vetorUsuario as $codigo => $vetorFinalUsuario) {
        
                // CRIAR VARIAVEIS DE SESSAO
                $_SESSION['mensagem']  = "Usuário logado com sucesso!";
                $_SESSION['status']    = "success";
                $_SESSION['idusuario'] = $vetorFinalUsuario['usuarioCodigo'];
                $_SESSION['nome']      = $vetorFinalUsuario['usuarioNome'];
                $_SESSION['email']     = $vetorFinalUsuario['usuarioEmail'];
                $_SESSION['foto']      = $vetorFinalUsuario['usuarioFoto']; // para mostrar no painel
                header('Location: ../painel.php'); // REDIRECIONAR PARA O PAINEL
            }
        } else {
            // CRIAR VARIAVEIS DE SESSAO
            $_SESSION['mensagem'] = "Erro no login! E-mail ou senha incorretos";
            $_SESSION['status'] = "danger";
            header('Location: ../index.php'); // REDIRECIONAR PARA O INDEX
        }
    }
