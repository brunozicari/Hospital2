<!DOCTYPE html>
<html>
<head>
	<title>Menú Principal</title>
	<link rel="stylesheet" type="text/css" href="../css/fondo.css">
</head>
<body>
<h1>Bienvenido <?= $this->usuario['nombre']?> <?= $this->usuario['apellido']?></h1>
<h1>Su consultorio el dia de hoy es : <?=$this->consultorio ?></h1>
<h1>dia <?= date("d-m-Y", strtotime($this->fecha))?></h1>
<br/>
<form id="formulario" method="get">
<label for="fecha">Fecha:</label><br>
<input type="date" id="fecha" name="fecha" required="required"></input><br>
</form>
	<table>
	
		<?php if ($this->verAgenda==true) echo '<tr><th>Hora</th><th>Paciente</th><th></th></tr>' ?>

		<?php foreach($this->turnos as $t) { ?>
		<tr><td><?= date("H:i", strtotime($t['hora']))?></td><td><?= $t['paciente'] ?></td>
		<td><?php if($this->modificar==true) {
			if ($t['libre']==false) echo "<a href='./ConfirmarAnulacionTurno.php?id=" . $t['id'] . "'" . ">Anular Turno</a>" ;
			if ($t['libre']==true) echo "<a href=" . "'./AgendarTurnoMedico.php?hora=" . $t['hora'] . "&" . "dia=" . $this->fecha . "'" . ">Agendar Turno</a>"; 
			}?></td>
		<?php } ?>
		
		<?php if ($this->verAgenda==false) echo $this->mensaje; ?>

	</table>
<a href="./CerrarSesion.php"><button>Cerrar Sesión</button></a>
<a href="./MenuPrincipalPaciente.php"><button>Ingresar como paciente</button></a>

<script type="text/javascript">
	document.getElementById("fecha").value="<?=$this->fecha ?>";
	
	document.getElementById("fecha").onchange=function(){
		document.getElementById("formulario").submit();
	}	
</script>


<div>
<form name= "cambiar_contra"method="post" action="../controllers/cambiarcontraseña.php">
  <label for="contraseña">Contraseña:</label><br>
   <input type="number" id="dni" name="contraseña" required="required"><br>
<input type="submit" value="Cambiar Contraseña"></input>
  </form>
</div>

</body>
</html>