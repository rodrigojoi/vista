<!DOCTYPE html>
<html lang="pt-br">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="images/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> Cadastrar Usuário </title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" >
  <!-- Icones -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <!-- fonte personalizada -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  
  <!-- estilo do tema -->
  <link rel="stylesheet" href="assets/css/tema-imobiliaria.css" />
  <link rel="stylesheet" href="assets/css/form-validation.css" />
  
</head>
<body>

<!-- barra de navegacao -->
 <nav class="navbar navbar-expand-md navbar-light bg-light">
  <div class="container">
    <div class="navbar-header">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">CADASTRAR</a>
    </div>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="nav navbar-nav d-flex justify-content-end" id="links">
            <li><a href="index.php">X</a></li>
        </ul>
    </div>
  </div>
</nav>

<!-- container fluido 100% -->
<div class="container-fluid bg1 text-center" id="quem">

  <h3>Cadastro de Usuário</h3>
  
  <form action="criaUsuario.php" method="POST" class="needs-validation container" novalidate onSubmit="return validaCampoSenha()">

    <div class="row g-12">

      <div class="col-sm-12">
        <label for="nome" class="form-label">Nome Completo</label>
        <input type="text" class="form-control" id="usuarioNome" name="usuarioNome" placeholder="" value="" autofocus required>
        <div class="invalid-feedback">
          Digite o seu nome completo.
        </div>
      </div>

      <div class="col-md-12">
        <label for="celular" class="form-label">Celular</label>
        <input type="text" class="form-control" id="usuarioCelular" name="usuarioCelular" placeholder="(99) 99999-9999" required>
        <div class="invalid-feedback">
          Digite o número do seu celular com DDD.
        </div>
      </div>

      <div class="col-12">
        <label for="email" class="form-label">E-mail</label>
        <div class="input-group has-validation">
          <span class="input-group-text">@</span>
          <input type="text" class="form-control" id="usuarioEmail" name="usuarioEmail" placeholder="email@provedor.com" required>
        <div class="invalid-feedback">
            Digite o seu e-mail.
          </div>
        </div>
      </div>

      <div class="col-12">
        <label for="senha" class="form-label">Senha</label>
        <div class="input-group has-validation">
          <input type="password" class="form-control" id="usuarioSenha" name="usuarioSenha" placeholder="" required>
        <div class="invalid-feedback">
            Digite uma senha.
          </div>
        </div>
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
  <script>
    function validaCampoSenha(){
      var campo = document.getElementById('usuarioSenha');
      var txt   = document.getElementById('usuarioSenha').value;
      var n     = txt.length;
      if(n < 6) {
        alert("A senha tem apenas " + n + " caracteres, precisa ter 6 ou mais");
        return false;
        campo.focus();
      }
        return true;
    }
  </script>
</body>
</html>