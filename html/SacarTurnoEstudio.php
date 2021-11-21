<?php
//html
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sacar Turno</title>
	<link rel="stylesheet" type="text/css" href="../css/fondo.css">
</head>
<body>
<form id="formulario" method="post">
  <label for="fecha">Fecha:</label><br>
  <input type="date" id="fecha" name="fecha" required="required"><br>
  <select name="hora" id="hora">
	<?php foreach($this->opciones as $o){ ?>
	<option value="<?=$o ?>"><?=$o ?></option><?php } ?>
	</select> 
	<h4><?=$this->mensaje ?></h4>
</form> 
<button id="btnReservar">Reservar Turno</button>


<br/>
<a href="./MenuPrincipalUsuario.php"><button>Volver</button></a>
<script type="text/javascript">
	document.getElementById("fecha").value="<?=$this->dia ?>";
	
	document.getElementById("fecha").onchange=function(){
		document.getElementById("hora").value=null;
		document.getElementById("formulario").submit();
	}
	
	document.getElementById("btnReservar").onclick=function(){
		document.getElementById("fecha").value="<?=$this->dia ?>";
		document.getElementById("formulario").submit();
	}
	
</script>

</body>
</html>