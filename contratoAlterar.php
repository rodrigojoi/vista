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

  if($_GET['contratoCodigo']) {

    $objetoLocador = new Locador($conexao);
    $objetoLocador->selecionaLocador();
    $vetorLocador = $objetoLocador->getVetorLocador();

    $objetoLocatario = new Locatario($conexao);
    $objetoLocatario->selecionaLocatario();
    $vetorLocatario = $objetoLocatario->getVetorLocatario();
    
    $objetoImovel = new Imovel($conexao);
    $objetoImovel->selecionaImovel();
    $vetorImovel = $objetoImovel->getVetorImovel();
    
    $objetoContrato = new Contrato($conexao);
    $objetoContrato->setContratoCodigo($_GET['contratoCodigo']);
    $objetoContrato->selecionaContrato();
    $vetorContrato = $objetoContrato->getVetorContrato();

    if(isset($vetorContrato)) {

      foreach($vetorContrato as $codigo => $vetorFinalContrato) {

        $imovelEndereco                 = $vetorFinalContrato['imovelEndereco'];
        $contratoImovelCodigo           = $vetorFinalContrato['contratoImovelCodigo'];
        $locatarioNome                  = $vetorFinalContrato['locatarioNome'];
        $contratoLocatarioCodigo        = $vetorFinalContrato['contratoLocatarioCodigo'];
        $contratoDataInicio             = $vetorFinalContrato['contratoDataInicio'];
        $contratoDataFim                = $vetorFinalContrato['contratoDataFim'];
        $contratoAluguelValor           = $vetorFinalContrato['contratoAluguelValor'];
        $contratoCondominioValor        = $vetorFinalContrato['contratoCondominioValor'];
        $contratoIptuValor              = $vetorFinalContrato['contratoIptuValor'];
        $contratoTaxaAdministracaoValor = $vetorFinalContrato['contratoTaxaAdministracaoValor'];
      }
    }
  }
  elseif($_POST['contratoCodigo']) {

    $objetoContrato = new Contrato($conexao);
    $objetoContrato->setContratoCodigo($_POST['contratoCodigo']);
    $objetoContrato->setContratoImovelCodigo($_POST['contratoImovelCodigo']);
    $objetoContrato->setContratoLocatarioCodigo($_POST['locatarioCodigo']);
    $objetoContrato->setContratoDataInicio($_POST['contratoDataInicio']);
    $objetoContrato->setContratoDataFim($_POST['contratoDataFim']);
    $objetoContrato->setContratoAluguelValor($_POST['contratoAluguelValor']);
    $objetoContrato->setContratoCondominioValor($_POST['contratoCondominioValor']);
    $objetoContrato->setContratoIptuValor($_POST['contratoIptuValor']);
    $objetoContrato->setContratoTaxaAdministracaoValor($_POST['contratoTaxaAdministracaoValor']);
    $objetoContrato->alteraContrato();

    header('Location: contratoIndex.php');
  }
  else {

    header('Location: contratoIndex.php');
  }
  

?>
<!DOCTYPE html>
<html lang="pt-br">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="images/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> Alterar Contrato </title>

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
<div class="container-fluid bg1 text-center conteudo" id="imovels">

<div class="container-fluid bg2 text-center" id="div-formacoes">
  <h3>Alterar Contrato</h3>
  
  <form action="contratoAlterar.php" method="POST" class="needs-validation container" novalidate>

    <div class="row g-12">

      <div class="col-md-12">
        <label for="celular" class="form-label">Imóvel</label>
        <select class="form-control" id="contratoImovelCodigo" name="contratoImovelCodigo" required readonly>
          <option value="">Selecione</option>
          <?php

          if(isset($vetorImovel)) {

            foreach($vetorImovel as $codigo => $vetorFinalImovel) {

              if($codigo == $contratoImovelCodigo) {
                $selecionaImovel = 'selected';
              }
              else {
                $selecionaImovel = '';
              }
              ?>
              <option value="<?php echo $codigo;?>" <?php echo $selecionaImovel;?>><?php echo $vetorFinalImovel['imovelEndereco'];?></option>
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
        <select class="form-control" id="contratoLocatarioCodigo" name="contratoLocatarioCodigo" required readonly>
          <option value="">Selecione</option>
          <?php

          if(isset($vetorLocatario)) {

            foreach($vetorLocatario as $codigo => $vetorFinalLocatario) {

              if($codigo == $contratoLocatarioCodigo) {
                $selecionaLocatario = 'selected';
              }
              else {
                $selecionaLocatario = '';
              }
              ?>
              <option value="<?php echo $codigo;?>" <?php echo $selecionaLocatario;?>><?php echo $vetorFinalLocatario['locatarioNome'];?></option>
            <?php
            }
          }
          ?>
          </select>
        <div class="invalid-feedback">
          Selecione o Locador deste Imóvel
        </div>
      </div>

      <div class="col-sm-6">
        <label for="nome" class="form-label">Data Início</label>
        <input type="date" class="form-control" id="nome" name="contratoDataInicio" placeholder="" value="<?php echo $contratoDataInicio;?>" required readonly>
        <div class="invalid-feedback">
          Digite a Data de Início.
        </div>
      </div>

      <div class="col-sm-6">
        <label for="nome" class="form-label">Data Final</label>
        <input type="date" class="form-control" id="nome" name="contratoDataFim" placeholder="" value="<?php echo $contratoDataFim;?>" required readonly>
        <div class="invalid-feedback">
          Digite a Data Final.
        </div>
      </div>

      <div class="col-sm-3">
        <label for="nome" class="form-label">Aluguel</label>
        <input type="number" min="0" max="10000" step="any" class="form-control" id="nome" name="contratoAluguelValor" required value="<?php echo $contratoAluguelValor;?>" readonly>

        <div class="invalid-feedback">
          Digite o valor do Aluguel
        </div>
      </div>

      <div class="col-sm-3">
        <label for="nome" class="form-label">Condomínio</label>
        <input type="number" min="0" max="10000" step="any" class="form-control" id="nome" name="contratoCondominioValor" value="<?php echo $contratoCondominioValor;?>" readonly>

        <div class="invalid-feedback">
          Digite o valor do Condomínio
        </div>
      </div>

      <div class="col-sm-3">
        <label for="nome" class="form-label">IPTU</label>
        <input type="number" min="0" max="10000" step="any" class="form-control" id="nome" name="contratoIptuValor" required value="<?php echo $contratoIptuValor;?>" readonly>

        <div class="invalid-feedback">
          Digite o valor do IPTU
        </div>
      </div>

      <div class="col-sm-3">
        <label for="nome" class="form-label">Administração</label>
        <input type="number" min="0" max="10000" step="any" class="form-control" id="nome" name="contratoTaxaAdministracaoValor" required value="<?php echo $contratoTaxaAdministracaoValor;?>" readonly>

        <div class="invalid-feedback">
          Digite o valor da Taxa de Administração
        </div>
      </div>

      </div>
      <br />
      <input type="hidden" name="imovelCodigo" value="<?php echo $_GET['imovelCodigo'];?>">
      <button class="w-100 btn btn-primary btn-lg" type="button" name="bt_cadastrar" value=1 onclick='history.back()'>
      Voltar
      </button>
  
  </form>
</div>

<!-- bootstrap.js -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/form-validation.js"></script>
</body>
</html>