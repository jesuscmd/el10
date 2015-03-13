<?php
	//Iniciar Sesión
	session_start();
	if (!$_SESSION){
	header('Location: ../el10/');
	$error = "usuario no autenticado";
	}
?>
<!DOCTYPE html>
<html id="ng-app" lang="es" ng-app="sortable">

  <head>
    <meta charset="utf-8">
    <title>El 10</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
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
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script>-->


	<script src="assets/js/angular.min.js"></script>
	<script src="assets/js/angular-route.min.js"></script>
	<script src="assets/js/angular-resource.min.js"></script>
	<script type="text/javascript" src="assets/js/sortable.js"></script>


	<!--<script type="text/javascript" src="assets/js/angular-file-upload.min.js"></script>-->
	 <script src="assets/js/angular-file-upload.min.js"></script>

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


  	<div class="container" ng-controller="editarMenuMain">

		<div class="row">
			<div class="col-md-12">
	    		<h1 class="header">Edición de items del menú</h1>
	    	</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label for="escogerCategoria" class="col-sm-2 control-label">FILTRAR SECCIÓN: </label>
						<div class="col-sm-8">

							<select class="form-control" id="escogerCategoria2" ng-model="filtroActivo" ng-options="sec.nombre for sec in secciones">
								<option value="" selected="selected">TODAS LAS SECCIONES</option>
							</select>
							
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-4" ng-controller="crearItem">
				<button type="button" class="btn btn-primary btn-block" ng-click="crearItem()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> NUEVO ITEM</button>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<h1>SECCIÓN: <span></span>
					<span ng-show="filtroActivo == null">TODAS LAS SECCIONES</span>
					<span ng-show="filtroActivo">{{filtroActivo.nombre}}</span>
				</h1>
			</div>
		</div>

	    <div ng-view>
	    </div>

    </div>

    <script type="text/javascript" src="assets/js/customFunctions.js"></script>

	</body>
</html>
