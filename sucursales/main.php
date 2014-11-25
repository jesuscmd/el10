<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Documento sin título</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<hr style="border: dashed 1px #333; margin:10px;">
<div id="m_sucursales"></div>
<div style=" width:650px; height:160px;">
	<div style="width:330px; height:160px; float:left;">
    	<h3 style="font-size:20px; color:#109ECC;">CENTRAL DE LLAMADAS</h3>
    	<div style="font-size:50px; color:#000;  font-weight:bold;">5278 9910</div>
    		<div style="font-size:17px; color:#000; font-weight:bold; padding-left:5px;">HORARIOS:<span style="color:#109ECC;">&nbsp;DE 13:00 HRS A 23:00 HRS</span></div>
    </div>
   <div style="width:365px; height:160px; margin-left:332px;">
       <div style="font-size:14px; color:#000; font-weight:bold; padding-left:5px; ">Sucursales que tienen servicio a domicilio:
       </div>
           <div class="sucursales">
                <div style="width:130px; height:160px; float:left;">
                   <a href="condesa.php" target="conte_sucu">&#8250; Condesa</a>
                   <a href="claveria.php" target="conte_sucu">&#8250; Claveria</a>
                   <a href="roma.php" target="conte_sucu">&#8250; Roma</a>
                   <a href="polanco.php" target="conte_sucu">&#8250; Polanco</a>
                </div>
                <div style="width:190px; height:160px; margin-left:130px;">
                   <a href="santa.php" target="conte_sucu">&#8250; Santa Fe</a>
                   <a href="lomas.php" target="conte_sucu">&#8250; L. de Chapultepec</a>
                   <a href="reforma.php" target="conte_sucu">&#8250; Reforma</a>
                   <a href="sanangel.php" target="conte_sucu">&#8250; San Angel</a>
                </div>
            </div>
            <div style="position:relative; top:-30px; left:60px; z-index:2;"><img src="../images/botones/tarjeta.png"></div>
      </div>
</div>
<div class="clear"></div>
<hr style="border: dashed 1px #333; margin:10px;">
<iframe name="conte_sucu" width="660" height="400" frameborder="0" 
										 style="overflow:hidden;" scrolling="no"
										 src="sucursales/condesa.html">
                                         </iframe>
</body>
</html>
