<?php
  session_start();
  include 'acoes/conexao.php';
  require_once 'acoes/verifica-logado.php';
  require_once 'autoload.php';

  use assets\classes\Locatario;
  use acoes\CriadorConexao;

  $conexao = CriadorConexao::criarConexao();

  if($_POST['bt_cadastrar']) {
    
    $objetoLocatario = new Locatario($conexao);
    $objetoLocatario->setLocatarioNome($_POST['locatarioNome']);
    $objetoLocatario->setLocatarioEmail($_POST['locatarioEmail']);
    $objetoLocatario->setLocatarioTelefone($_POST['locatarioTelefone']);
    $objetoLocatario->setLocatarioInsercaoUsuarioCodigo($_SESSION['idusuario']);
    $objetoLocatario->setLocatarioInsercaoData(date('d/m/Y'));
    $objetoLocatario->insereLocatario();

    header('Location: locatarioIndex.php');
  }
  

?>
<!DOCTYPE html>
<html lang="pt-br">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="images/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> Cadastrar Locatário </title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" >
  <!-- Icones -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <!-- fonte personalizada -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  
  <!-- estilo do nosso tema -->
  <link href="assets/css/geral.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/form-validation.css" />
</head>
<body>

<?php
    include_once "includes/header.php";
?>

<!-- container fluido 100% -->
<div class="container-fluid bg1 text-center conteudo" id="locatarios">

<div class="container-fluid bg2 text-center" id="div-formacoes">
  <h3>Cadastro de Locatário</h3>
  
  <form action="locatarioCadastro.php" method="POST" class="needs-validation container" novalidate>

    <div class="row g-12">

      <div class="col-sm-12">
        <label for="nome" class="form-label">Nome Completo</label>
        <input type="text" class="form-control" id="nome" name="locatarioNome" placeholder="" value="" autofocus required>
        <div class="invalid-feedback">
          Digite o seu nome completo.
        </div>
      </div>

      <div class="col-md-12">
        <label for="celular" class="form-label">Celular</label>
        <input type="text" class="form-control" id="celular" name="locatarioTelefone" placeholder="(99) 99999-9999" required>
        <div class="invalid-feedback">
          Digite o número do seu celular com DDD.
        </div>
      </div>

      <div class="col-12">
        <label for="email" class="form-label">E-mail</label>
        <div class="input-group has-validation">
          <span class="input-group-text">@</span>
          <input type="text" class="form-control" id="email" name="locatarioEmail" placeholder="email@provedor.com" required>
        <div class="invalid-feedback">
            Digite o seu e-mail.
          </div>
        </div>
      </div>

      </div>
      <br>
      <button class="w-100 btn btn-primary btn-lg" type="submit" name="bt_cadastrar" value=1>
      Cadastrar
      </button>
  
  </form>
</div>

<!-- bootstrap.js -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/form-validation.js"></script>
</body>
</html>