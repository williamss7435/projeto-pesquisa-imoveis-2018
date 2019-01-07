<?php
session_start();

spl_autoload_register(function ($nomeClasse){
    $diretorio =  ".." . DIRECTORY_SEPARATOR . "classes";
    $nomeDoArquivo = $diretorio . DIRECTORY_SEPARATOR . $nomeClasse . ".php";
    
        if(file_exists($nomeDoArquivo))
            require_once $nomeDoArquivo;
        
});



