<?php
//controlador

require '../fw/fw.php';
require './Sesion.php';
require '../models/Medico.php';
require '../models/Estudio.php';
require '../models/Turno.php';
require '../views/ConsultarTurnosPaciente.php';
require_once '../class_helper/seguridad.php';

if ($_SESSION['tipoUsuario']!=0)
{
	header('Location:./IngresoAlSistema.php');
	exit();
}
if (!isset($_POST['dni_paciente'])){
	header('Location:./IngresoAlSistema.php');
	exit();
}

$dni=$_POST['dni_paciente'];

$e = new estudio();
$u = new usuario();
$m = new  medico();
$datos=$u->getDatos($dni);

$t = new Turno();
$todosLosTurnos=$t->getTurnosPorUsuario($dni);
$todosLosEstudios=$t->getEstudiosPorUsuario($dni);


$v= new ConsultarTurnosPaciente();
$v->usuario=$datos;
$v->turnos=$todosLosTurnos;
$v->estudios=$todosLosEstudios;
$v->render();