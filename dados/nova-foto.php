<?php
require_once 'config.php';

$numImagens = $_POST["qntImages"];
$id = $_POST["id-imovel"];

for($i = 1; $numImagens>=$i; $i++){
                if($_FILES["foto". $i]['type'] !== "image/jpeg" || $_FILES["foto". $i]['size'] > 1024000){
                      return "Foto Invalida";
                      exit();
                }
}

echo Imovel::salvarFotos($numImagens, $id);