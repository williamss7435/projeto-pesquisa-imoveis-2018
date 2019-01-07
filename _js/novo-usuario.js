 $(function (){
       $(".loading").fadeOut();
 });

$("#form-new-user").submit(function(e){
        e.preventDefault();
        SalvarNovoUsuario($(this));
    });
           
function SalvarNovoUsuario(dados){
    $(".loading").fadeIn();
    $.ajax({
        url: "../ge/dados/novo-usuario.php",
        method: "POST",
        data: dados.serialize(),
        async: false
    }).done(function(dados){
       var json = JSON.parse(dados);
        if(json.status){ 
            dataNewUser(json);
        }else{
            FailnewUser();
        }     
    }).fail(function(){
        console.log("Erro");
    }).always(function(){
        $(".loading").fadeOut();
    });
}

function dataNewUser(json){
    var retorno = "<ul class='list-group'>";  
        retorno += "<li class='list-group-item'>Login: <strong>" + json.login +"</strong></li>";
        retorno += "<li class='list-group-item'>Senha Temporária: <strong>" + json.senha +"</strong></li>";
    retorno += "</ul>";
    
    $("#title-modal-msg").html("<span class='oi oi-circle-check'></span> Usuário Salvo Com Sucesso");  
    $("#modal-body-msg").html(retorno);
    modalShow();
    cleanData();
};

function FailnewUser(json){
    var retorno = "<ul class='list-group'>";  
        retorno += "<li class='list-group-item'>Verifique Se E-mail Já Foi Cadastrado</li>";
    retorno += "</ul>";
    
    $("#title-modal-msg").html("<span class='oi oi-circle-x'></span>  Erro no Cadastro");  
    $("#modal-body-msg").html(retorno);
    modalShow();
    cleanData();
}

function cleanData(){
    
    $("#newUserName").val("");
    $("#newUserLastName").val("");
    $("#newUserEmail").val("");
    $("#newUserOffice").val("");
    $('#newUserSetor').val("Escolher...");
    
}

function modalShow(){
    $("#modal-msg").modal({
              show: true
    });
}
