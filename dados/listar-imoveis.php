<?php
require_once 'config.php';

$_POST["tipo"];
$pesquisa = ( isset($_POST["seach"]) ) ? $_POST["seach"] : "";

if($_POST["tipo"] == 2){
    echo json_encode(
        Imovel::retornarImoveis($pesquisa)
        );
}else if($_POST["tipo"] == 1){
    echo json_encode(
        Imovel::retornarImovel($pesquisa)
    );
}


