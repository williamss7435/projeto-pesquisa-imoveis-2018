<?php require_once "config-admin.php";?>
<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="_img/logo-tenda-35x35.png">
    <title>Login</title>
    <link rel="stylesheet" href="_comp/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="_comp/icon/font/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="_css/admin.css">
    <link href="https://fonts.googleapis.com/css?family=Signika" rel="stylesheet">
</head>
<body>
    <div class="loading text-center"><img src="_img/gif-tenda.gif" id="img-load" class="img-fluid"></div>
    <nav class="navbar navbar-expand-lg navbar-main">
        <a href="#" class="navbar-brand d-none d-lg-block"><img src="_img/logo-tenda-156x42.png" alt=""></a>
        
        <div class="dropdown ml-lg-auto">
          <a class="btn btn-outline-light dropdown-toggle" href="#" role="button" id="dropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Olá <?= $_SESSION["nome"] . " " . $_SESSION["sobrenome"]?>
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownUser">
            <button class="dropdown-item" data-toggle="modal" data-target="#modal-dados"><span class="oi oi-lock-unlocked"></span> Alterar Senha</button>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logoff.php"><span class="oi oi-power-standby"></span> Sair</a>
          </div>
        </div>
        
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 menu-flex menu-left">
                 <nav class="nav flex-column pb-5">
                    <a href="tenda-admin.php" class="nav-link"><span class="oi oi-home"></span> Página Inicial</a>
                    
                    <a class="nav-link mt-3" data-toggle="collapse" href="#menu-usuario" role="button" aria-expanded="false" aria-controls="collapseExample">Usuários <span class="oi oi-chevron-right float-right"></span></a>
                    <div class="collapse mb-3" id="menu-usuario">
                        <a href="tenda-admin-novo-usuario.php" class="nav-link"> <span class="oi oi-plus"></span> Cadastrar Usuário</a>
                        <a href="tenda-admin-editar-usuario.php" class="nav-link"><span class="oi oi-pencil"></span> Resetar / Excluir</a>
                    </div>      
                    
                    <a class="nav-link mt-3 bg-primary" data-toggle="collapse" href="#menu-imovel" role="button" aria-expanded="false" aria-controls="collapseExample">Imóveis <span class="oi oi-chevron-right float-right"></span></a>
                    <div class="collapse mb-3" id="menu-imovel">
                        <a href="tenda-admin-cadastro-imovel.php" class="nav-link"> <span class="oi oi-plus"></span> Cadastrar</a>
                        <a href="tenda-admin-editar-imovel.php" class="nav-link"><span class="oi oi-pencil"></span> Editar</a>
                        <a href="tenda-admin-excluir-imovel.php" class="nav-link mb-3 bg-primary"><span class="oi oi-trash"></span> Excluir</a>
                    </div>                        
                </nav>
            </div>
        
            <div class="col-11 col-lg-10 m-6">
                <div class="col-12 form-register mx-auto d-block">

                  <div class="row mt-4">
                    <div class="col title-register">
                         Editar Imóveis
                    </div>
                  </div>

                  <div class="row mt-3 mb-3">
                     <div class="col-12 col-lg-7">    
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Pesquisar Por Nome, Bairro, Rua Ou Cidade" id="inputSeach">
                          <button class="btn btn-primary ml-3" id="btnSeach"><span class="oi oi-magnifying-glass"></span> Pesquisar</button>
                      </div>
                     </div>
                  </div>
                  
                  <table class="table table-responsive table-hover mb-3">
                    <thead>
                      <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Bairro</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">Rua</th>
                     
                      </tr>
                    </thead>
                    <tbody id="immobiles">
                     
                    </tbody>
                  </table>

                </div>  
         
            </div>
                
            </div>
            
        </div>
    </div>
    

    <div class="modal fade" id="modal-dados" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Alterar Senha</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          
          <div class="modal-body">
            <form id="edit-user-form">
                <input type="hidden" class="form-control" id="userLogin" name="userLogin" value="<?=$_SESSION["login"]?>">
              <div class="form-group">
                <label for="userPassword">Senha Atual</label>
                <input type="password" class="form-control" id="userPassword" name="userPassword">
              </div>

              <div class="form-group">
                <label for="newUserPassword">Nova Senha</label>
                <input type="password" class="form-control" id="UserNewPassword" name="UserNewPassword">
              </div>
              
              <button type="button" class="btn btn-danger form-control mt-4" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="form-control btn btn-success mt-2">Alterar</button>
            </form>
          </div>
        </div>

      </div>  
    </div>
    
   <div class="modal fade" id="modal-msg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title-modal-msg"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modal-body-msg">
               
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>
    
    <script src="_comp/jquery-3.3.1.min.js"></script>
    <script src="_comp/popper.min.js"></script>
    <script src="_comp/bootstrap/js/bootstrap.min.js"></script>
    <script src="_js/editar-dados.js"></script>
    <script src="_js/excluir-imovel.js"></script>
</body>
</html>

