<?php
require_once 'config.php';

$login = $_POST["login"];

echo json_encode(
    Usuario::resetarSenha($login)
);
