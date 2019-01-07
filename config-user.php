<?php
session_start();

if(
        !isset( $_SESSION["nome"]) 
 )
    {   
        session_destroy();
        header ("location: /ge/index.php");
    }

