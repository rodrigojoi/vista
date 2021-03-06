<?php
  session_start();
  include 'acoes/conexao.php';
  require_once 'acoes/verifica-logado.php';
  require_once 'autoload.php';

  use assets\classes\Locador;
  use acoes\CriadorConexao;

  $conexao = CriadorConexao::criarConexao();

  if($_GET['locadorCodigo']) {
    
    $objetoLocador = new Locador($conexao);
    $objetoLocador->setLocadorCodigo($_GET['locadorCodigo']);
    $objetoLocador->selecionaLocador();
    $vetorLocador = $objetoLocador->getVetorLocador();

    if(isset($vetorLocador)) {

      foreach($vetorLocador as $codigo => $vetorFinal) {

        $locadorNome       = $vetorFinal['locadorNome'];
        $locadorTelefone   = $vetorFinal['locadorTelefone'];
        $locadorEmail      = $vetorFinal['locadorEmail'];
        $locadorDiaRepasse = $vetorFinal['locadorDiaRepasse'];
      }
    }
  }
  elseif($_POST['locadorCodigo']) {

    $objetoLocador = new Locador($conexao);
    $objetoLocador->setLocadorCodigo($_POST['locadorCodigo']);
    $objetoLocador->setLocadorNome($_POST['locadorNome']);
    $objetoLocador->setLocadorEmail($_POST['locadorEmail']);
    $objetoLocador->setLocadorTelefone($_POST['locadorTelefone']);
    $objetoLocador->setLocadorDiaRepasse($_POST['locadorDiaRepasse']);
    $objetoLocador->alteraLocador();

    header('Location: locadorIndex.php');
  }
  else {

    header('Location: locadorIndex.php');
  }
  

?>
<!DOCTYPE html>
<html lang="pt-br">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="images/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> Alterar Locador </title>

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
<div class="container-fluid bg1 text-center conteudo" id="locadors">

<div class="container-fluid bg2 text-center" id="div-formacoes">
  <h3>Alterar Locador</h3>
  
  <form action="locadorAlterar.php" method="POST" class="needs-validation container" novalidate>

    <div class="row g-12">

      <div class="col-sm-12">
        <label for="nome" class="form-label">Nome Completo</label>
        <input type="text" class="form-control" id="nome" name="locadorNome" placeholder="" value="<?php echo $locadorNome;?>" autofocus required>
        <div class="invalid-feedback">
          Digite o seu nome completo.
        </div>
      </div>

      <div class="col-md-12">
        <label for="celular" class="form-label">Celular</label>
        <input type="text" class="form-control" id="celular" name="locadorTelefone" placeholder="(99) 99999-9999" required value="<?php echo $locadorTelefone;?>">
        <div class="invalid-feedback">
          Digite o n??mero do seu celular com DDD.
        </div>
      </div>

      <div class="col-12">
        <label for="email" class="form-label">E-mail</label>
        <div class="input-group has-validation">
          <span class="input-group-text">@</span>
          <input type="text" class="form-control" id="email" name="locadorEmail" placeholder="email@provedor.com" required value="<?php echo $locadorEmail;?>">
        <div class="invalid-feedback">
            Digite o seu e-mail.
          </div>
        </div>
      </div>

      <div class="col-sm-12">
        <label for="diaRepasse" class="form-label">Dia do Repasse</label>
        <input type="number" class="form-control" id="nome" name="locadorDiaRepasse" placeholder="" value="<?php echo $locadorDiaRepasse;?>" required>
        <div class="invalid-feedback">
          Dia do Repasse
        </div>
      </div>

      </div>
      <br />
      <input type="hidden" name="locadorCodigo" value="<?php echo $_GET['locadorCodigo'];?>">
      <button class="w-100 btn btn-primary btn-lg" type="submit" name="bt_cadastrar" value=1>
      Salvar
      </button>
  
  </form>
</div>

<!-- bootstrap.js -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/form-validation.js"></script>
</body>
</html>