<?php

$e = explode("/",$_SERVER['REQUEST_URI']);
$urlAtual = array_pop($e);
$menuCondominio  = '';
$menuContrato    = '';
$menuImovel      = '';
$menuLocador     = '';
$menuLocatario   = '';
$menuMensalidade = '';
$menuPainel      = '';
$menuRepasse     = '';

switch($urlAtual) {

  case strpos($urlAtual,'painel'): {
    $menuPainel = 'active';
    break;
  }
  case strpos($urlAtual,'locatario'): {
    $menuLocatario = 'active';
    break;
  }
  case strpos($urlAtual,'locador'): {
    $menuLocador = 'active';
    break;
  }
  case strpos($urlAtual,'imovel'): {
    $menuImovel = 'active';
    break;
  }
  case strpos($urlAtual,'contrato'): {
    $menuContrato = 'active';
    break;
  }
  case strpos($urlAtual,'condominio'): {
    $menuCondominio = 'active';
    break;
  }
  case strpos($urlAtual,'mensalidade'): {
    $menuMensalidade = 'active';
    break;
  }
  case strpos($urlAtual,'repasse'): {
    $menuRepasse = 'active';
    break;
  }
  default: {
    $menuPainel = 'active';
    break;
  }
}
?>

<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="painel.php">Gestão Imobiliária</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link <?php echo $menuPainel;?>" aria-current="page" href="painel.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $menuLocatario;?>" href="locatarioIndex.php">Locatário</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $menuLocador;?>" href="locadorIndex.php">Locador</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $menuImovel;?>" href="imovelIndex.php">Imóveis</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $menuContrato;?>" href="contratoIndex.php">Contratos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $menuMensalidade;?>" href="mensalidadeIndex.php">Mensalidades</a>
          </li>
          <li class="nav-item font-weight-bold">
            <a class="nav-link <?php echo $menuRepasse;?>" href="repasseIndex.php">Repasses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $menuCondominio;?>" href="condominioIndex.php">Condomínios</a>
          </li>

        </ul>
        <a href="configuracoes.php"><img src="fotos/<?= $_SESSION['foto'] ?>" class="img-responsive img-redonda" style="display:inline" alt="Foto" width="25"> </a>&nbsp; &nbsp;
        <div class="dados-usuario"> <?= $_SESSION['nome']; ?> </div>
        <a href="acoes/logout.php" class="btn btn-danger">Sair</a>
      </div>
    </div>
  </nav>
</header>