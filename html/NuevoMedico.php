<?php
//html
?>

<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Medico</title>
	<link rel="stylesheet" type="text/css" href="../css/fondo.css">
</head>
<body>
<h2>Datos del profesional</h2>
<form id="formulario" method="post">
	<label for="dni">DNI:</label><br>
	<input type="number" id="dni" name="dni" required="required"><br>
	<label for="nombre">Nombre:</label><br>
	<input type="text" id="nombre" name="nombre" required="required"><br>
	<label for="apellido">Apellido:</label><br>
	<input type="text" id="apellido" name="apellido" required="required"><br>
	<label for="contra">Contraseña:</label><br>
	<input type="password" id="contra" name="contra" required="required"><br><br>
	<label for="mail">Correo electrónico:</label><br>
	<input type="text" id="mail" name="mail" required="required"><br><br>
	<label for="especialidad">Especialidad:</label><br>
	<select name="especialidad" id="especialidad" required="required">
		<?php foreach($this->especialidades as $e){ ?>
		<option value="<?=$e['especialidad_id'] ?>"><?=$e['nom_especialidad'] ?></option><?php } ?>
	</select> <br>
	<label for="consultorio">Consultorio:</label><br>
	<select name="consultorio" id="consultorio" required="required">
		<?php foreach($this->consultorios as $c){ ?>
		<option value="<?=$c ?>"><?=$c ?></option><?php } ?>
	</select><br>
	<label for="horario">Horario:</label><br>
	<select name="horario" id="horario" required="required">
		<option value="m">Mañana</option>
		<option value="t">Tarde</option>
	</select> <br>
  <input type="submit" value="Enviar"></input>
</form> 
<h3><?= $this->mensaje ?></h3>
<br/>
<a href="./MenuPrincipalAdministracion.php"><button>Volver</button></a>

</body>
</html>


