var dataItems = [];
var arrayCategorias = [];

angular.module('sortable', ['ui.sortable'])
.controller('categoriasController', ['$scope', function($scope) {

	$scope.elementos;
	$scope.sortingLog = [];

	$.ajax({
        type: 'POST',
        url: "assets/connections/connectionDB.php",
        dataType: 'json',
        success: function(responseData, textStatus, jqXHR) {
        	console.log(responseData);
            $scope.$apply(function () {
            	$scope.elementos = responseData;
            	$scope.rawScreens = $scope.elementos
        	});
        },
        error: function (responseData, textStatus, errorThrown) {
            console.log("error en la conexión");
        }
    });
  
  	$scope.sortableOptions = {
	    placeholder: "app",
	    connectWith: ".apps-container"
  	};
  
  	$scope.logModels = function () {
	    $scope.sortingLog = [];
	    for (var i = 0; i < $scope.rawScreens.length; i++) {
	      var logEntry = $scope.rawScreens[i].map(function (x) {
	        return x.title;
	      }).join(', ');
	      logEntry = 'container ' + (i+1) + ': ' + logEntry;
	      $scope.sortingLog.push(logEntry);
	    }
  	};

  	$scope.editarItem = function(i1, i2, e) {
  		//$scope.editando = true;

  		//$scope.elementos[i1][i2]["editando"] = true;
  		//console.log($scope.elementos[i1].articulos[i2]);
  		
  		e.pidiendoDatos = true;


  		//$scope.elementos[i1].articulos[i2]["editando"] = true;

  		$.ajax({
	        type: 'POST',
	        url: "assets/connections/connectionART.php",
	        dataType: 'json',
	        data: {idArticulo: e[0]},
	        success: function(responseData, textStatus, jqXHR) {
	        	e.precio = responseData.precio;
	        	e.maridaje = responseData.maridaje;
	        	e.ml = responseData.ml;
	        	e.personalizacion = responseData.personalizacion;
	        	e.imagen = responseData.imagen;
	        	e.uva = responseData.uva;
	        	e.descripcion = responseData.descripcion;
	        	e.pidiendoDatos = false;
	        	$scope.$apply(function () {
	        		e.editando = true;
	        	});
	        },
	        error: function (responseData, textStatus, errorThrown) {
	            console.log("error en la conexión");
	        }
	    });
  		

  	}





}]);

$(document).ready(function(){


});

function armarCategorias(){

	

}
function editarItem(id) {
	//hacemos un face al contenido actual
	$(".item-1 .row").fadeOut(150, function () {
		loadTemplateItemEdicion('.item-1 .row');
	});
}



function loadTemplateItemEdicion(identifier) {

	var template = $('#templateItemEdicion').html();
	var html = Mustache.to_html(template, {nombre: "Luke"});
	$(identifier).html(html);
	$(identifier).fadeIn();

	$(function () {
		'use strict';
	    // Change this to the location of your server-side upload handler:
	    var url = window.location.hostname === 'blueimp.github.io' ?
	    '//jquery-file-upload.appspot.com/' : 'server/php/',
	    uploadButton = $('<button/>')
	    .addClass('btn btn-primary')
	    .prop('disabled', true)
	    .text('Cargando...')
	    .on('click', function () {
	    	var $this = $(this),
	    	data = $this.data();
	    	$this
	    	.off('click')
	    	.text('Abort')
	    	.on('click', function () {
	    		$this.remove();
	    		data.abort();
	    	});
	    	data.submit().always(function () {
	    		$this.remove();
	    	});
	    });
	    $('#fileupload').fileupload({
	    	url: url,
	    	dataType: 'json',
	    	autoUpload: false,
	    	acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
	        maxFileSize: 5000000, // 5 MB
	        // Enable image resizing, except for Android and Opera,
	        // which actually support image resizing, but fail to
	        // send Blob objects via XHR requests:
	        disableImageResize: /Android(?!.*Chrome)|Opera/
	        .test(window.navigator.userAgent),
	        previewMaxWidth: 200,
	        previewMaxHeight: 200,
	        previewCrop: true
	    }).on('fileuploadadd', function (e, data) {
	    	data.context = $('<div/>').appendTo('#files');
	    	$.each(data.files, function (index, file) {
	    		var node = $('<p/>');
	    		
	    		$(".fileinput-button").css("display", "none");
	    		$(".botonDinamico").append(uploadButton.clone(true).data(data));

	    		node.appendTo(data.context);
	    	});
	    }).on('fileuploadprocessalways', function (e, data) {
	    	var index = data.index,
	    	file = data.files[index],
	    	node = $(data.context.children()[index]);
	    	if (file.preview) {
	    		node
	    		.prepend('<br>')
	    		.prepend(file.preview);
	    	}
	    	if (file.error) {
	    		$(".botonDinamico").html();
	    		$(".botonDinamico")
	    		.append('<br>')
	    		.append($('<span class="text-danger"/>').text(file.error));
	    	}
	    	if (index + 1 === data.files.length) {
	    		//data.context.find('button')
	    		$(".botonDinamico").find('button')
	    		.text('Subir')
	    		.prop('disabled', !!data.files.error);
	    	}
	    }).on('fileuploadprogressall', function (e, data) {
	    	var progress = parseInt(data.loaded / data.total * 100, 10);
	    	$('#progress .progress-bar').css(
	    		'width',
	    		progress + '%'
	    		);
	    }).on('fileuploaddone', function (e, data) {
	    	$.each(data.result.files, function (index, file) {
	    		if (file.url) {
	    			var link = $('<a>')
	    			.attr('target', '_blank')
	    			.prop('href', file.url);
	    			$(data.context.children()[index])
	    			.wrap(link);
	    		} else if (file.error) {
	    			var error = $('<span class="text-danger"/>').text(file.error);
	    			$(data.context.children()[index])
	    			.append('<br>')
	    			.append(error);
	    		}
	    	});
	    }).on('fileuploadfail', function (e, data) {
	    	$.each(data.files, function (index) {
	    		var error = $('<span class="text-danger"/>').text('Error al subir.');
	    		$(".botonDinamico")
	    		//.append('<br>')
	    		.append(error);
	    	});
	    }).prop('disabled', !$.support.fileInput)
	    .parent().addClass($.support.fileInput ? undefined : 'disabled');
	});

	//vigilamos al selector

	$("#productoCategoria")
	.change(function () {
		var datosVinos;
		var valorCategoría = $("#productoCategoria").val();
		switch (valorCategoría){
			case "BLENDS":
			datosVinos = true;
			break;
			case "BONARDA":
			datosVinos = true;
			break;
			case "BOTELLAS DE 375ML":
			datosVinos = true;
			break;
			case "BOURBONES":
			datosVinos = true;
			break;
			case "CABERNET SAUVIGNON":
			datosVinos = true;
			break;
			case "CHARDONNAY":
			datosVinos = true;
			break;
			case "DE LA CASA":
			datosVinos = true;
			break;
			case "MALBEC":
			datosVinos = true;
			break;
			case "MERLOT":
			datosVinos = true;
			break;
			case "SYRAH":
			datosVinos = true;
			break;
			case 'TINTOS "EL 10"':
			datosVinos = true;
			break;
			case "TINTOS POR COPEO":
			datosVinos = true;
			break;
			case "TORRONTES":
			datosVinos = true;
			break;
			default:
			datosVinos = false;
		}

		/*if(datosVinos == true){
			if($("#vinosCampos").css("display") == "none"){
				console.log("no escodido");
				$("#vinosCampos").show("medium");
			}
		} else {
			console.log($("#vinosCampos").css("display"));
			if ($("#vinosCampos").css("display") != "none"){
				console.log("escondido");
				$("#vinosCampos").hide("medium");
			}
		}*/
	})
	.change();

}
