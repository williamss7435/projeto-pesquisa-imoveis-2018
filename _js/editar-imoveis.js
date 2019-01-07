 $(function (){
        listImmobiles(null,2);
       $(".loading").fadeOut(1000);
 });
 
 $("#btnSeach").click(function(){
    listImmobiles($("#inputSeach").val());
});

$(document).keypress(function(e) {
    if(e.which == 13) {
        listImmobiles($("#inputSeach").val());
    }
});
 
$("#edit-immobile-form").submit(function(e){
        e.preventDefault();
        editImmobile($(this));
 });
 
 function editImmobile(dados){
    $(".loading").fadeIn();
    var preco = $("#preco").val().replace(',', '');
    var subsidio = $("#subsidio").val().replace(',', ''); 
    $("#preco").val(preco);
    $("#subsidio").val(subsidio);
    
    $.ajax({
        url: "../ge/dados/editar-imovel.php",
        method: "POST",
        data: dados.serialize()
    }).done(function(dados){
       if(dados == 1){
             sucessEditImmobile();
             listImmobiles(null,2);
        }
        else{
            failEditImmobile();
            listImmobiles(null,2);
        }
    }).fail(function(){
        console.log("Erro");
    }).always(function (){
        $(".loading").fadeOut();
    });
}

function photoImmobile(seach){
       $(".loading").fadeIn();
       $.ajax({
        url: "../ge/dados/listar-fotos.php",
        method: "POST",
        dataType:"json",
        data: ({seach: seach})
    }).done(function (dados){
        console.log(dados);
        $("#id-imovel").val(seach);
        var retorno = "";
            
            $.each(dados, function(i, value){
                retorno += "<div class='card col-4 p-2' style='width: 18rem;'>";
                retorno +=  "<img class='card-img-top' src=fotos/" + value.url_foto +  ">";
                retorno +=  "<div class='card-body'>";
                 retorno += "<button class=" + "'btn btn-danger form-control' onclick=" + "deletePhoto('" + value.id_foto +"')" + "><span class='d-none d-sm-block'>Excluir</span><span class='d-md-none d-lg-none d-xl-none'>X</span></button>";
                retorno += "</div></div></div></div>";
            });
            
            $("#row-photos").html(retorno);
            
    }).fail(function(dados){
        console.log(dados);
    }).always(function(){
         $(".loading").fadeOut();
         $("#modal-photo").modal('show');
    });
}

function deletePhoto(seach){
      if(confirm("Tem certeza que deseja excluir essa foto?")){
            var id = seach;
            $("#modal-photo").modal('hide');
            $(".loading").fadeIn();
            $.ajax({
             url: "../ge/dados/excluir-foto.php",
             method: "POST",
             dataType:"json",
             data: ({seach: seach})
         }).done(function (dados){    
             if(dados == 1){
                 sucessDeletePhoto();
             }
             else{
                 failDeletePhoto();
             }
         }).fail(function(dados){
             console.log(dados);
         }).always(function(){
              listImmobiles(null,2);
              $(".loading").fadeOut();
         });
      }
}

$("#edit-photo-form").submit(function(e){
    e.preventDefault();
    $(".loading").fadeIn();
   
    
    $.ajax({
        url: "../ge/dados/nova-foto.php",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false  
    }).done(function(dados){
        console.log(dados);
        if(dados == 1){
            sucessAddPhoto();
            cleanPhotos();
            listImmobiles(null,2);
        }else{
            failAddPhoto()();
        }
    }).always(function(){
        $(".loading").fadeOut();
    });
        
    });

function dataImmobile(seach){
       $(".loading").fadeIn();
       $.ajax({
        url: "../ge/dados/listar-imoveis.php",
        method: "POST",
        dataType:"json",
        data: ({seach: seach,tipo: 1})
    }).done(function (dados){
        listarDados(dados);
        
    }).fail(function(dados){
        console.log(dados);
    }).always(function(){
         $(".loading").fadeOut();
    });
    
}

function listImmobiles(seach){
     $(".loading").fadeIn();
    $.ajax({
        url: "../ge/dados/listar-imoveis.php",
        method: "POST",
        dataType:"json",
        data: ({seach: seach,tipo: 2})
    }).done(function (dados){
        var table = "";
        $.each(dados, function(i, value){
            table += "<tr>" ;
                table += "<td>" + value.nm_imovel +  "</td>";
                table += "<td>" + value.sg_estado_imovel + "</td>";
                table += "<td>" + value.bairro_imovel + "</td>";
                table += "<td>" + value.cidade_imovel + "</td>";
                table += "<td>" + value.rua_imovel + "</td>";
                table += "<td><button class=" + "'btn btn-warning btn-sm m-0' onclick=" + "dataImmobile('" + value.id_imovel +"')" + ">Editar Dados</button></td>";
                table += "<td><button class=" + "'btn btn-primary btn-sm m-0' onclick=" + "photoImmobile('" + value.id_imovel +"')" + ">Editar Fotos</button></td>";
            table += "</tr>" ;
        });

        $("#immobiles").html(table); 
        
    }).fail(function(dados){
        console.log(dados);
    }).always(function(){
         $(".loading").fadeOut();
    });
}

function listarDados(dados){
        $("#title-modal-immobile").html(dados[0].nm_imovel);
        $("#id").val(dados[0].id_imovel);
        $("#nome").val(dados[0].nm_imovel);
        $("#cep").val(dados[0].cep_imovel);
        $("#rua").val(dados[0].rua_imovel);
        $("#numero").val(dados[0].nm_rua_imovel);
        $("#bairro").val(dados[0].bairro_imovel);
        $("#cidade").val(dados[0].cidade_imovel);
        $("#estado").val(dados[0].sg_estado_imovel);
        $("#preco").val(dados[0].vl_preco_imovel);     
        $("#metragem").val(dados[0].metragem_imovel);
        $("#valMet").text(dados[0].metragem_imovel + " M²");
        $("#quartos").val(parseInt(dados[0].qnt_quartos_imovel));
        $("#faixaMCMV").val(parseInt(dados[0].faixa_mcmv_imovel));
        $("#subsidio").val(dados[0].vl_subsidio_mcmv_imovel);
        $("#visualizacao").val(parseInt(dados[0].visualizacao_imovel));
        $("#dataEntrega").val(dados[0].dt_entrega_imovel);
        $("#descricao").val(dados[0].descricao_imovel);  
        $("#modal-immobile").modal({show:true});
}

function sucessEditImmobile(){
    var retorno = "<ul class='list-group'>";  
        retorno += "<li class='list-group-item'><strong>Dados Do Imóvel Alterados Com Sucesso</strong></li>";
    retorno += "</ul>";
    
    $("#title-modal-msg").html("<span class='oi oi-circle-check'></span> Sucesso");  
    $("#modal-body-msg").html(retorno);
    $("#modal-immobile").modal('hide');
    modalShow();
    
};

function failEditImmobile(){
    var retorno = "<ul class='list-group'>";  
        retorno += "<li class='list-group-item'><strong>Esse Nome Já Foi Cadastrado</strong></li>";
    retorno += "</ul>";
    
    $("#title-modal-msg").html("<span class='oi oi-circle-x'></span> Erro Na Edição");  
    $("#modal-body-msg").html(retorno);
    $("#modal-immobile").modal('hide');
    modalShow();
    
};

function sucessDeletePhoto(){
    var retorno = "<ul class='list-group'>";  
        retorno += "<li class='list-group-item'><strong>A Foto Foi Excluida Com Sucesso</strong></li>";
    retorno += "</ul>";
    $("#title-modal-msg").html("<span class='oi oi-circle-check'></span> Sucesso");  
    $("#modal-body-msg").html(retorno);
    modalShow();
    
};

function failDeletePhoto(){
    var retorno = "<ul class='list-group'>";  
        retorno += "<li class='list-group-item'><strong>Problema com a conexão, tente novamente mais tarde.</strong></li>";
    retorno += "</ul>";
    
    $("#title-modal-msg").html("<span class='oi oi-circle-x'></span> Erro");  
    $("#modal-body-msg").html(retorno);
    $("#modal-immobile").modal('hide');
    modalShow();
    
};

function sucessAddPhoto(){
    var retorno = "<ul class='list-group'>";  
        retorno += "<li class='list-group-item'><strong>A foto foi adicionada com sucesso</strong></li>";
    retorno += "</ul>";
    
    $("#title-modal-msg").html("<span class='oi oi-circle-check'></span> Sucesso");  
    $("#modal-body-msg").html(retorno);
    $("#modal-photo").modal('hide');
    modalShow();
};

function failAddPhoto(){
    var retorno = "<ul class='list-group'>";  
        retorno += "<li class='list-group-item'><strong>Falha no envio da foto<br>Verifique se a foto está no formato certo.</strong></li>";
    retorno += "</ul>";
    
    $("#title-modal-msg").html("<span class='oi oi-circle-x></span> Erro");  
    $("#modal-body-msg").html(retorno);
    $("#modal-photo").modal('hide');
    modalShow();
};

function cleanPhotos(){
        $("#qntImages").val(0);
        $("#div-images input").remove();
        //Variavel Global Cadastro.js
        numImages = 0;
}