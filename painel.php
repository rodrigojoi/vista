<?php
    // INICIAR SESSÃO
    session_start();
    require_once 'autoload.php';
    require_once 'acoes/verifica-logado.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.png">
    <meta name="description" content="">
    <meta name="author" content="Rodrigo Koch">

    <title>Gestão Imobiliária</title>
 
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/geral.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/carousel.css" rel="stylesheet">
  </head>
  <body>
    
  <?php
    include_once "includes/header.php";
  ?>


<main>
  <div class="container-fluid"> <!-- div criada na parte 4 -->
    <?php include_once 'acoes/mensagem.php'; ?>
  </div>
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/imagem01.jpg" alt="Foto de trabalho" />

        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Cadastro de Locatários</h1>
            <p>Mantenha o cadastro de locatários atualizado.</p>
            <p><a class="btn btn-lg btn-primary" href="locatarioIndex.php">Cadastrar Locatário</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/imagem02.jpg" alt="Foto de trabalho" />

        <div class="container">
          <div class="carousel-caption">
            <h1>Cadastro de Locador</h1>
            <p>Mantenha o cadastro de locadores atualizado.</p>
            <p><a class="btn btn-lg btn-success" href="locadorIndex.php">Cadastrar Locador</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/imagem03.jpg" alt="Foto de trabalho" />

        <div class="container">
          <div class="carousel-caption text-end">
            <h1>Cadastro de Imóveis</h1>
            <p>Mantenha o cadastro de imóveis atualizado.</p>
            <p><a class="btn btn-lg btn-info" href="imovelIndex.php">Cadastrar Imóvel</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/imagem04.jpg" alt="Foto de trabalho" />

        <div class="container">
          <div class="carousel-caption text-end">
            <h1>Cadastro de Contratos</h1>
            <p>Mantenha o cadastro de contratos atualizado.</p>
            <p><a class="btn btn-lg btn-dark" href="contratoIndex.php">Cadastrar Contrato</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row">
      <div class="col-lg-3">
        <h2>Locatários</h2>
        <p>Cadastre seus locatários.</p>
        <p><a class="btn btn-primary" href="locatarioIndex.php">Cadastrar Locatários &raquo;</a></p>
      </div><!-- /.col-lg-3 -->
      <div class="col-lg-3">
        
        <h2>Locador</h2>
        <p>Cadastre seus locadores.</p>
        <p><a class="btn btn-success" href="locadorIndex.php">Cadastrar Locadores &raquo;</a></p>
      </div><!-- /.col-lg-3 -->
      <div class="col-lg-3">
        
        <h2>Imóveis</h2>
        <p>Cadastre seus imóveis.</p>
        <p><a class="btn btn-info" href="imovelIndex.php">Cadastrar Imóveis &raquo;</a></p>
      </div><!-- /.col-lg-3 -->
      <div class="col-lg-3">
        
        <h2>Contratos</h2>
        <p>Cadastre seus contratos.</p>
        <p><a class="btn btn-dark" href="contratoIndex.php">Cadastrar Contratos &raquo;</a></p>
      </div><!-- /.col-lg-3 -->
    </div><!-- /.row -->

    <!-- START THE FEATURETTES -->
    <hr class="featurette-divider">

  <!-- FOOTER -->
  <footer class="container">
    <p class="float-end"><a href="#">Ir para o topo</a></p>
    <p>&copy; <?php echo date('Y');?> Rodrigo Koch &middot;</p>
  </footer>
</main>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/mensagem.js"></script>
      
  </body>
</html>