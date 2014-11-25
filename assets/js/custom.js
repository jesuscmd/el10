$(document).ready(function(){

	$(".opMenu").click(function(){
		$("div.divAction").hide();
		$("#div_"+$(this).attr("id")).show();
	});

	var messageDelay = 1000;
	var button = $('#upload_button'), interval;
	new AjaxUpload('#upload_button', {
		action: 'upload.php',
		onSubmit : function(file , ext){
			if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
			  // extensiones permitidas
			  alert('Error: Solo se permiten imagenes');
			  // cancela upload
			  return false;
			} else {
				var nombre = file.toString().split(".")[0];
				$("#nombre_imagen").val(nombre);
				button.text('Subiendo');
				this.disable();
			}
		},
		onComplete: function(file, response){
			colocaNombre();
			button.text('Subir');
			  // enable upload button
			  this.enable();			
			  // Agrega archivo a la lista
			  //$('#lista').appendTo('.files').text(file);
			  $('#lista').html('<h4>Imagen Subida</h4>');
			  $('#lista').fadeIn().delay(messageDelay).fadeOut();
			}	
		});

		
		
	  new AjaxUpload('#upload_button_2', {
		  action: 'upload.php',
		  onSubmit : function(file , ext){
		  if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
			  // extensiones permitidas
			  alert('Error: Solo se permiten imagenes');
			  // cancela upload
			  return false;
		  } else {
			var nombre = file.toString().split(".")[0];
			$("#imagen").val(nombre);
			$("#imagen_disabled").val(nombre);
			
			  button.text('Subiendo');
			  this.disable();
		  }
		  },
		  onComplete: function(file, response){
			  // enable upload button
			  this.enable();			
			  // Agrega archivo a la lista
			  //$('#lista').appendTo('.files').text(file);
			  $('#lista').html('<h4>Imagen Subida</h4>');
			  $('#lista').fadeIn().delay(messageDelay).fadeOut();
		  }	
	  });
	  
	  $(".form_validado").submit(function(event){
		var flagOK = validaFormulario($(this).attr("id"));
		if(!flagOK){
		  event.preventDefault();
		  alert("Verifique los datos ingresados");
		}
	  });
	  
	  $("#seccion").on("change", function(evento){
	      //agregar en el arreglo las categorias que requieren descripcion e imagen
	      var conDescripcion = ["MENU", "POSTRES", "VINOS"];
	      
	      var seleccion = this.value;
	      var requerir = false;
	      for (var i = 0; i < conDescripcion.length; i++) {
		requerir = conDescripcion[i] == seleccion;
		if (requerir) {break;}
	      }
	      
	      if (requerir) {
		$("#descripcion").addClass("required");
		$("#imagen").addClass("image");
		$("#imagen_disabled").addClass("image");
	      }
	      else{
		$("#descripcion").removeClass("required");
		$("#imagen").removeClass("image");
		$("#imagen_disabled").removeClass("image");
	      }
	    
	  });
	  
	});
	
	function colocaNombre(nombre){
	  var id = $("#id_imagen").val();
	  var nombreImagen = $("#nombre_imagen").val();
	  $("#imagen_"+id).val(nombreImagen).focus();
	  $("#upload_anchor_"+id).focus();
	  var img = '<img src="menu/'+nombreImagen+'.jpg" width="100" height="60">'
	  $("#div_img_"+id).html(img);
	}
	
	function alerta(){
	  $("#id_imagen").val("sd");
	}
	
	function upload_anchor(id){
	  $("#id_imagen").val(id);
	  $('#upload_file_input').trigger('click');
	}
	
	var errores = ['Campo requerido','El campo debe ser alfanum&eacute;rico',
				   'El campo debe ser num&eacute;rico','Introduzca un precio v&aacute;lido',
				   'Seleccione una imagen'];
	
	function limpiaErrores(id){
	  $("#"+id).find("div[id$='_error']").hide().html("");
	}
	
	function alphanumeric(val){
	  var regex=/^[ 0-9A-Za-záéíóúÁÉÍÓÚñÑüÜ]+$/;
	  if(regex.test(val)){
		  return true;
	  } 
	  else {
		  return false;
	  }
	}
	
	function numeric(val){
	  var regex=/^[0-9]+$/;
	  if(regex.test(val)){
		  return true;
	  } 
	  else {
		  return false;
	  }
	}
	
	function precio(val){
	  //var regex=/^[0-9]{1,4}(\.[0-9]{2}){1}$/;
	  var regex=/^[0-9]+$/;
	  if(regex.test(val)){
		  return true;
	  } 
	  else {
		  return false;
	  }
	}
	
	function validaFormulario(id){
	  var flagOK = true;
	  limpiaErrores(id);
	  
	  $("#"+id).find(".required").each(function(){
		if($(this).val() == "" || $(this).val() == "PS"){
		  flagOK = false;
		  $("#"+$(this).attr("id")+"_error").html(errores[0]).show();
		}
	  });
	  
	  $("#"+id).find(".alpha").each(function(){
		if($(this).val() != ""){
		  if(!alphanumeric($(this).val())){
			flagOK = false;
			$("#"+$(this).attr("id")+"_error").html(errores[1]).show();
		  }
		}
	  });
	  
	  $("#"+id).find(".numeric").each(function(){
		if($(this).val() != ""){
		  if(!numeric($(this).val())){
			flagOK = false;
			$("#"+$(this).attr("id")+"_error").html(errores[2]).show();
		  }
		}
	  });
	  
	  $("#"+id).find(".precio").each(function(){
		if($(this).val() != ""){
		  if(!precio($(this).val())){
			flagOK = false;
			$("#"+$(this).attr("id")+"_error").html(errores[3]).show();
		  }
		}
	  });
	  
	  $("#"+id).find(".image").each(function(){
		if($(this).val() == ""){
			flagOK = false;
			$("#"+$(this).attr("id")+"_error").html(errores[4]).show();
		}
	  });
	  
	  return flagOK;
	}
	
	
	// JQUERY: Plugin "autoSumbit"
	(function($) {
		$.fn.autoSubmit = function(options) {
			return $.each(this, function() {
				// VARIABLES: Input-specific
				var input = $(this);
				var column = input.attr('name');
	
				// VARIABLES: Form-specific
				var form = input.parents('form');
				var method = form.attr('method');
				var action = form.attr('action');

				// VARIABLES: Where to update in database
				var where_val = form.find('#where').val();
				var where_col = form.find('#where').attr('name');
	
				// ONBLUR: Dynamic value send through Ajax
				input.bind('blur', function(event) {
					// Get latest value
					var value = input.val();
					console.log(value + " , " + column + ", " + where_col + " ," + where_val	);

					// AJAX: Send values
					$.ajax({
						url: action,
						type: method,
						data: {
							val: value,
							col: column,
							w_col: where_col,
							w_val: where_val
						},
						cache: false,
						timeout: 10000,
						success: function(data) {
							// Alert if update failed
							if (data) {
								//alert(data);
								alert('Campo No Actualizado');
							}
							// Load output into a P
							else {
								alert('Campo Actualizado');
								/*$('#notice').text('Campo Actualizado');
								$('#notice').fadeOut().fadeIn();*/
							}
						}
					});
					// Prevent normal submission of form
					return false;
				})
			});
		}
	})(jQuery);
	// JQUERY: Run .autoSubmit() on all INPUT fields within form
	$(function(){
		$('#ajax-form INPUT').autoSubmit();
	});
	$(function(){
		$('#ajax-form-sucursales INPUT').autoSubmit();
	});