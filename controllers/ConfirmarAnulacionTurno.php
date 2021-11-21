<?php

require '../fw/fw.php';
require '../models/Turno.php';
require '../models/Usuario.php';
require '../models/Medico.php';
require '../views/AnularTurnoPaciente.php';
require '../views/AnularTurnoMedico.php';
require '../views/AnularTurnoAdministracion.php';
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


if ($_SESSION['tipoUsuario']==1){
	$m=new Medico();

	$datosDeTurno=$t->getDatosTurno($id_turno);
	$nombreDelMedico=$m->nombreYApellido($datosDeTurno['servicio']);

	$dni_paciente=$_SESSION['idUsuario'];

	$v= new AnularTurnoPaciente();
	$v->medico=$nombreDelMedico;
	$v->turno=$datosDeTurno;
	$v->render();
	exit();
}
if ($_SESSION['tipoUsuario']==2){
	$u=new Usuario();

	$datosDeTurno=$t->getDatosTurno($id_turno);
	$nombreDelPaciente=$u->nombreYApellido($datosDeTurno['dni_paciente']);

	$dni_paciente=$_SESSION['idUsuario'];

	$v= new AnularTurnoMedico();
	$v->paciente=$nombreDelPaciente;
	$v->turno=$datosDeTurno;
	$v->render();
	exit();
}

if ($_SESSION['tipoUsuario']==0){
	$u=new Usuario();
	$m=new Medico();

	$datosDeTurno=$t->getDatosTurno($id_turno);
	$nombreDelPaciente=$u->nombreYApellido($datosDeTurno['dni_paciente']);
	$nombreDelMedico=$m->nombreYApellido($datosDeTurno['servicio']);

	$v= new AnularTurnoAdministracion();
	$v->paciente=$nombreDelPaciente;
	$v->medico=$nombreDelMedico;
	$v->turno=$datosDeTurno;
	$v->render();
	exit();
}
header('Location:./IngresoAlSistema.php');


