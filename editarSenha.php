<?php
  session_start();
  require_once 'acoes/verifica-logado.php';
  $id_logado    = $_SESSION['idusuario'];
  $email_logado = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="pt-br">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="images/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> Editar Senha </title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" >
  <!-- Icones -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <!-- fonte personalizada -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  
  <!-- estilo do nosso tema -->
  <link rel="stylesheet" href="assets/css/tema-imobiliaria.css" />
  <link rel="stylesheet" href="assets/css/form-validation.css" />
  <script src="assets/js/senhas-iguais.js"></script>
</head>
<body>

<!-- barra de navegacao -->
 <nav class="navbar navbar-expand-md navbar-light bg-light">
  <div class="container">
    <div class="navbar-header">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">EDITAR</a>
    </div>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="nav navbar-nav d-flex justify-content-end" id="links">
            <li><a href="painel.php">X</a></li>
        </ul>
    </div>
  </div>
</nav>

<!-- container fluido 100% -->
<div class="container-fluid bg1 text-center cadcurso" id="quem">

  <h3>Editar Senha</h3>
  
  <form action="salvarSenha.php" method="POST" class="needs-validation container" name="formuser" novalidate>

    <div class="row g-12">

      <div class="col-sm-12">
        <label for="nova_senha" class="form-label">Nova Senha</label>
        <input type="password" class="form-control" id="nova_senha" name="nova_senha" placeholder="" value="" autofocus required>
        <div class="invalid-feedback">
          Digite a senha anterior
        </div>
      </div>

      <div class="col-sm-12">
        <label for="conf_senha" class="form-label">Confirmação de Senha</label>
        <input type="password" class="form-control" id="conf_senha" name="conf_senha" placeholder="" value="" required onBlur="return validarSenhas()">
        <div class="invalid-feedback">
          Digite a senha anterior
        </div>
          <br>
        <button class="w-100 btn btn-primary btn-lg" type="submit" name="bt_editar">
          SALVAR
        </button>
      </div>

      </div>
        <input type="hidden" id="idusuario" name="idusuario" value="<?= $id_logado ?>"/>
      </div>
      
    </div>
  
  </form>
</div> <!-- fim div quem -->

<!-- bootstrap.js -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/form-validation.js"></script>

</body>
</html>