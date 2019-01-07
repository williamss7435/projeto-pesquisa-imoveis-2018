numImages = 0;
$(function(){
	$("#btn-image-add").click(function(){
		numImages++;
		$("#div-images").append("<input type='file' class='form-control mt-2 btn btn-primary' name='foto"+numImages+"' id='foto"+numImages+"'>");
		$("#qntImages").val(numImages);
		$(this).html("<span class='oi oi-plus'></span> Adicionar Mais Fotos");
	});

	$("#btn-image-remove").click(function(){
		if(numImages>0){
			$("#foto"+numImages).remove();
			numImages--;
			$("#qntImages").val(numImages);
		}

		if(numImages==0)
			$("#btn-image-add").html("<span class='oi oi-image'></span> Adicionar Foto")
		
	});


	$("#preco").maskMoney({prefix:'R$ ', allowNegative: false, thousands:',', decimal:'.', affixesStay: false});
	$("#subsidio").maskMoney({prefix:'R$ ', allowNegative: false, thousands:',', decimal:'.', affixesStay: false});

});

function showValue(value){
	$("#valMet").html(value + " M²");
}