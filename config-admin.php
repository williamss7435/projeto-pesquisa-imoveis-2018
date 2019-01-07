<?php
session_start();

if(
        !isset( $_SESSION["nome"]) ||
        ($_SESSION["tipo"] !== "9")
        
 )
    {   
        session_destroy();
        header ("location: /ge/index.php");
    }

