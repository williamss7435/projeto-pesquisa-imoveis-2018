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
                        <a href="tenda-admin-editar-imovel.php" class="nav-link bg-primary"><span class="oi oi-pencil"></span> Editar</a>
                        <a href="tenda-admin-excluir-imovel.php" class="nav-link mb-3"><span class="oi oi-trash"></span> Excluir</a>
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
    
<!--Inicio Modal  Dados Imovel-->
    <div class="modal" id="modal-immobile" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header header-modal-immobile">
        <h3 class="modal-title" id="title-modal-immobile">Nome Do Residencial</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
      <div class="modal-body">
          
         <form id="edit-immobile-form" method="post" class="mt-3" enctype="multipart/form-data">

                    <div class="form-group mt-3">
                      <label for="name">Nome Do Residencial</label>
                      <input type="text" class="form-control" id="nome" name="nome" required>
                      <input type="text" id="id" name="id" hidden>
                    </div>

                      <div class="row">
                        <div class="col text-center bg-light">
                          <span class="h4">Endereço</span>
                        </div>

                     </div>

                    <div class="row">

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="cep">CEP</label>
                          <input type="number" class="form-control" id="cep" name="cep" maxlength="8" required>
                        </div>
                      </div>  

                    </div>

                    <div class="row">

                      <div class="col-lg-8">
                        <div class="form-group">
                          <label for="rua">Rua</label>
                          <input type="text" class="form-control" id="rua" name="rua" required>
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="rua">Número</label>
                          <input type="number" class="form-control" id="numero" name="numero" required>
                        </div>
                      </div>
                      
                    </div>


                    <div class="row">

                      <div class="col-lg-5">
                        <div class="form-group">
                          <label for="bairro">Bairro</label>
                          <input type="text" class="form-control" id="bairro" name="bairro" required>
                        </div>
                      </div>

                      <div class="col-lg-5">
                        <div class="form-group">
                          <label for="cidade">Cidade</label>
                          <input type="text" class="form-control" id="cidade" name="cidade" required>
                        </div>
                      </div>
                      

                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="estado">Estado</label>
                          <select class="custom-select mr-sm-2" id="estado" name="estado" required>
                              <option selected value="">Escolha...</option>
                                <option value="AC">AC</option>
                                <option value="AL">AL</option>
                                <option value="AP">AP</option>
                                <option value="AM">AM</option>
                                <option value="BA">BA</option>
                                <option value="CE">CE</option>
                                <option value="DF">DF</option>
                                <option value="ES">ES</option>
                                <option value="GO">GO</option>
                                <option value="MA">MA</option>
                                <option value="MT">MT</option>
                                <option value="MS">MS</option>
                                <option value="MG">MG</option>
                                <option value="PA">PA</option>
                                <option value="PB">PB</option>
                                <option value="PR">PR</option>
                                <option value="PE">PE</option>
                                <option value="PI">PI</option>
                                <option value="RJ">RJ</option>
                                <option value="RN">RN</option>
                                <option value="RS">RS</option>
                                <option value="RO">RO</option>
                                <option value="RR">RR</option>
                                <option value="SC">SC</option>
                                <option value="SP">SP</option>
                                <option value="SE">SE</option>
                                <option value="TO">TO</option>
                        </select>
                        </div>
                      </div>

                    </div>
                    

                    <div class="row">

                        <div class="col text-center bg-light">
                          <span class="h4">Informações Do Residencial</span>
                        </div>

                     </div>

                     <div class="row mt-4">

                        <div class="col-12 col-lg-6 my-1">
                          <div class="form-group">
                            <label for="preco">Preço Por Unidade</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">R$</span>
                                </div>
                                 <input type="text" class="form-control" id="preco" name="preco" required>
                              </div>
                          </div>
                        </div>
                        
                        <div class="col-12 col-lg-6 my-1">
                          <label class="mr-sm-2" for="quartos">Quantidade De Quartos</label>
                          <select class="custom-select mr-sm-2" id="quartos" name="quartos" required>
                            <option value="2" selected>1 ou 2 Quartos</option>
                            <option value="3">1, 2 ou 3 Quartos</option>
                          </select>
                        </div>
                         
                        <div class="col-12 my-1 text-center">
                          <div class="form-group">
                            <label for="metragem" id="lblMetragem" class="text-center">Metragem: <div id="valMet"></div></label>
                            <input id="metragem" name="metragem" class="form-control" type="range" min="35" max="150" step="0.1" value="" oninput="showValue(this.value)" required/>
                          </div>
                        </div>              
                     </div>

                     <div class="row mt-4 row-mcmv">

                       <div class="col-6 my-1">
                          <label class="mr-sm-2" for="faixaMCMV">Programa Minha Casa Minha Vida</label>
                          <select class="custom-select mr-sm-2" id="faixaMCMV" name="faixaMCMV" required="required">
                            <option selected val="">Escolha A Faixa Do Programa</option>
                            <option value="0">Não Participa</option>
                            <option value="1">Faixa 1,5</option>
                            <option value="2">Faixa 2</option>
                            <option value="3">Faixa 3</option>
                          </select>
                        </div>
                        

                        <div class="col-6 my-1">
                          <div class="form-group">
                            <div class="form-group">
                            <label for="preco">Valor Máximo Do Subsidio</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">R$</span>
                                </div>
                                 <input type="text" class="form-control" id="subsidio" name="subsidio" required>
                              </div>
                          </div>
                          </div>
                        </div>

                     </div>

                     <div class="row mt-4">

                        <div class="col-6 my-1">
                          <label class="mr-sm-2" for="visualizacao">Quem pode Visualizar O imovel</label>
                          <select class="custom-select mr-sm-2" id="visualizacao" name="visualizacao" required>
                            <option value="0" selected>Todos</option>
                            <option value="2">Apenas o Chat</option>
                            <option value="1">Apenas a Telefonia</option>
                            <option value="">Apenas os Corretores</option>
                          </select>
                        </div>

                        <div class="col-6 my-1">
                          <label for="dataEntrega">Data Prevista de entrega</label>
                          <input type="date" class="form-control" id="dataEntrega" name="dataEntrega" required>
                        </div>
                                
                     </div>
                    

                    <div class="row mt-4">
                      <div class="col">
                        <label for="descricao">Descrição Do Imóvel (Máximo 250 palavras) </label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3"  maxlength="250"></textarea>
                      </div>
                    </div>
                            
                    <div class="row">
                      <div class="col mb-2">
                        <button type="button" class="btn btn-lg btn-danger form-control mb-3 mt-5" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-lg btn-success form-control mb-4" type="submit">Alterar Dados</button>
                      </div>
                    </div>
                    
                   </form>
          
      </div>
   
    </div>
  </div>
</div>
<!--FIm Modal  Dados Imovel-->   

<!-- Modal Fotos-->
<div class="modal" id="modal-photo" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header header-modal-immobile">
        <h3 class="modal-title" id="title-modal-immobile">Fotos</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
      <div class="modal-body">
          <div class="container">
              <div class="row">
                        <div class="col text-center bg-light mb-3">
                            <span class="h3">Fotos Enviadas</span></span>
                        </div>
              </div>
              <div class="row" id="row-photos">
                  
              </div>
         </div>
          
         <form id="edit-photo-form"  method="post" class="mt-3" enctype="multipart/form-data">
             
             <input type="text" id="id-imovel" name="id-imovel" hidden readonly>
                      <div class="row mt-4">

                        <div class="col text-center bg-light">
                            <span class="h3">Adicionar Mais Fotos</span><br><span class="h5 text-danger">* Apenas fotos com formato JPG</span><br><span class="h5 text-danger">* Tamanho Limite 1 MB</span>
                        </div>

                     </div>


                    <div class="row mt-3">
                      <div class="col-6">
                        <button type="button" class="btn btn-primary btn-lg btn-block" id="btn-image-add"><span class="oi oi-image"></span> Adicionar Foto</button><input type="hidden" name="qntImages" id="qntImages" value="0">
                      </div>
                      
                      <div class="col-6">
                        <button type="button" class="btn btn-danger btn-lg btn-block" id="btn-image-remove"><span class="oi oi-delete"></span> Remover Foto</button>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col">
                        <div class="mt-4 mb-4" id="div-images">
                          
                        </div>
                      </div>
                    </div>

      
                 <div class="row">
                      <div class="col mb-2">
                        <button class="btn btn-lg btn-success form-control mt-5" type="submit">Enviar Fotos</button>
                        <button type="button" class="btn btn-lg btn-danger form-control mb-4 mt-3" data-dismiss="modal">Voltar</button>
                      </div>
                    </div>
             
         </form>
          
      </div>
   
    </div>
  </div>
</div>
<!-- Fim Modal Fotos-->



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
    <script src="_comp/jquery.maskMoney.min.js"></script>
    <script src="_js/cadastro.js"></script>
    <script src="_js/editar-imoveis.js"></script>
</body>
</html>

