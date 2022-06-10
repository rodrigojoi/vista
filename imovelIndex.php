<?php
  session_start();
  include 'acoes/conexao.php';
  require_once 'acoes/verifica-logado.php';
  require_once 'autoload.php';

  use assets\classes\Imovel;
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

  <title> Imóveis </title>

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
  <h3>Lista de Imóveis <a href="imovelCadastro.php" class="btn btn-primary">Novo Imóvel</a></h3>
  <hr />
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Código</th>
          <th>Endereço</th>
          <th>Locador</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $objetoImovel = new Imovel($conexao);
        $objetoImovel->selecionaImovel();
        $vetorImovel = $objetoImovel->getVetorImovel();
    
        if(isset($vetorImovel)) {

          foreach($vetorImovel as $codigo => $vetorFinal) {
          ?>
            <tr>
              <td> <?php echo $codigo;?> </td>
              <td> <?php echo $vetorFinal['imovelEndereco'];?> </td>
              <td> <?php echo $vetorFinal['locadorNome'];?> </td>
              <td>  
                <a href='imovelAlterar.php?imovelCodigo=<?php echo $codigo;?>'><i class='bi bi-pencil-square'></i></a>
                <a href='imovelExcluir.php?imovelCodigo=<?php echo $codigo;?>' data-bs-toggle='modal' data-bs-target='#exampleModal' onclick="insereInfoImovel('<?php echo $vetorFinal['imovelEndereco'];?>','<?php echo $codigo;?>')"><i class='bi bi-trash'></i></a>
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
            Deseja apagar o imóvel <span id='imovelEnderecoSpan'></span>?
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
            
            <form action='imovelExcluir.php' method='POST'>
              <input type='hidden' name='imovelCodigoApagar' id='imovelCodigoApagar'>
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
  <script src="assets/js/insereInfoImovel.js"></script>
</body>
</html>