<?php
	//Iniciar Sesión
	session_start();
	if (!$_SESSION){
	header('Location: ../el10/');
	$error = "usuario no autenticado";
	}
?>
<!DOCTYPE html>
<html lang="es" ng-app="sortable">

  <head>
    <meta charset="utf-8">
    <title>El 10</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-theme.min.css" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="assets/css/jquery.fileupload.css">
    <link href="assets/css/custom.css" rel="stylesheet">


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
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script language="javascript" src="assets/js/AjaxUpload.2.0.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<!--<script type="text/javascript" src="assets/js/angular.min.js"></script>-->

	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.2/angular.min.js"></script>
	<script type="text/javascript" src="assets/js/sortable.js"></script>


	<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
	<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
	<!-- The Canvas to Blob plugin is included for image resizing functionality -->
	<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="assets/js/jquery.iframe-transport.js"></script>
	<!-- The basic File Upload plugin -->
	<script src="assets/js/jquery.fileupload.js"></script>
	<!-- The File Upload processing plugin -->
	<script src="assets/js/jquery.fileupload-process.js"></script>
	<!-- The File Upload image preview & resize plugin -->
	<script src="assets/js/jquery.fileupload-image.js"></script>
	<!-- The File Upload audio preview plugin -->
	<script src="assets/js/jquery.fileupload-audio.js"></script>
	<!-- The File Upload video preview plugin -->
	<script src="assets/js/jquery.fileupload-video.js"></script>
	<!-- The File Upload validation plugin -->
	<script src="assets/js/jquery.fileupload-validate.js"></script>

	<!-- <script type="text/javascript" src="assets/js/custom.js"></script>-->

  </head>

  <body>

  	<div class="navbar navbar-inverse navbar-fixed-top">
  		<div class="navbar-inner">
  			<div class="container">

  				<a class="brand" href="#"><img src="assets/img/Logo-el10.png"></a>

  				<div class="btn-group pull-right menuUsuario">
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

	<?php
		//incluimos las conexiones
		INCLUDE 'assets/connections/connection.php';
	?>


	<!--empieza código de jesus-->
    <div class="container">

    	<div class="row">
    		<div class="col-md-12">
	    		<h1 class="header">Edición de items del menú</h1>
	    	</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label for="escogerCategoria" class="col-sm-2 control-label">FILTRAR: </label>
						<div class="col-sm-8">
							<select class="form-control" id="escogerCategoria">
							  <option>Seleccionar categoría</option>
							  <option>2</option>
							  <option>3</option>
							  <option>4</option>
							  <option>5</option>
							</select>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-4">
				<button type="button" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> NUEVO ITEM</button>
			</div>
		</div>
		
		<!--iteración de las caterias-->
		<div class="contenedorCategoria" ng-controller="categoriasController">
			<div class="row" categoria="{{categoria.nombre}}">
				<div class="col-md-12 mensajes">
					<div class="alert alert-info" role="alert"><strong>Mensaje</strong></div>
				</div>
				<div class="col-md-12 floatleft items">
					<div ng-repeat="(noCategoria, categoria) in elementos" >
						<div class="col-md-12 tituloCategoria">
							<h2>{{noCategoria}} {{categoria.nombre}}</h2>
						</div>
						<div ui-sortable="sortableOptions" class="apps-container screen floatleft" ng-model="elementos[$index].articulos">
							<div class="app" id="elemento{{elemento.0}}" ng-repeat="(artindex, elemento) in elementos[$index].articulos | orderBy:'orden'">
								<div class="row" ng-show="elemento.editando != true">
							  		<div class="col-md-8 itemNombre">
							  			<p>{{artindex}} {{elemento.1}}</p>
							  		</div>
							  		<div class="col-md-2">
							  			<a class="btn btn-default btn-block accionEditar" ng-click="editarItem(noCategoria,artindex, elemento)" ng-disabled="elemento.pidiendoDatos == true">
							  				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
							  				EDITAR
							  			</a>
							  		</div>
							  		<div class="col-md-2">
							  			<a class="btn btn-default btn-block accionBorrar" data-toggle="modal" data-target="#modalEliminar" ng-disabled="elemento.pidiendoDatos == true">
								  			<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
								  			ELIMINAR
								  		</a>
							  		</div>
							  	</div>
							  	<!--MODO EDICION-->
							  	<div class="row" ng-show="elemento.editando == true">
									<div class="col-md-12">
								    	<div class="row">
								    		<div class="col-md-12">
								    			<p>EDICIÓN DEL ITEM</p>
								    		</div>
								    	</div>
								    	<form role="form">
								    		<div class="row">
								    			<div class="col-md-6">
								    				<div class="form-group">
								    					<label for="productoNombre">NOMBRE DEL PRODUCTO</label>
								    					<input type="text" class="form-control" id="productoNombre" placeholder="Nombre del producto" value="{{elemento.1}}">
								    				</div>
								    			</div>
								    			<div class="col-md-4">
								    				<div class="form-group">
								    					<label for="productoCategoria">CATEGORÍA</label>
								    					<!--<select class="form-control" id="productoCategoria" >
															<option value="{{categoria.nombre}}" label="{{categoria.nombre}}" ng-repeat="e in elementos"></option>
								    					</select>-->
								    				</div>
								    			</div>
								    			<div class="col-md-2">
								    				<div class="form-group">
								    					<label for="productoPrecio">PRECIO</label>
								    					<input type="text" class="form-control" id="productoPrecio" placeholder="0.00">
								    				</div>
								    			</div>
								    		</div>
								    		<div class="row" id="vinosCampos" ng-if="elemento.uva != '' || elemento.uva != NULL">
								    			<div class="col-md-3">
								    				<div class="form-group">
								    					<label for="productoUva">UVA</label>
								    					<input type="text" class="form-control" id="productoUva" placeholder="Uva" value="{{elemento.uva}}">
								    				</div>
								    			</div>
								    			<div class="col-md-3">
								    				<div class="form-group">
								    					<label for="productoMaridaje">MARIDAJE</label>
								    					<input type="text" class="form-control" id="productoMaridaje" placeholder="Maridaje" value="{{elemento.maridaje}}">
								    				</div>
								    			</div>
								    			<div class="col-md-3">
								    				<div class="form-group">
								    					<label for="productoMl">ml</label>
								    					<input type="number" class="form-control" id="productoMl" placeholder="ml"  value="{{elemento.ml}}">
								    				</div>
								    			</div>
								    			<div class="col-md-3">
								    				<div class="checkbox">
								    					<label> <br>
															<input type="checkbox"> Personalizable
														</label>
								    				</div>
								    			</div>
								    		</div>
								    		<div class="row">
								    			<div class="col-md-6">
								    				<div class="form-group">
								    					<label for="productoDescripcion">DESCRIPCIÓN</label>
								    					<textarea class="form-control"  id="productoDescripcion" rows="3">{{elemento.descripcion}}</textarea>
								    				</div>
								    			</div>
								    			<div class="col-md-6">
								    				<div class="form-group">
								    					<label for="productoImagen">SUBIR IMAGEN</label>
								    					<div class="row">
												  			<div class="col-md-4">
												  				<div id="files" class="files"></div>
												  			</div>
												  			<div class="col-md-8">
												  				<div class="row">
												  					<div class="col-md-6 botonDinamico">
												  						<span class="btn btn-success btn-block fileinput-button">
												  							<i class="glyphicon glyphicon-upload"></i>
												  							<span>NUEVA</span>
												  							<input id="fileupload" type="file" name="files[]">
												  						</span>
												  					</div>
												  					<div class="col-md-6">
												  						<button type="button" class="btn btn-danger btn-block delete">
												  							<i class="glyphicon glyphicon-trash"></i>
												  							<span>Delete</span>
												  						</button>
												  					</div>
												  				</div>
												  				<br>
												  				<div class="row">
												  					<div class="col-md-12">
												  						<div id="progress" class="progress">
												  							<div class="progress-bar progress-bar-success"></div>
												  						</div>
												  					</div>
												  				</div>
												  			</div>
												  		</div>

								    				</div>
								    			</div>
								    		</div>
								    		<div class="row">
								    			<div class="col-md-3">
								    				<a class="btn btn-default cerrarEdicion btn-block">
								    					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								    					CANCELAR
								    				</a>
								    			</div>
								    			<div class="col-md-6"></div>
								    			<div class="col-md-3">
								    				<button type="submit" class="btn btn-primary btn-block">
								    					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
								    					ACTUALIZAR
								    				</button>
								    			</div>
								    		</div>
								    	</form>
								    </div>
							  	</div><!--MODO EDICION-->

							</div>
					    </div>
					</div>
			    </div>
			</div>
		</div>
	</div>

		
	<!-- Modal -->
	<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel	" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Eliminar Item</h4>
				</div>
				<div class="modal-body">
					<p>¿Está seguro que desea eliminar este item?</p>
					<p>Este cambio no podrá deshacerse.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
					<button type="button" class="btn btn-primary">ELIMINAR</button>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
 		<br><br><br>
		<h1>Edición de items del menú</h1>




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

		</div>

		<br/>


	<div class="divAction" id="div_modif">
  <input type="hidden" id="id_imagen" value="">
  <input type="hidden" id="nombre_imagen" value="">
	
<?php
while($row = mysql_fetch_assoc($result)) {
?>
	<form charset="UTF-8" id="ajax-form"  method="POST" action="ajax-update.php">
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
				
				
				<td width="70"><span style="font-size:12px; color:#666;">Nombre Imagen</span><br><input name="imagen" id="imagen_<?php echo $row['id'] ?>" value="<?php echo stripslashes(htmlspecialchars($row['imagen']));?>"></td>
				
				
				
<td>
<div id="div_img_<?php echo $row['id']; ?>">
<?php if(is_file('menu/'.$row['imagen'].'.jpg')) { ?>
<img src="menu/<?php echo $row['imagen']; ?>.jpg" width="100" height="60">
<?php }else{ ?>
<p>N/D</p>					
<?php } ?>

				
				</div>
				<a id="upload_anchor_<?php echo $row['id'] ?>" href="javascript:upload_anchor(<?php echo $row['id'] ?>);">Subir Imagen</a>
				<input id="where" type="hidden" name="id" value="<?php echo $row['id'] ?>" />
				</td>
				
				<!--
				<td><button id="upload_button" class="btn" type="button">Subir Imagen</button><input></input><div id="lista" class="alert alert-success"></div></td>
				-->
				
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
<form charset="UTF-8" id="ajax-form-sucursales"  method="POST" action="ajax-sucursales.php" >
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
	<form charset="UTF-8" id="ajax-form-nuevo" class="form_validado"  method="POST" action="ajax-nuevo.php" >
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

						<td width="70"><span style="font-size:12px; color:#666;">Nombre Imagen</span><br>
							<input class="image" id="imagen_disabled" disabled="disabled" value="" >
							<input type="hidden" name="imagen" class="image" id="imagen" value="" >
							<div id="imagen_error" style="display: none"></div></td>
							<td><button id="upload_button_2" class="btn" type="button">Subir Imagen (sólo .jpg)</button>
								<button style="display: none" id="upload_button" class="btn" type="button">Subir Imagen (sólo .jpg)</button> 
								<div id="lista" class="alert alert-success"></div></td>
							</tr>
						</tbody>
					</table>
					<br />
					<button type="submit" class="btn btn-primary">Guardar</button>
				</form>
			</div>


		</div>


    <script type="text/javascript" src="assets/js/customFunctions.js"></script>


	<script id="templateItemEdicion" type="text/template">
	    
	    <div class="col-md-12">
	    	<div class="row">
	    		<div class="col-md-12">
	    			<p>EDICIÓN DEL ITEM</p>
	    		</div>
	    	</div>
	    	<form role="form">
	    		<div class="row">
	    			<div class="col-md-6">
	    				<div class="form-group">
	    					<label for="productoNombre">NOMBRE DEL PRODUCTO</label>
	    					<input type="text" class="form-control" id="productoNombre" placeholder="Nombre del producto">
	    				</div>
	    			</div>
	    			<div class="col-md-4">
	    				<div class="form-group">
	    					<label for="productoCategoria">CATEGORÍA</label>
	    					<select class="form-control" id="productoCategoria">
	    						<option>--CATEGORÍA--</option>
	    						<option value="EMPANADAS">Empanadas</option>
	    						<option value="CAFETERIA">Cafetería</option>
	    						<option value="BEBIDAS">Bebidas</option>
	    						<option value="CORTE + PASTA">Cortes y pastas</option>
	    						<option value="GUARNICIONES">Guarniciones</option>
	    						<option value="COCTELERIA">Coctelería</option>
	    						<option value="TEQUILAS">Tequilas</option>
	    						<option value="TINTOS POR COPEO">Tintos por copeo</option>
	    						<option value="CAFETERIA">Cafetería</option>
	    						<option value="VODKAS">Vodkas</option>
	    						<option value="CHORIZO ESTILO ARGENTINO">Chorizo estilo argentino</option>
	    						<option value="RON">Ron</option>
	    						<option value="ENSALADAS">Ensaladas</option>
	    						<option value="MEZCALES">Mezcales</option>
	    						<option value="ANÍS">Anís</option>
	    						<option value="BRANDYS">Brandys</option>
	    						<option value="APERITIVOS">Aperitivos</option>
	    						<option value="SOPAS">Sopas</option>
	    						<option value="BOURBONES">Bourbones</option>
	    						<option value="WHISKYS">Whiskys</option>
	    						<option value="CLERICOT">Clericot</option>
	    						<option value="GINEBRAS">Ginebras</option>
	    						<option value="HAMBURGUESAS">Hamburguesas</option>
	    						<option value="QUESOS A LA PARRILLA">Quesos a la parrilla</option>
	    						<option value="DE LA CASA">De la casa</option>
	    						<option value="PIZZAS POR METRO">Pizzas por metro</option>
	    						<option value="BAGUETTES">Baguettes</option>
	    						<option value="LICORES">Licores</option>
	    						<option value="DIEZADA">Diezada</option>
	    						<option value="PLATILLOS EL DIEZ">Platillos eldiez</option>
	    						<option value="COGNACS">Cognacs</option>
	    						<option value="CORTES DEL ASADOR (res U.S. CHOICE">Cortes del asador (res U.S. choise)</option>
	    						<option value="PASTAS">Pastas</option>
	    						<option value="ARRACHERAS ESPECIALES">Arracheras especiales</option>
	    						<option value="PARRILLA DEL MAR">Parrilla del mar</option>
	    						<option value="BOTELLAS DE 375ML">Botella de 375ml</option>
	    						<option value='TINTOS "EL 10"'>Pastas</option>
	    						<option value="CORTES DEL ASADOR SELECCION ESPECIAL">Cortes del asador selección especial</option>
	    						<option value="SYRAH">Syrah</option>
	    						<option value="MALBEC">Malbec</option>
	    						<option value="CABERNET SAUVIGNON">Cabarnet Sauvignon</option>
	    						<option value="MERLOT">Merlot</option>
	    						<option value="TORRONTES">Torrontes</option>
	    						<option value="CHARDONNAY">Chardonnay</option>
	    						<option value="BLENDS">Blends</option>
	    						<option value="TANNAT">Tannat</option>
	    						<option value="BONARDA">Bornarda</option>
	    						<option value="POSTRES">Postres</option>

	    					</select>
	    				</div>
	    			</div>
	    			<div class="col-md-2">
	    				<div class="form-group">
	    					<label for="productoPrecio">PRECIO</label>
	    					<input type="text" class="form-control" id="productoPrecio" placeholder="0.00">
	    				</div>
	    			</div>
	    		</div>
	    		<div class="row" id="vinosCampos">
	    			<div class="col-md-3">
	    				<div class="form-group">
	    					<label for="productoUva">UVA</label>
	    					<input type="text" class="form-control" id="productoUva" placeholder="Uva">
	    				</div>
	    			</div>
	    			<div class="col-md-3">
	    				<div class="form-group">
	    					<label for="productoMaridaje">MARIDAJE</label>
	    					<input type="text" class="form-control" id="productoMaridaje" placeholder="Maridaje">
	    				</div>
	    			</div>
	    			<div class="col-md-3">
	    				<div class="form-group">
	    					<label for="productoMl">ml</label>
	    					<input type="number" class="form-control" id="productoMl" placeholder="ml">
	    				</div>
	    			</div>
	    		</div>
	    		<div class="row">
	    			<div class="col-md-6">
	    				<div class="form-group">
	    					<label for="productoDescripcion">DESCRIPCIÓN</label>
	    					<textarea class="form-control"  id="productoDescripcion" rows="3">Descripción del producto</textarea>
	    				</div>
	    			</div>
	    			<div class="col-md-6">
	    				<div class="form-group">
	    					<label for="productoImagen">SUBIR IMAGEN</label>
	    					<div class="row">
					  			<div class="col-md-4">
					  				<div id="files" class="files"></div>
					  			</div>
					  			<div class="col-md-8">
					  				<div class="row">
					  					<div class="col-md-6 botonDinamico">
					  						<span class="btn btn-success btn-block fileinput-button">
					  							<i class="glyphicon glyphicon-upload"></i>
					  							<span>NUEVA</span>
					  							<input id="fileupload" type="file" name="files[]">
					  						</span>
					  					</div>
					  					<div class="col-md-6">
					  						<button type="button" class="btn btn-danger btn-block delete">
					  							<i class="glyphicon glyphicon-trash"></i>
					  							<span>Delete</span>
					  						</button>
					  					</div>
					  				</div>
					  				<br>
					  				<div class="row">
					  					<div class="col-md-12">
					  						<div id="progress" class="progress">
					  							<div class="progress-bar progress-bar-success"></div>
					  						</div>
					  					</div>
					  				</div>
					  			</div>
					  		</div>

	    				</div>
	    			</div>
	    		</div>
	    		<div class="row">
	    			<div class="col-md-3">
	    				<a class="btn btn-default cerrarEdicion btn-block">
	    					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
	    					CANCELAR
	    				</a>
	    			</div>
	    			<div class="col-md-6"></div>
	    			<div class="col-md-3">
	    				<button type="submit" class="btn btn-primary btn-block">
	    					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
	    					ACTUALIZAR
	    				</button>
	    			</div>
	    		</div>
	    	</form>
	    </div>

		
	    </script>



	  
	
		  	
		<script id="templateCategoria" type="text/template">

			<div class="row" nombre="{{data.nombre}}">
			  	<div class="col-md-12 tituloCategoria">
			  		<h2>{{data.nombre}}</h2>
			  	</div>
			  	<div class="col-md-12 mensajes">
			  		<div class="alert alert-info" role="alert"><strong>Mensaje</strong></div>
			  	</div>
			  	<div class="col-md-12 items">
			  	<!--COLOCAR ITEMS DINÁMICOS-->
			  		{{#data}}
							{{.}}
							{{#.}}
								{{.}}
							{{/.}}
					{{/data}}

			  	</div>
			</div>
		</script>
		<script id="templateItem" type="text/template">
	  		<ul id="sortable" id="{{id}}">
	  			<li class="ui-state-default identificador item-1">
	  				<div class="row">
	  					<div class="col-md-8 itemNombre">
	  						{{nombre}}
	  					</div>
	  					<div class="col-md-2">
	  						<a class="btn btn-default btn-block accionEditar" onClick="editarItem({{id}})" >
	  							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
	  							EDITAR
	  						</a>
	  					</div>
	  					<div class="col-md-2">
	  						<a class="btn btn-default btn-block accionBorrar" data-toggle="modal" data-target="#modalEliminar">
	  							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
	  							ELIMINAR
	  						</a>
	  					</div>
	  				</div>
	  			</li>

	  		</ul>
		</script>
	</body>
</html>
