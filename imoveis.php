<?php require_once "config-user.php";?>
<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="_img/logo-tenda-35x35.png">
    <title>Login</title>
    <link rel="stylesheet" href="_comp/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="_comp/icon/font/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="_comp/gallery/css/blueimp-gallery.min.css">
    <link rel="stylesheet" href="_css/imoveis.css">
    <link rel="stylesheet" href="_comp/DataTables/datatables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
</head>
<body>
     <div class="loading text-center"><img src="_img/gif-tenda.gif" id="img-load" class="img-fluid"></div>
    <nav class="navbar navbar-expand-lg navbar-main">
        <a href="#" class="navbar-brand d-none d-lg-block"><img src="_img/logo-tenda-156x42.png" alt=""></a>
        
       <div class="dropdown">
            <a class=""  id="seach-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pesquisa <small class="oi oi-chevron-bottom"></small>
            </a>
            <div class="dropdown-menu" aria-labelledby="seach-menu">
              <a class="dropdown-item" href="#">Preço</a>
              <a class="dropdown-item" href="#">Data De Entrega</a>
              <a class="dropdown-item" href="#">Faixa MCMV</a>
            </div>
          </div>

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
  
    
    
    <section class="m-3">
      <div class="container mt-3 pesquisa bg-red">
        <div class="row title-pesquisa text-white">Procurar</div>
      <div class="row">

        <div class="col-12 p-0 ">
            
            <div class="input-group">
                <div class="input-group-append">
                    <button class="btn" id="btn-seach" type="button"><span class="oi oi-magnifying-glass"></span></button>
                </div>
            <input list="list-seach" class="form-control" id="input-seach" placeholder="Procurar por Nome, Bairro, Rua, Cidade Ou Ponto De Referência">
            </div>
          <datalist id="list-seach">
   
          </datalist>
        </div>
      </div>
      </div>
    </div>
    </section>
  
       <section class="m-3">
      <div class="container-fluid mt-3 pesquisa bg-red">
        <div class="row title-pesquisa text-white">Imóveis</div>
        <div class="row"></div>
      <div class="row">

        <div class="col-12 p-0">
          
            <table class="text-center table-hover" id="tb">
            <thead class="head-pesquisa">
              <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Estado</th>
                <th>Bairro</th>
                <th>Preço</th>
                <th>Faixa</th>
                <th>Subsidio</th>
                <th>M²</th>
                <th>Entrega</th>
              </tr>
            </thead>
            <tbody>
       
            </tbody>
          </table>

        </div>
      </div>
      </div>
    </div>
    </section>
    
    
    <!-- Modal Imovel -->
   
<div class="modal" id="modal-immobile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="_img/logo-42x42.png"><h5 class="modal-title mt-2 ml-3" id="info-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4 bg-red" id="result">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-3">
          <ul class="list-group list-group" id="list-immobile">
              <li class="list-group-item"><strong>Preço:</strong> <span id="info-preco"></span></li>
            <li class="list-group-item"><strong>Estado:</strong> <span id="info-estado"></span></li>
            <li class="list-group-item"><strong>Faixa:</strong> <span id="info-faixa"></span></li>
            <li class="list-group-item"><strong>Subsidio:</strong> <span id="info-subsidio"></span></li>
            <li class="list-group-item"><strong>Data De Entrega:</strong> <span id="info-data"></span></li>
            <li class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><strong>Descrição</strong></h5>
                </div>
                <p class="mb-1" id="info-descricao"></p>
              </li>
          </ul>                        
                        </div>
                        
                        <div class="col-12 col-lg-9">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                  <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-maps" role="tab" aria-controls="nav-maps" aria-selected="true">Mapa</a>
                                  <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-photos" role="tab" aria-controls="nav-photos" aria-selected="false">Fotos</a>
                                </div>
                              </nav>
                              <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-maps" role="tabpanel">    
                                    <iframe
                                        id="mapa"
                                        width="100%"
                                        height="450px"
                                        frameborder="0" style="border:0"
                                        src="">
                                     </iframe>
                                </div>
                                  <div class="tab-pane fade" id="nav-photos" role="tabpanel">
                                              
                                    <div id="links" class="row">
                                        
                                        
                                    </div>            
                                          
                                      </div>
                                  </div>
                              </div>    
                        </div>
                            
                     </div>  
                </div>
            
            </div>
        </div>
    </div>
</div>
    <!-- Fim Modal Imovel -->
    
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
    
      <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
    
    <script src="_comp/jquery-3.3.1.min.js"></script>
    <script src="_comp/popper.min.js"></script>
    <script src="_comp/bootstrap/js/bootstrap.min.js"></script>
    <script src="_comp/icon/font/css/open-iconic-bootstrap.min.css"></script>
    <script src="_comp/DataTables/datatables.min.js"></script>
    <script src="_comp/clipboard.min.js"></script>
    <script src="_js/editar-dados.js"></script>
    <script src="_comp/gallery/js/jquery.blueimp-gallery.min.js"></script>
    <script src="_js/imoveis.js"></script>
</body>
</html>