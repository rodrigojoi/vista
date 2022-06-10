<?php
  session_start();
  include 'acoes/conexao.php';
  require_once 'acoes/verifica-logado.php';
  require_once 'autoload.php';

  use assets\classes\Contrato;
  use acoes\CriadorConexao;

  $conexao = CriadorConexao::criarConexao();
?>
<!DOCTYPE html>
<html lang="pt-br">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="images/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> Contratos </title>

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
  <h3>Lista de Contratos <a href="contratoCadastro.php" class="btn btn-primary">Novo Contrato</a></h3>
  <hr />
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Código</th>
          <th>Imóvel</th>
          <th>Locatário</th>
          <th>Locador</th>
          <th>Data Início</th>
          <th>Data Fim</th>
          <th>Aluguel</th>
          <th>Condomínio</th>
          <th>IPTU</th>
          <th>Administração</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $objetoContrato = new Contrato($conexao);
        $objetoContrato->selecionaContrato();
        $vetorContrato = $objetoContrato->getVetorContrato();
    
        if(isset($vetorContrato)) {

          foreach($vetorContrato as $codigo => $vetorFinal) {
            
            $data = explode('-', $vetorFinal['contratoDataInicio']);
            $contratoDataInicio = $data['2']."/".$data['1']."/".$data['0'];
            $data = explode('-', $vetorFinal['contratoDataFim']);
            $contratoDataFim = $data['2']."/".$data['1']."/".$data['0'];

          ?>
            <tr>
              <td> <?php echo $codigo;?> </td>
              <td> <?php echo substr($vetorFinal['imovelEndereco'],0,30);?> </td>
              <td> <?php echo $vetorFinal['locatarioNome'];?> </td>
              <td> <?php echo $vetorFinal['locadorNome'];?> </td>
              <td> <?php echo $contratoDataInicio;?> </td>
              <td> <?php echo $contratoDataFim;?> </td>
              <td>R$ <?php echo $vetorFinal['contratoAluguelValor'];?> </td>
              <td>R$ <?php echo $vetorFinal['contratoCondominioValor'];?> </td>
              <td>R$ <?php echo $vetorFinal['contratoIptuValor'];?> </td>
              <td>R$ <?php echo $vetorFinal['contratoTaxaAdministracaoValor'];?> </td>
              <td>  
                <a href='contratoAlterar.php?contratoCodigo=<?php echo $codigo;?>'><i class='bi bi-pencil-square'></i></a>
                <a href='contratoExcluir.php?contratoCodigo=<?php echo $codigo;?>' data-bs-toggle='modal' data-bs-target='#exampleModal' onclick="insereInfoContrato('<?php echo $vetorFinal['contratoCodigo'];?>')"><i class='bi bi-trash'></i></a>
              </td>
            </tr>
          <?php
          }
        }
        ?>
      </tbody>
    </table>
  </div>
  
    <!-- modal -->
    <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLabel'>Apagar</h5>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
          </div>
          <div class='modal-body'>
            Deseja apagar o contrato número <span id='contratoCodigoSpan'></span>?
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
            
            <form action='contratoExcluir.php' method='POST'>
              <input type='hidden' name='contratoCodigoApagar' id='contratoCodigoApagar'>
              <button type='submit' class='btn btn-primary' name='bt_apagar'>Sim</button>
            </form>

          </div>
        </div>
      </div>
    </div>
    <!-- fim modal -->
</div>
</div>
<!-- bootstrap.js -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/insereInfoContrato.js"></script>
</body>
</html>