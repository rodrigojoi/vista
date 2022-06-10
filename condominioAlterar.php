<?php

  session_start();
  include 'acoes/conexao.php';
  require_once 'acoes/verifica-logado.php';
  require_once 'autoload.php';

  use assets\classes\Condominio;
  use assets\classes\Imovel;
  use assets\classes\Contrato;
  use acoes\CriadorConexao;
  
  $conexao = CriadorConexao::criarConexao();

  if($_GET['contratoCodigo']) {

    $objetoContrato = new Contrato($conexao);
    $objetoContrato->selecionaContrato();
    $vetorContrato = $objetoContrato->getVetorContrato();
    
    $objetoImovel = new Imovel($conexao);
    $objetoImovel->selecionaImovel();
    $vetorImovel = $objetoImovel->getVetorImovel();
    
    $objetoCondominio = new Condominio($conexao);
    $objetoCondominio->setCondominioContratoCodigo($_GET['contratoCodigo']);
    $objetoCondominio->selecionaCondominio();
    $vetorCondominio = $objetoCondominio->getVetorCondominio();

    if(isset($vetorCondominio)) {

      foreach($vetorCondominio as $codigo => $vetorFinalCondominio) {

        $imovelEndereco      = $vetorFinalCondominio['imovelEndereco'];
      }
    }
  }
  elseif($_POST['condominioCodigo']) {

    $objetoImovel = new Imovel($conexao);
    $objetoImovel->setImovelCodigo($_POST['imovelCodigo']);
    $objetoImovel->setImovelEndereco($_POST['imovelEndereco']);
    $objetoImovel->setImovelLocadorCodigo($_POST['imovelLocadorCodigo']);
    $objetoImovel->alteraImovel();

    header('Location: condominioIndex.php');
  }
  else {

    header('Location: condominioIndex.php');
  }
  

?>
<!DOCTYPE html>
<html lang="pt-br">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="images/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> Condomínios </title>

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
  <h3>Condomínios</h3>
  <h4>Imóvel: <?php echo $imovelEndereco;?></h4>
  
  
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Código</th>
          <th>Data Aluguel</th>
          <th>Valor</th>
          <th>Data Efetuado</th>
          <th>Situação</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php

        if(isset($vetorCondominio)) {

          foreach($vetorCondominio as $codigo => $vetorFinalCondominio) {

            $dataA = explode('-', $vetorFinalCondominio['condominioDataAluguel']);
            $condominioDataAluguel = $dataA['2']."/".$dataA['1']."/".$dataA['0'];

            if($vetorFinalCondominio['condominioDataEfetuado']) {

              $dataR = explode('-', $vetorFinalCondominio['condominioDataEfetuado']);
              $condominioDataEfetuado = $dataR['2']."/".$dataR['1']."/".$dataR['0'];

            }
            else {

              $condominioDataEfetuado = '';
            }
            ?>
            <tr>
              <td> <?php echo $codigo;?> </td>
              <td> <?php echo $condominioDataAluguel;?> </td>
              <td>R$  <?php echo $vetorFinalCondominio['condominioValor'];?> </td>
              <td> <?php echo $condominioDataEfetuado;?> </td>
              
              <?php
                if($vetorFinalCondominio['condominioDataEfetuado']) {
                ?>
                  <td> 
                    Pago
                  </td>
                  <td>  
                    
                  </td>
                  <?php
                }
                else {
                  ?>
                  <td> 
                    Em Aberto
                  </td>
                  <td>  
                    <a href='condominioPagar.php?condominioCodigo=<?php echo $codigo;?>' data-bs-toggle='modal' data-bs-target='#exampleModal' onclick="insereInfoCondominio('<?php echo $condominioDataAluguel;?>','<?php echo $codigo;?>')"><i class='bi bi-cash-coin'></i></a>
                  </td>
                  <?php
                }
              ?>
            </tr>
          <?php
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
  
  <!-- modal -->
  <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id='exampleModalLabel'>Pagar Condomínio</h5>
          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
        </div>
        <div class='modal-body'>
          Deseja Pagar a Condomínio do dia <span id='condominioData'></span>?
        </div>

        <div class='modal-footer'>
          
          <form action='condominioPagar.php' method='POST' class="needs-validation container" novalidate>
            
            <div class="col-sm-5 centered">
              <label for="nome" class="form-label">Data Pagamento</label>
              <input type="date" class="form-control" id="condominioDataEfetuado" name="condominioDataEfetuado" placeholder="" value="" required>
              <div class="invalid-feedback">
                Informar Data Pagamento
              </div>
            </div>
              <br />
              <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
              <input type='hidden' name='condominioCodigo' id='condominioCodigo'>
              <input type='hidden' name='contratoCodigo' id='contratoCodigo' value='<?php echo $_GET['contratoCodigo'];?>'>
              <button type='submit' class='btn btn-primary' name='bt_apagar'>Confirma</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- fim modal -->

<!-- bootstrap.js -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/form-validation.js"></script>
  <script src="assets/js/insereInfoCondominio.js"></script>
</body>
</html>