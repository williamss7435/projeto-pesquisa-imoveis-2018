$(function(){
    
       loadDataList();
        $('#tb').DataTable({
            autoWidth: false,
            processing: false,
            paging:false,
            scrollY: 345,
            searching: false,
            info: false,
            responsive: false,
            "columnDefs": [
                { "width": "30%", "targets": 1 },
                { "width": "10%", "targets": 0 },
                {"width": "20%", "targets": 3 },
                {"width": "10%", "targets": 4 },
                {"width": "10%", "targets": 6 },
              ]
           });
           
           $(".loading").fadeOut();
});

  document.getElementById('links').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = {index: link, event: event},
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};

$("#btn-seach").click(function(){
   seachImmobiles($("#input-seach").val());
});

$(document).keypress(function(e) {
    if(e.which == 13) {
        seachImmobiles($("#input-seach").val());
    }
});

function seachImmobiles(seach){
    $(".loading").fadeIn();
    $.ajax({
        url: "../ge/dados/pesquisa-imoveis.php",
        method: "POST",
        dataType:"json",
        data:({ seach: seach })
    }).done(function (dados){
        console.log(dados);
        formatItens(dados);
    }).always(function(){
        $(".loading").fadeOut();
    });
}



function loadDataList(){ 
  $(".loading").fadeIn();
  $.ajax({
        url: "../ge/dados/datalist-endereco.php",
        dataType:"json"
    }).done(function (dados){
        var itens = "";
        $.each(dados, function(i, value){
            itens += "<option value='"+dados[i].value+"'>";
        });
        $("#list-seach").html(itens);
    }).always(function(){
          $(".loading").fadeOut();
    });
        
   }

function numberToReal(numero) {
    var numero = numero.toFixed(2).split('.');
    numero[0] = "R$ " + numero[0].split(/(?=(?:...)*$)/).join('.');
    return numero.join(',');
}

function formatDate(date){
        var d = new Date(date);
        var day =  "" + (d.getDate()+1);
        var month = "" + (d.getMonth()+1);
        var year = d.getFullYear();
        
        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
         
        return day + "/" + month + "/" + year;
}

function infoImmobile(id){
    $(".loading").fadeIn();
    $.ajax({
        url: "../ge/dados/dados-imoveis.php",
        method: 'POST',
        dataType: 'json',
        data:({seach: id})
    }).done(function(dados){
        console.log(dados);
        var foto = "";
        var maps =  dados.rua + "+" + dados.numero + "+" + dados.cidade + "+" + dados.estado;
        maps.replace(" ","+");
        
        $("#links").html("");
        $('#nav-tab a[href="#nav-maps"]').tab('show');
        
        $("#info-title").html(dados.nome);
        $("#info-preco").html(numberToReal(parseFloat(dados.preco)));
        $("#info-estado").html(dados.estado);
        $("#info-faixa").html(dados.faixa);
        $("#info-subsidio").html(numberToReal(parseFloat(dados.subsidio)));
        $("#info-data").html(formatDate(dados.data_entrega));
        $("#info-descricao").html(dados.descricao);
        if(dados.foto != 0){
         $.each(dados.foto, function(i, value){
                foto +=    "<div class='card col-4' style='width: 18rem;'>";
            foto +=         "<a href='fotos/"+ value + "'>";
            foto +=             "<img class='card-img-top' src='fotos/"+ value +"'>";
            foto +=         "</a>";
            foto +=    "</div>";
            
         });
         $("#links").html(foto);
        }
       
       $("#mapa").attr('src',"https://www.google.com/maps/embed/v1/place?key=AIzaSyBalgHLG24ehGJOZBipr6WQnCkZnsQI4pE&q="+maps);
        $("#modal-immobile").modal('show');
        
    }).fail(function(dados){
       console.log(dados); 
    }).always(function(){
        $(".loading").fadeOut();
    });
}

function formatItens(dados){
           var descricao;
           var format = "";
              $.each(dados, function(i, value){
                  
              descricao = value.nm_imovel + "&raquo" + " A partir de " + numberToReal(parseFloat(value.vl_preco_imovel)) + " &bull; " + "Local: " + value.cidade_imovel + ". " + value.descricao_imovel;
              format += "<tr>";
                    format += "<th class='text-center'>";
                format +=  "<button id='c1' class='m-1 btn btn-primary btn-sm d-none d-xl-inline' data-clipboard-text='"+descricao+"'><span class='oi oi-pencil'></span></button>";
                format +=  " <button class='btn btn-success btn-sm' onclick='infoImmobile("+ value.id_imovel +")'><span class='oi oi-globe'></span></button></th>";
                format += "<td>";
                format += "<span data-toggle='tooltip' data-placement='bottom' data-html='true' title='<p><strong>Endereço</strong><br>"+ value.rua_imovel + " " + value.nm_rua_imovel+"<br>"+value.cidade_imovel+"<p><strong>Descrição</strong><br>"+ value.descricao_imovel +"</p '>";
                format +=    value.nm_imovel;
                format += "</span>";
                format += "</td>";
                format += "<td>"+ value.sg_estado_imovel +"</td>";
                format += "<td>"+ value.bairro_imovel +"</td>";
                format += "<td>"+ numberToReal(parseFloat(value.vl_preco_imovel)) +"</td>";
                format += "<td>"+ value.faixa_mcmv_imovel +"</td>";
                format += "<td>"+ numberToReal(parseFloat(value.vl_subsidio_mcmv_imovel)) +"</td>";
                format += "<td>"+ value.metragem_imovel +"</td>";
                format += "<td>"+ formatDate(value.dt_entrega_imovel) +"</td>" ;
              format += "</tr>";
              });
              $("tbody").html(format);
              $('[data-toggle="tooltip"]').tooltip();
              var clipboard = new ClipboardJS('.btn');
}