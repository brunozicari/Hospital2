<?php

require '../fw/fw.php';
require '../models/Turno.php';
require '../models/Usuario.php';
require '../models/Estudio.php';
require '../views/AnularEstudio.php';
require './Sesion.php';


if ($_SESSION['tipoUsuario']!=1)
{
	header('Location:./menuPrincipalPaciente.php');
	exit();
}

if(!isset($_GET['id'])) {
	header('Location:./menuPrincipalPaciente.php');
	exit();
}

if(!ctype_digit($_GET['id'])) {
	header('Location:./menuPrincipalPaciente.php');
	exit();
}

$id_turno=($_GET['id']);
$t=new Turno();
$e=new Estudio();
//try
$datosDeTurno=$t->getDatosTurno($id_turno);
$nombreDelEstudio=$e->getDatosEstudio($datosDeTurno['servicio']);
//catch

$dni_paciente=$_SESSION['idUsuario'];

$v= new AnularEstudio();
$v->estudio=$nombreDelEstudio;
$v->turno=$datosDeTurno;
$v->render();



