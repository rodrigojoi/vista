function validarSenhas(){
  var nova_senha = formuser.nova_senha.value;
  var conf_senha = formuser.conf_senha.value;
  
  if(nova_senha == "" || nova_senha.length <= 5){
    alert('Preencha o campo senha com minimo 6 caracteres');
    formuser.nova_senha.focus();
    return false;
  }
  
  if(conf_senha == "" || conf_senha.length <= 5){
    alert('Preencha o campo senha com minimo 6 caracteres');
    formuser.conf_senha.focus();
    return false;
  }
  
  if (nova_senha != conf_senha) {
    alert('Senhas diferentes');
    formuser.senha.focus();
    return false;
  }
}
