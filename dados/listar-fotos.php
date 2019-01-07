<?php
require_once 'config.php';

$pesquisa = $_POST["seach"];

echo json_encode(
        Imovel::retonarFotos($pesquisa)
);