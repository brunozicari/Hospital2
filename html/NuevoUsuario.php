<?php
//html
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ingreso al sistema</title>
	<link rel="stylesheet" type="text/css" href="../css/fondo.css">	
</head>
<body>
<form id="formulario" method="post">
	<label for="dni">DNI:</label><br>
	<input type="number" min="500000" max="100000000" id="dni" name="dni" required="required"><br>
	<label for="nombre">Nombre:</label><br>
	<input type="text" id="nombre" name="nombre" minlength="2" required="required"><br>
	<label for="apellido">Apellido:</label><br>
	<input type="text" id="apellido" name="apellido" minlength="2" required="required"><br>
	<label for="contra">Contraseña:</label><br>
	<input type="password" minlength="6" id="contra" name="contra" required="required"><br>
	<label for="mail">Correo electrónico:</label><br>
	<input type="text" id="mail" name="mail" required="required"><br><br>
	<input type="submit" value="Ingresar"></input>
</form> 
<?PHP echo($this->mensaje); ?>
<br/>
<a href="./IngresoAlSistema.php"><button>Volver</button></a>
</body>
</html>