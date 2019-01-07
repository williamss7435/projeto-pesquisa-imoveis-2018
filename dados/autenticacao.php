<?php
require_once 'config.php';

$login = $_POST["login"];
$senha = $_POST["password"];

Usuario::login($login, $senha);


