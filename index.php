<!DOCTYPE html>
<?php
$error = $_SESSION['error'];
?>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Acceso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
	  	
    </style>

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
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	
	<script src="assets/js/bootstrap.min.js"></script>
	
	</head>
	<body>

    <div class="control-group error"><p><?php echo  $error  ?></p></div>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#" ><img src="assets/img/Logo-el10.png"></a>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <form role="form" action="acceso.php" method="post" name="frm_ingreso" id="frm_ingreso" class="login">
            <div class="form-group">
              <label for="usuario">Usuario</label>
              <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" >
            </div>
            <div class="form-group">
              <label for="contrasena">Contrase&ntilde;a</label>
              <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contrase&ntilde;a">
            </div>
            
            
            <button type="submit" class="btn btn-default">Ingresar</button>
          </form>
        </div>
    </div>
<hr>


</body>
</html>