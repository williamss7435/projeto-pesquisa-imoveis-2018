 $(function (){
       $(".loading").fadeOut();
 });

$("#form-new-immobile").submit(function(e){
    e.preventDefault();
    $(".loading").fadeIn();
    
    var preco = $("#preco").val().replace(',', '');
    var subsidio = $("#subsidio").val().replace(',', ''); 
    $("#preco").val(preco);
    $("#subsidio").val(subsidio);
    
    $.ajax({
        url: "../ge/dados/novo-imovel.php",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false  
    }).done(function(dados){
        console.log(dados);
        if(dados == 1){
            sucessNewImovel();
            cleanImmobileInput();
        }else{
            failNewImovel();
        }
    }).always(function(){
        $(".loading").fadeOut();
    });
        
    });
    
function sucessNewImovel(){
    var retorno = "<ul class='list-group'>";  
        retorno += "<li class='list-group-item'>O Imóvel Foi Salvo Com Sucesso</li>";
    retorno += "</ul>";
    
    $("#title-modal-msg").html("<span class='oi oi-circle-check'></span>Sucesso");  
    $("#modal-body-msg").html(retorno);
        
    $("#modal-msg").modal({
              show: true
    });
};

function failNewImovel(){
    var retorno = "<ul class='list-group'>";  
        retorno += "<li class='list-group-item'>O Imóvel não foi salvo por alguns desses motivos:<br>-Nome Do Imóvel Já Foi Cadastrado <br>- Fotos Com o Formato Inválido</li>";
    retorno += "</ul>";
    
    $("#title-modal-msg").html("<span class='oi oi-circle-x'></span> Erro");  
    $("#modal-body-msg").html(retorno);
        
    $("#modal-msg").modal({
              show: true
    });
};

$("#cep").blur(function (){
   var cep = $(this).val();
   
   if(cep.length >= 8){
        $("#rua").val("...");
        $("#bairro").val("...");
        $("#cidade").val("...");          
       
       $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados){
        $("#rua").val(dados.logradouro);
        $("#bairro").val(dados.bairro);
        $("#cidade").val(dados.localidade);
        $("#estado").val(dados.uf);           
       });
   }
});

function cleanImmobileInput(){
        $("#nome").val("");
        $("#cep").val("");
        $("#rua").val("");
        $("#numero").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#estado").val("Escolha...");
        $("#preco").val("");     
        $("#metragem").val(40);
        $("#valMet").html("40 M²");
        $("#quartos").val(2);
        $("#faixaMCMV").val("");
        $("#subsidio").val("");
        $("#visualizacao").val(0);
        $("#dataEntrega").val("");
        $("#descricao").val("");
        $("#qntImages").val(0);
        $("#div-images input").remove();
        //Variavel Global Cadastro.js
        numImages = 0;
}