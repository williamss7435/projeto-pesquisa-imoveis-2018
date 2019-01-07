<?php
require_once 'config.php';

$login = $_POST["userLogin"];
$senhaAntiga =  $_POST["userPassword"];
$senhaNova  = $_POST["UserNewPassword"];

echo json_encode(
    Usuario::editarDados($login, $senhaAntiga, $senhaNova)
);

