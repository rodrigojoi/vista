function insereInfoContrato(codigo) {
  document.getElementById('contratoCodigoSpan').innerHTML = codigo;
  document.getElementById('contratoCodigoApagar').value = codigo;
}

function somaAluguel() {

  aluguel       = document.getElementById('contratoAluguelValor').value;
  condominio    = document.getElementById('contratoCondominioValor').value;
  iptu          = document.getElementById('contratoIptuValor').value;
  aluguelTotal  = parseInt(aluguel)  + parseInt(condominio) + parseInt(iptu);
  document.getElementById('contratoAluguelValorTotal').value = aluguelTotal;
}
