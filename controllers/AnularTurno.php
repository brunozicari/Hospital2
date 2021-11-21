<?php

//controlador

require '../fw/fw.php';
require '../models/Usuario.php';
require '../models/Turno.php';
require './Sesion.php';

if(!isset($_GET['id'])) {
	header('Location:./IngresoAlSistema.php');
	exit();
}

if(!ctype_digit($_GET['id'])) {
	header('Location:./IngresoAlSistema.php');
	exit();
}

$id_turno=($_GET['id']);
$t=new Turno();
if(!($t->existeTurno($id_turno))) {
	header('Location:./IngresoAlSistema.php');
	exit();
}

//Si el tipo de usuario es admin no verifico nada más y anulo el turno
if($_SESSION['tipoUsuario']==0){
	$t->anularTurno($id_turno);
	header('Location:./MenuPrincipalAdministracion.php');
	exit();
}
$dni_usuario=$_SESSION['idUsuario'];
//si el usuario no es admin verifico que el turno a anular corresponda al usuario logueado
if(!$t->coincideIdYUsuario($id_turno,$dni_usuario)){
	header('Location:./MenuPrincipalPaciente.php');
	exit();
}
$t->anularTurno($id_turno);
header('Location:./VolverAlMenuPrincipal.php');

