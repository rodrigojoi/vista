<?php
  session_start();
  include 'acoes/conexao.php';
  require_once 'acoes/verifica-logado.php';
  require_once 'autoload.php';

  use assets\classes\Locador;
  use assets\classes\Imovel;
  use acoes\CriadorConexao;

  $conexao = CriadorConexao::criarConexao();

  if($_POST['bt_cadastrar']) {
    
    $objetoImovel = new Imovel($conexao);
    $objetoImovel->setImovelEndereco($_POST['imovelEndereco']);
    $objetoImovel->setImovelLocadorCodigo($_POST['imovelLocadorCodigo']);
    $objetoImovel->setImovelInsercaoUsuarioCodigo($_SESSION['idusuario']);
    $objetoImovel->setImovelInsercaoData(date('d/m/Y'));
    $objetoImovel->insereImovel();

    header('Location: imovelIndex.php');
  }

  $objetoLocador = new Locador($conexao);
  $objetoLocador->selecionaLocador();
  $vetorLocador = $objetoLocador->getVetorLocador();
  

?>
<!DOCTYPE html>
<html lang="pt-br">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="images/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> Cadastrar Imóvel </title>

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
<div class="container-fluid bg1 text-center conteudo" id="imoveis">

<div class="container-fluid bg2 text-center" id="div-formacoes">
  <h3>Cadastro de Imóvel</h3>
  
  <form action="imovelCadastro.php" method="POST" class="needs-validation container" novalidate>

    <div class="row g-12">

      <div class="col-sm-12">
        <label for="nome" class="form-label">Endereço Completo</label>
        <input type="text" class="form-control" id="nome" name="imovelEndereco" placeholder="" value="" autofocus required>
        <div class="invalid-feedback">
          Digite o endereço completo.
        </div>
      </div>

      <div class="col-md-12">
        <label for="celular" class="form-label">Locador</label>
        <select class="form-control" id="imovelLocadorCodigo" name="imovelLocadorCodigo" required>
          <option value="">Selecione</option>
          <?php

          if(isset($vetorLocador)) {

            foreach($vetorLocador as $codigo => $vetorFinal) {
            ?>
              <option value="<?php echo $codigo;?>"><?php echo $vetorFinal['locadorNome'];?></option>
            <?php
            }
          }
          ?>
          </select>
        <div class="invalid-feedback">
          Selecione o Locador deste Imóvel
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