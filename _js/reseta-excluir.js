$(function (){
   listUser(null);
   $(".loading").fadeOut();
});

$("#btnSeach").click(function(){
    listUser($("#inputSeach").val());
});

$(document).keypress(function(e) {
    if(e.which == 13) {
        listUser($("#inputSeach").val());
    }
});

function listUser(seach){
    $(".loading").fadeIn();
    $.ajax({
        url: "../ge/dados/listar-usuarios.php",
        method: "POST",
        dataType:"json",
        data: ({seach: seach})
    }).done(function (dados){
        console.log(dados);
        var table = "";
        $.each(dados, function(i, value){
            table += "<tr>" ;
                table += "<td>" + value.nm_usuario +  "</td>";
                table += "<td>" + value.login_usuario + "</td>";
                table += "<td>" + definirTipoUsuario(value.tipo_usuario) + "</td>";
                table += "<td><button class=" + "'btn btn-warning btn-sm m-0' onclick=" + "resetPassword('" + value.login_usuario +"')" + ">Resetar Senha</button></td>";
                table += "<td><button class=" + "'btn btn-danger btn-sm m-0' onclick=" + "deleteUser('" + value.login_usuario +"')" + ">Excluir Conta</button></td>";
            table += "</tr>" ;
        });

        $("#users").html(table); 
        
    }).fail(function(dados){
        console.log(dados);
    }).always(function (){
        $(".loading").fadeOut();
    });
}

function resetPassword(login){
    if(confirm("Tem Certeza Que Deseja Resetar a Senha Do Usuario " + login + " ?")){
        $(".loading").fadeIn();
        $.ajax({
           url: "../ge/dados/resetar-senha.php",
           method: "POST",
           dataType: 'json',
           data: ({login: login})
       }).done(function (dados){
           if(dados.status)
                 sucessUser(dados,1);
           else
               fail();
       }).always(function (){
        $(".loading").fadeOut();
       });    
    } 
}

function deleteUser(login){
    if(confirm("Tem Certeza Que Deseja Deletar o  Usuario " + login + " ?")){
        $(".loading").fadeIn();
        $.ajax({
           url: "../ge/dados/excluir-usuario.php",
           method: "POST",
           dataType: 'json',
           data: ({login: login})
       }).done(function (dados){
           if(dados == 1){
                 sucessUser(dados,2);
                 listUser(null);
           }
           else
               failUser();
       }).always(function (){
          $(".loading").fadeOut();
       });   
    } 
}

function sucessUser(json, num){
    var msg;
    var title;
    if(num === 1){
        msg = "<li class='list-group-item'>Login: <strong>" + json.login +"</strong></li>" + "<li class='list-group-item'>Nova Senha: <strong>" + json.novaSenha +"</strong></li>";
        title = "<span class='oi oi-circle-check'></span> Senha Resetada Com Sucesso";
    }else if (num === 2){
        msg = "<li class='list-group-item'>Conta Deletada Com Sucesso</strong></li>";
        title = "<span class='oi oi-circle-check'>Sucesso</span>";
    }
  
     var retorno = "<ul class='list-group'>";  
        retorno += msg;
    retorno += "</ul>";
    
    $("#title-modal-msg").html(title);  
    $("#modal-body-msg").html(retorno);
    modalShow();
}

function failUser(){
    var retorno = "<ul class='list-group'>";  
        retorno += "<li class='list-group-item'> Ocorreu Um Problema Com a Conexão</li>";
    retorno += "</ul>";
    
    $("#title-modal-msg").html("<span class='oi oi-circle-x'></span> Erro");  
    $("#modal-body-msg").html(retorno);
    modalShow();
}

function definirTipoUsuario(tipoUsuario){
     switch (tipoUsuario){
                case "1":
                    return "Telemarketing";
                case "2":
                    return  "Chat";
                case "3":
                    return "Corretor";
                case "9":
                    return "Administrador";
                default:
                    "Indefinido";
            }
}