<?php
require_once 'config.php';

$pesquisa = ( isset($_POST["seach"]) ) ? $_POST["seach"] : "";

echo json_encode(
            Usuario::retornarUsuarios($pesquisa)
        );

