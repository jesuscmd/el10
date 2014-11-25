<?php
//Iniciar Sesión
session_start();
if (!$_SESSION){
header('Location: ../el10/');
$error = "usuario no autenticado";
/*echo '<script language = javascript>
alert("usuario no autenticado")
self.location = "index.php"
</script>';*/
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>El 10</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
	  	
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
  
  <!-- JQUERY -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script language="javascript" src="assets/js/AjaxUpload.2.0.min.js"></script>
	<script type="text/javascript">
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
			//$("#imagen").val(nombre);
			//alert($("#imagen").parents("form").find("[id^='imagen_']").attr("id"));
			//$("[id^='imagen_']").val(nombre).focus();
			  button.text('Subiendo');
			  this.disable();
		  }
		  },
		  onComplete: function(file, response){
			  button.text('Subir');
			  // enable upload button
			  this.enable();			
			  // Agrega archivo a la lista
			  //$('#lista').appendTo('.files').text(file);
			  $('#lista').html('<h4>Imagen Subida</h4>');
			  $('#lista').fadeIn().delay(messageDelay).fadeOut();
		  }	
	  });
	  
	  $(".form_validado").submit(function(event){
		event.preventDefault();
		var flagOK = validaFormulario($(this).attr("id"));
		
		if(flagOK){
		  $(this).submit();
		}
	  });
	  
	});
	
	var errores = ['Campo requerido','El campo debe ser alfanum&eacute;rico',
				   'El campo debe ser num&eacute;rico','Introduzca un precio v&aacute;lido',
				   'Seleccione una imagen'];
	
	function limpiaErrores(id){
	  $("#"+id).find("div[id$='_error']").hide().html("");
	}
	
	function alphanumeric(val){
	  var regex=/^[0-9A-Za-z]+$/;
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
	  var regex=/^[0-9]{1,4}(\.[0-9]{2}){1}$/;
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
	</script>
	
	
	<!-- STYLE -->
	<style type="text/css">
	
	</style>
  
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><img src="assets/img/Logo-el10.png"></a>
		  
		  <div class="btn-group pull-right">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                          <i class="icon-user" ></i> <?php print $_SESSION['id_user'];?>
                          <span class="caret" ></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href="desconectar_usuario.php">Cerrar Sesi&oacute;n</a></li>
                        </ul>
                    </div>
          
        </div>
      </div>
    </div>

<div class="container">
 <br><br><br>
<h1>Actualización de menús</h1>
<div>
<p id="notice"></p>

<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="icon-wrench icon-white"></i> Opciones </a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li id="modif" class="opMenu"><a href="menu_.php"><i class="icon-pencil"></i> Editar </a></li>
    <!--<li id="buscar" class="opMenu"><a href="#"><i class="icon-camera"></i>Subir Imagen</a></li>-->
    <li id="nuevo" class="opMenu"><a href="#"><i class="icon-file"></i> Nuevo </a></li>
	<li id="sucur" class="opMenu"><a href="#"><i class="icon-map-marker"></i> Sucursales </a></li>
  </ul>
</div>

</div><br/>
<?php

/*
 * DATABASE CONNECTION
 */

// DATABASE: Connection variables
$db_host		= "localhost";
$db_name		= "appel10_el10";
$db_username	= "appel10_el10";
$db_password	= "eldiez";

// DATABASE: Try to connect
if (!$db_connect = mysql_connect($db_host, $db_username, $db_password))
	die('Unable to connect to MySQL.');
if (!$db_select = mysql_select_db($db_name, $db_connect))
	die('Unable to select database');
//mysql_set_charset('utf8',$db_connect);
mysql_query ("SET NAMES 'utf8'");

$result = mysql_query("SELECT * FROM menu order by precio ASC");?>

	<div class="divAction" id="div_modif">

<?php
while($row = mysql_fetch_assoc($result)) {
?>
	<form id="ajax-form"  method="POST" action="ajax-update.php" >
		<table class="table table-striped">
			<tr class="info">
				<td><a href="baja.php?id=<?php echo $row['id']?>"><i class="icon-remove"></i>Eliminar</a></td>
				<td width="70"><span style="font-size:12px; color:#666;">Nombre</span><br><input name="nombre" value="<?php echo stripslashes(htmlspecialchars($row['nombre']));?>"></td>
				<td width="70"><span style="font-size:12px; color:#666;">Precio</span><br><input name="precio" value="<?php echo stripslashes(htmlspecialchars($row['precio']));?>"></td>
				<td width="70"><span style="font-size:12px; color:#666;">Precio P</span><br><input name="precio_p" value="<?php echo stripslashes(htmlspecialchars($row['precio_p']));?>"></td>
			</tr>
			<tr class="info">
				<td width="70"><span style="font-size:12px; color:#666;">Categoría</span><br><input name="categoria" value="<?php echo stripslashes(htmlspecialchars($row['categoria']));?>"></td>
				<td width="70"><span style="font-size:12px; color:#666;">Descripción</span><br><input name="descripcion" value="<?php echo stripslashes(htmlspecialchars($row['descripcion']));?>"></td>
				<td width="70"><span style="font-size:12px; color:#666;">Maridaje</span><br><input name="maridaje" value="<?php echo stripslashes(htmlspecialchars($row['maridaje']));?>"></td>
				<td width="70"><span style="font-size:12px; color:#666;">ml</span><br><input name="ml" value="<?php echo stripslashes(htmlspecialchars($row['ml']));?>"></td>
			</tr>
			<tr class="info">
				<td width="70"><span style="font-size:12px; color:#666;">Uva</span><br><input name="uva" value="<?php echo stripslashes(htmlspecialchars($row['uva']));?>"></td>
				<td width="70"><span style="font-size:12px; color:#666;">Seccion</span><br><input name="seccion" value="<?php echo stripslashes(htmlspecialchars($row['seccion']));?>"></td>
				<!--
				<td width="70"><span style="font-size:12px; color:#666;">Nombre Imagen</span><br><input class="image" id="imagen" name="imagen" value="" disabled="disabled"><div id="imagen_error" style="display: none"></div></td>
				-->
				<td><button id="upload_button" class="btn" type="button">Subir Imagen</button><input></input><div id="lista" class="alert alert-success"></div></td>
				
			  
				<td width="70"><span style="font-size:12px; color:#666;">Nombre Imagen</span><br><input name="imagen" id="imagen_<?php echo $row['id'] ?>" value="<?php echo stripslashes(htmlspecialchars($row['imagen']));?>"></td>
				
				<td><img src="menu/<?php echo $row['imagen']?>.jpg" width="100" height="60"></td>
				
				<td width="70"><input id="where" type="hidden" name="id" value="<?php echo $row['id'] ?>" /></td>	
			</tr>
		</table>
	</form>

<?php }	?>
	</div><!--Fin divModif-->
	
	
	<?php

// DATABASE: Try to connect
if (!$db_connect = mysql_connect($db_host, $db_username, $db_password))
	die('Unable to connect to MySQL.');
if (!$db_select = mysql_select_db($db_name, $db_connect))
	die('Unable to select database');
//mysql_set_charset('utf8',$db_connect);
mysql_query ("SET NAMES 'utf8'");

$result1 = mysql_query("SELECT * FROM sucursales order by id");?>

	<div class="divAction" id="div_sucur" style="display:none;margin-top:10px;">
	<h3>Sucursales</h3>

<?php
while($row = mysql_fetch_assoc($result1)) {
?>
	<form id="ajax-form-sucursales"  method="POST" action="ajax-sucursales.php" >
		<table class="table table-striped">
			<tr class="info">
				<td><span style="font-size:12px; color:#666;">Dirección</span><br><input name="direccion" style="width:550px;" value="<?php echo stripslashes(htmlspecialchars($row['direccion']));?>"></td>
				<td><span style="font-size:12px; color:#666;">Telefono</span><br><input name="telefono" style="width:100px;" value="<?php echo stripslashes(htmlspecialchars($row['telefono']));?>"></td>
			</tr>
			<tr class="info">
				<td><span style="font-size:12px; color:#666;">Horario</span><br><input name="horario" style="width:500px;" value="<?php echo stripslashes(htmlspecialchars($row['horario']));?>"></td>
				<td><span style="font-size:12px; color:#666;">Mapa</span><br>
				<textarea name='mapa' id='mapa' rows="8" cols="8">
				<?php echo stripslashes(htmlspecialchars($row['mapa']));?>
				</textarea>
				</td>
				<td><input id="where" type="hidden" name="id" value="<?php echo $row['id'] ?>" /></td>
			</tr>
		</table>
	</form>
	<?php }	?>	
	</div>
	
	<div class="divAction" id="div_nuevo" style="display:none;margin-top:10px;">
	<h3>Nuevo registro</h3>
	<form id="ajax-form-nuevo" class="form_validado"  method="POST" action="ajax-nuevo.php" >
	<table class="table-striped">
		<tbody>
			<tr>
				<td width="70"><span style="font-size:12px; color:#666;">Nombre</span><br><input class="required alpha" id="nombre" name="nombre" value=""><div id="nombre_error" style="display: none"></div></td>
				<td width="70"><span style="font-size:12px; color:#666;">Precio</span><br><input class="required precio" id="precio" name="precio" value=""><div id="precio_error" style="display: none"></div></td>
				<td width="70"><span style="font-size:12px; color:#666;">Precio P</span><br><input class="precio" id="precio_p" name="precio_p" value=""><div id="precio_p_error" style="display: none"></div></td>
				<td width="70"><span style="font-size:12px; color:#666;">Categoría</span><br><input class="required alpha" id="categoria" name="categoria" value=""><div id="categoria_error" style="display: none"></div></td>
				<td width="70"><span style="font-size:12px; color:#666;">Descripción</span><br><input class="required alpha" id="descripcion" name="descripcion" value=""><div id="descripcion_error" style="display: none"></div></td>
			</tr>
			<tr>
				<td width="70"><span style="font-size:12px; color:#666;">Maridaje</span><br><input class="alpha" id="maridaje" name="maridaje" value=""><div id="maridaje_error" style="display: none"></div></td>
				<td width="70"><span style="font-size:12px; color:#666;">ml</span><br><input class="numeric" id="ml" name="ml" value=""><div id="ml_error" style="display: none"></div></td>
				<td width="70"><span style="font-size:12px; color:#666;">Uva</span><br><input class="alpha" id="uva" name="uva" value=""><div id="uva_error" style="display: none"></div></td>
				<td width="70"><span style="font-size:12px; color:#666;">Seccion</span><br>
					<select class="required" id="seccion" name="seccion">
					<option value="">--Seleccione--</option>
					<option value="MENU">MENU</option>
					<option value="POSTRES">POSTRES</option>
					<option value="BEBIDAS">BEBIDAS</option>
					<option value="VINOS">VINOS</option>
					<option value="CAFETERIA">CAFETERIA</option>
					</select>
					<div id="seccion_error" style="display: none"></div>
					<!--<input id="seccion" name="seccion" value="">--></td>
				
				<td width="70"><span style="font-size:12px; color:#666;">Nombre Imagen</span><br><input class="image" id="imagen" name="imagen" value="" disabled="disabled"><div id="imagen_error" style="display: none"></div></td>
				<td><button id="upload_button" class="btn" type="button">Subir Imagen</button><div id="lista" class="alert alert-success"></div></td>
			</tr>
		</tbody>
	</table>
	<br />
	<button type="submit" class="btn btn-primary">Guardar</button>
	</form>
	</div>
	
	
    </div> 
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
