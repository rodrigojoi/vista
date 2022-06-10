<?php
  session_start();
  include 'acoes/conexao.php';
  require_once 'acoes/verifica-logado.php';
  require_once 'autoload.php';

  use assets\classes\Locador;
  use assets\classes\Locatario;
  use assets\classes\Imovel;
  use assets\classes\Contrato;
  use acoes\CriadorConexao;

  $conexao = CriadorConexao::criarConexao();

  if($_POST['bt_cadastrar']) {
    
    $dtF = explode('-',$_POST['contratoDataInicio']);
    $data = new DateTime($dtF[2].'-'.$dtF[1].'-'.$dtF[0]);
    $data->modify('+1 year');
    $contratoDataFim = $data->format('Y-m-d');

    $objetoContrato = new Contrato($conexao);
    $objetoContrato->setContratoImovelCodigo($_POST['contratoImovelCodigo']);
    $objetoContrato->setContratoLocatarioCodigo($_POST['contratoLocatarioCodigo']);
    $objetoContrato->setContratoDataInicio($_POST['contratoDataInicio']);
    $objetoContrato->setContratoDataFim($contratoDataFim);
    $objetoContrato->setContratoAluguelValor($_POST['contratoAluguelValor']);
    $objetoContrato->setContratoAluguelValorTotal($_POST['contratoAluguelValorTotal']);
    $objetoContrato->setContratoCondominioValor($_POST['contratoCondominioValor']);
    $objetoContrato->setContratoIptuValor($_POST['contratoIptuValor']);
    $objetoContrato->setContratoTaxaAdministracaoValor($_POST['contratoTaxaAdministracaoValor']);
    $objetoContrato->setContratoInsercaoUsuarioCodigo($_SESSION['idusuario']);
    $objetoContrato->setContratoInsercaoData(date('d/m/Y'));
    $objetoContrato->insereContrato();

    header('Location: contratoIndex.php');
  }

  $objetoLocador = new Locador($conexao);
  $objetoLocador->selecionaLocador();
  $vetorLocador = $objetoLocador->getVetorLocador();

  $objetoLocatario = new Locatario($conexao);
  $objetoLocatario->selecionaLocatario();
  $vetorLocatario = $objetoLocatario->getVetorLocatario();

  $objetoImovel = new Imovel($conexao);
  $objetoImovel->selecionaImovel();
  $vetorImovel = $objetoImovel->getVetorImovel();
  

?>
<!DOCTYPE html>
<html lang="pt-br">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="images/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> Cadastrar Contrato </title>

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
  <h3>Cadastro de Contratos</h3>
  
  <form action="contratoCadastro.php" method="POST" class="needs-validation container" novalidate>

    <div class="row g-12">

      <div class="col-md-12">
        <label for="celular" class="form-label">Imóvel</label>
        <select class="form-control" id="contratoImovelCodigo" name="contratoImovelCodigo" required>
          <option value="">Selecione</option>
          <?php

          if(isset($vetorImovel)) {

            foreach($vetorImovel as $codigo => $vetorFinalImovel) {
            ?>
              <option value="<?php echo $codigo;?>"><?php echo $vetorFinalImovel['imovelEndereco'];?></option>
            <?php
            }
          }
          ?>
          </select>
        <div class="invalid-feedback">
          Selecione o Imóvel
        </div>
      </div>

      <div class="col-md-12">
        <label for="celular" class="form-label">Locatário</label>
        <select class="form-control" id="contratoLocatarioCodigo" name="contratoLocatarioCodigo" required>
          <option value="">Selecione</option>
          <?php

          if(isset($vetorLocatario)) {

            foreach($vetorLocatario as $codigo => $vetorFinalLocatario) {
            ?>
              <option value="<?php echo $codigo;?>"><?php echo $vetorFinalLocatario['locatarioNome'];?></option>
            <?php
            }
          }
          ?>
          </select>
        <div class="invalid-feedback">
          Selecione o Locador deste Imóvel
        </div>
      </div>

      <div class="col-sm-12">
        <label for="nome" class="form-label">Data Início</label>
        <input type="date" class="form-control" id="contratoDataInicio" name="contratoDataInicio" placeholder="" value="" required>
        <div class="invalid-feedback">
          Digite a Data de Início.
        </div>
      </div>

      <div class="col-sm-3">
        <label for="nome" class="form-label">Aluguel</label>
        <input type="number" min="0" max="10000" step="any" class="form-control" id="contratoAluguelValor" name="contratoAluguelValor" required onblur="somaAluguel()" value=0>

        <div class="invalid-feedback">
          Digite o valor do Aluguel
        </div>
      </div>

      <div class="col-sm-2">
        <label for="nome" class="form-label">Condomínio</label>
        <input type="number" min="0" max="10000" step="any" class="form-control" id="contratoCondominioValor" name="contratoCondominioValor" onblur="somaAluguel()" value=0>

        <div class="invalid-feedback">
          Digite o valor do Condomínio
        </div>
      </div>

      <div class="col-sm-2">
        <label for="nome" class="form-label">IPTU</label>
        <input type="number" min="0" max="10000" step="any" class="form-control" id="contratoIptuValor" name="contratoIptuValor" required onblur="somaAluguel()" value=0>

        <div class="invalid-feedback">
          Digite o valor do IPTU
        </div>
      </div>

      <div class="col-sm-2">
        <label for="nome" class="form-label">Administração</label>
        <input type="number" min="0" max="10000" step="any" class="form-control" id="contratoTaxaAdministracaoValor" name="contratoTaxaAdministracaoValor" required onblur="somaAluguel()" value=0>

        <div class="invalid-feedback">
          Digite o valor da Taxa de Administração
        </div>
      </div>

      <div class="col-sm-3">
        <label for="nome" class="form-label">Aluguel Total</label>
        <input type="number" min="0" max="10000" step="any" class="form-control" id="contratoAluguelValorTotal" name="contratoAluguelValorTotal" readonly>

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
  <script src="assets/js/insereInfoContrato.js"></script>
</body>
</html>