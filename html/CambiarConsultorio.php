<?php
//html
?>

<!DOCTYPE html>
<html>
<head>
	<title>Cambiar Consultorio</title>
	<link rel="stylesheet" type="text/css" href="../css/fondo.css">
</head>
<body>
<h2>Seleccione el consultorio para <?=$this->medico ?></h2>
<form id="formulario" method="post">
	<label for="consultorio">Consultorio:</label><br>
	<select name="consultorio" id="consultorio" required="required">
		<?php foreach($this->consultorios as $c){ ?>
		<option value="<?=$c ?>"><?=$c ?></option><?php } ?>
	</select><br>
  <input type="submit" value="Aceptar"></input>
</form> 
<br/>
<a href="./MenuPrincipalAdministracion.php"><button>Volver</button></a>

</body>
</html>