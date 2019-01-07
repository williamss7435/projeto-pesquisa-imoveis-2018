<?php
require_once 'config.php';

$id = $_POST["id"];
$nome = $_POST["nome"];
$cep = $_POST["cep"];
$rua = $_POST["rua"];
$numero  = $_POST["numero"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$preco = $_POST["preco"];
$metragem = $_POST["metragem"];
$quartos = $_POST["quartos"];
$faixaMCMV = $_POST["faixaMCMV"];
$subsidio = $_POST["subsidio"];
$visualizacao = $_POST["visualizacao"];
$data_entrega = $_POST["dataEntrega"];
$descricao = $_POST["descricao"];


echo Imovel::EditarImovel($id, $nome,$cep,$rua,$numero,$bairro,$cidade,$estado,$preco,$metragem, $quartos, $faixaMCMV, $subsidio, $data_entrega, $descricao,$visualizacao);
