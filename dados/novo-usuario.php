<?php
require_once 'config.php';
          if(isset($_POST["newUserName"])  && isset($_POST["newUserSetor"])){

              
              $nome = $_POST["newUserName"];
              $sobrenome = $_POST["newUserLastName"];
              $login = $_POST["newUserEmail"];
              $cargo = $_POST["newUserOffice"];
              $tipo = $_POST["newUserSetor"];
              
              echo json_encode(
                      Usuario::salvarNovoUsuario($nome, $sobrenome, $login, $cargo, $tipo)
              ) ;
                                        
          }
              
              
              
  ?>
