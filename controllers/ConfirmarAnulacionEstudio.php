<?php

require '../fw/fw.php';
require '../models/Turno.php';
require '../models/Usuario.php';
require '../models/Estudio.php';
require '../views/AnularEstudio.php';
require '../views/AnularEstudioAdmin.php';
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


if (($_SESSION['tipoUsuario']==1) or ($_SESSION['tipoUsuario']==2)){
	$e=new Estudio();
	
	$datosDeTurno=$t->getDatosTurno($id_turno); //en este punto ya verifique que exista el turno
	$nombreDelEstudio=$e->getDatosEstudio($datosDeTurno['servicio']); 
	
	$v= new AnularEstudio();
	$v->estudio=$nombreDelEstudio;
	$v->turno=$datosDeTurno;
	$v->render();
	exit();
}
if ($_SESSION['tipoUsuario']==0){
	$e=new Estudio();
	$u=new Usuario();	
	
	$datosDeTurno=$t->getDatosTurno($id_turno);
	$nombreDelEstudio=$e->getDatosEstudio($datosDeTurno['servicio']);
	$nombreDelPaciente=$u->nombreYApellido($datosDeTurno['dni_paciente']);
	
	$v= new AnularEstudioAdmin();
	$v->estudio=$nombreDelEstudio;
	$v->turno=$datosDeTurno;
	$v->paciente=$nombreDelPaciente;
	$v->render();
	exit();
}
header('Location:./IngresoAlSistema.php');
