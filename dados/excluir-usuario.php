<?php
require_once 'config.php';

$login = $_POST["login"];

echo Usuario::excluirUsuario($login);
