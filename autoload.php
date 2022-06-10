<?php

    spl_autoload_register(
        function(string $nomeCompletoDaClasse)
        {
            $caminhoArquivo  = str_replace('\\', DIRECTORY_SEPARATOR, $nomeCompletoDaClasse);
            $caminhoArquivo .= '.php';
            if(file_exists($caminhoArquivo)) {
                require_once $caminhoArquivo;
            }
        }
    );