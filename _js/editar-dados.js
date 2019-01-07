   
   $("#edit-user-form").submit(function(e){
        e.preventDefault();
        editarDados($(this));
    });
           
function editarDados(dados){    
    $.ajax({
        url: "../ge/dados/editar-usuario.php",
        method: "POST",
        data: dados.serialize(),
    }).done(function(dados){
       var json = JSON.parse(dados);
        if(json.status){ 
            dataEditUser(json);
        }else{
            FailEditUser();
        }
        
    }).fail(function(){
        console.log("Erro");
    });
}

function dataEditUser(json){
    var retorno = "<ul class='list-group'>";  
        retorno += "<li class='list-group-item'>Login: <strong>" + json.login +"</strong></li>";
        retorno += "<li class='list-group-item'>Nova Senha: <strong>" + json.senha +"</strong></li>";
    retorno += "</ul>";
    
    $("#title-modal-msg").html("<span class='oi oi-circle-check'></span> Senha Alterada Com Sucesso");  
    $("#modal-body-msg").html(retorno);
    $("#modal-dados").modal('hide');
    cleanInputPassword();
    modalShow();

};

function FailEditUser(json){
    var retorno = "<ul class='list-group'>";  
        retorno += "<li class='list-group-item'>- Digite a senha atual corretamente</li>";
    retorno += "</ul>";
    
    $("#title-modal-msg").html("<span class='oi oi-circle-x'></span> Senha Inválida ");  
    $("#modal-body-msg").html(retorno);
    $("#modal-dados").modal('hide');
    cleanInputPassword();
    modalShow();

}

function cleanInputPassword(){
    $("#userPassword").val("");
    $("#UserNewPassword").val("");
}

function modalShow(){
    $("#modal-msg").modal({
              show: true
    });
}