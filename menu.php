<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>Menu</title>
	<!-- JQUERY -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript">
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
								alert(data);
							}
							// Load output into a P
							else {
								$('#notice').text('Campo Actualizado');
								$('#notice').fadeOut().fadeIn();
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
	</script>
	<!-- STYLE -->
	<style type="text/css">
		INPUT { margin-right: 1em }
	</style>
</head>
<body>

<!-- CONTENT -->
<h1>Actualiza Menu</h1>
<p id="notice"></p>
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
mysql_set_charset('utf8',$db_connect);

$result = mysql_query("SELECT * FROM menu");

while($row = mysql_fetch_assoc($result)) {
?>

<form id="ajax-form" class="autosubmit" method="POST" action="ajax-update.php">
	<table>
		<tr>
			<td><input name="nombre" value="<?php echo $row['nombre']?>"></td>
			<td><input name="precio" value="<?php echo $row['precio']?>"></td>
			<td><input name="precio_p" value="<?php echo $row['precio_p']?>"></td>
			<td><input name="categoria" value="<?php echo $row['categoria']?>"></td>
			<td><input name="descripcion" value="<?php echo $row['descripcion']?>"></td>
			<td><input name="maridaje" value="<?php echo $row['maridaje']?>"></td>
			<td><input name="ml" value="<?php echo $row['ml']?>"></td>
			<td><input name="uva" value="<?php echo $row['uva']?>"></td>
			<td><img src="menu/<?php echo $row['imagen']?>.jpg" width="100" height="60"></td>
			<td><input id="where" type="hidden" name="id" value="<?php echo $row['id'] ?>" /></td>
			<td><input id="where" type="hidden" name="id" value="<?php echo $row['id'] ?>" /></td>
		</tr>
	</table>
</form>
<?php }	?>
</body>
</html>