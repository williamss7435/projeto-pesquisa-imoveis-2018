<?php
require_once 'config.php';

$pesquisa = $_POST["seach"];

echo  Imovel::deletarFoto($pesquisa);

