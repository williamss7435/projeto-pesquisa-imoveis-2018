 $(function (){
       listImmobiles(null,2);
       $(".loading").fadeOut();
 });
 
  $("#btnSeach").click(function(){
    listImmobiles($("#inputSeach").val());
});

$(document).keypress(function(e) {
    if(e.which == 13) {
        listImmobiles($("#inputSeach").val());
    }
});
 
 function listImmobiles(seach){
     $(".loading").fadeIn();
    $.ajax({
        url: "../ge/dados/listar-imoveis.php",
        method: "POST",
        dataType:"json",
        data: ({seach: seach,tipo: 2})
    }).done(function (dados){
        console.log(dados);
        var table = "";
        $.each(dados, function(i, value){
            table += "<tr>" ;
                table += "<td>" + value.nm_imovel +  "</td>";
                table += "<td>" + value.sg_estado_imovel + "</td>";
                table += "<td>" + value.bairro_imovel + "</td>";
                table += "<td>" + value.cidade_imovel + "</td>";
                table += "<td>" + value.rua_imovel + "</td>";
                table += "<td><button class=" + "'btn btn-danger btn-sm m-0' onclick=" + "deleteImmobile('" + value.id_imovel +"')" + ">Excluir</button></td>";
            table += "</tr>" ;
        });

        $("#immobiles").html(table); 
        
    }).fail(function(dados){
        console.log(dados);
    }).always(function(){
         $(".loading").fadeOut();
    });
}

function deleteImmobile(seach){
   if(confirm("Tem certeza que deseja deletar o Imóvel ?")){
       $(".loading").fadeIn();
       $.ajax({
        url: "../ge/dados/excluir-imovel.php",
        method: "POST",
        dataType:"json",
        data: ({seach: seach})
    }).done(function (dados){
        console.log(dados);    
        if(dados == 1)
            sucessDeleteImmobile();
        else
            failDeleteImmobile();
        
    }).fail(function(dados){
        console.log(dados);
    }).always(function(){
         listImmobiles(null,2);
         $(".loading").fadeOut();
    });
   }
}

function sucessDeleteImmobile(){
    var retorno = "<ul class='list-group'>";  
        retorno += "<li class='list-group-item'><strong>O imóvel foi excluido com sucesso</strong></li>";
    retorno += "</ul>";
    
    $("#title-modal-msg").html("<span class='oi oi-circle-check'></span> Sucesso");  
    $("#modal-body-msg").html(retorno);
    modalShow();
    
};

function failDeleteImmobile(){
    var retorno = "<ul class='list-group'>";  
        retorno += "<li class='list-group-item'><strong>Problema com a conexão, tente novamente mais tarde.</strong></li>";
    retorno += "</ul>";
    
    $("#title-modal-msg").html("<span class='oi oi-circle-x'></span> Erro");  
    $("#modal-body-msg").html(retorno);
    modalShow();
    
};