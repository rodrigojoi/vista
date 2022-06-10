<?php
  session_start();
  include 'acoes/conexao.php';
  require_once 'acoes/verifica-logado.php';
  require_once 'autoload.php';

  use assets\classes\Locador;
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

  <title> Locadores </title>

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
  <h3>Lista de Locadores <a href="locadorCadastro.php" class="btn btn-primary">Novo Locador</a></h3>
  <hr />
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Código</th>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Telefone</th>
          <th>Dia Repasse</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $objetoLocador = new Locador($conexao);
        $objetoLocador->selecionaLocador();
        $vetorLocador = $objetoLocador->getVetorLocador();
    
        if(isset($vetorLocador)) {

          foreach($vetorLocador as $codigo => $vetorFinal) {
          ?>
            <tr>
              <td> <?php echo $codigo;?> </td>
              <td> <?php echo $vetorFinal['locadorNome'];?> </td>
              <td> <?php echo $vetorFinal['locadorEmail'];?> </td>
              <td> <?php echo $vetorFinal['locadorTelefone'];?> </td>
              <td> <?php echo $vetorFinal['locadorDiaRepasse'];?> </td>
              <td>  
                <a href='locadorAlterar.php?locadorCodigo=<?php echo $codigo;?>'><i class='bi bi-pencil-square'></i></a>
                <a href='locadorExcluir.php?locadorCodigo=<?php echo $codigo;?>' data-bs-toggle='modal' data-bs-target='#exampleModal' onclick="insereInfoLocador('<?php echo $vetorFinal['locadorNome'];?>','<?php echo $codigo;?>')"><i class='bi bi-trash'></i></a>
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
            Deseja apagar o locador <span id='locadorNomeSpan'></span>?
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
            
            <form action='locadorExcluir.php' method='POST'>
              <input type='hidden' name='locadorCodigoApagar' id='locadorCodigoApagar'>
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
  <script src="assets/js/insereInfoLocador.js"></script>
</body>
</html>