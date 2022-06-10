<?php

if(isset($_SESSION['mensagem'])) {
    echo "
        <div class='alert alert-".$_SESSION['status']." alert-dismissible fade show mensagem' role='alert' id='aviso'>
            {$_SESSION['mensagem']} <br>
            <span class='alert-warning'>".@$_SESSION['msg_upload']."</span>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    // session_unset(); // DESTRUIR VARIAVEIS DE SESSAO
    unset($_SESSION['mensagem']);
    unset($_SESSION['msg_upload']);
}
