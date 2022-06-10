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
<div class="container-fluid bg1 text-center conteudo" id="locatarios">
<div class="container-fluid bg2 text-center" id="div-formacoes">
  <h3>Condomínios - Escolha um Contrato </h3>
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
        $objetoContrato->setTemCondominio(1);
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
                <a href='condominioAlterar.php?contratoCodigo=<?php echo $codigo;?>'><i class='bi bi-card-checklist' title='Ver Condominios'></i></a>
              </td>
            </tr>
          <?php
          }
        }
        ?>
      </tbody>
    </table>
  </div>
  
</div>
</div>
<!-- bootstrap.js -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>